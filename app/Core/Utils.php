<?php

namespace App\Core;

class Utils
{
    /**
     * Create the response
     *
     * @param string $status    Response status
     * @param string $code      Status code
     * @param array  $data      Response data
     * @return \Symfony\Component\HttpFoundation\Response
     * @author  Carol Mirabal
     */
    public static function createResponse($status, $code, $data)
    {
        $response = [
            'status' => $status,
            'code' => $code,
            'data' => $data
        ];
        return response()->json($response);
    }

    /**
     * @param $menus
     * @return null|string
     */
    public static function itemsMenu($menus)
    {
        $menu = null;
        foreach ($menus as $item) {
            if ($item->permission == \Auth::user()->rol) {
                $menu .= sprintf(
                    '<li data-active="%s" class="treeview">',
                    active($item->route)
                );
                $menu .= sprintf(
                    '<a href="%s">',
                    !is_null($item->route) ? route($item->route) : '#'
                );
                $menu .= sprintf(
                    '<i class="fa fa-%s"></i> ',
                    $item->icon
                );
                $menu .= sprintf(
                    '<span class="title">%s</span>',
                    $item->text
                );
                $menu .= '<span class="selected"></span>';

                if (isset($item->subMenu)) {
                    if (count($item->subMenu) > 0) {
                        $menu .= '<i class="fa fa-angle-left pull-right"></i>';
                    }
                }
                $menu .= '</a>';

                if (isset($item->subMenu)) {
                    if (count($item->subMenu) > 0) {
                        $menu .= '<ul class="treeview-menu">';
                        $menu .= self::itemsMenu($item->subMenu);
                        $menu .= '</ul>';
                    }
                }
                $menu .= '</li>';
            }
        }
        return $menu;
    }

    /**
     * @return null|string
     */
    public static function buildMenu()
    {
        $menus = menu();
        return self::itemsMenu($menus);
    }
}
