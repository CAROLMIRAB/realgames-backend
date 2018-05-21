<?php

namespace App\Paginator;

class PaginatorDataTable
{
    /**
     * Format data
     *
     * @param $request
     * @return array
     */
    public static function format($request)
    {
        $conditions = [];
        $searchVal = null;
        $searchName = null;
        $nameCol = null;
        $like = null;
        $orderDir = 'asc';
        $start_in = $request->input('start');
        $length_in = $request->input('length');

        // Orderable
        $order = $request->input('order.0');
        $orderCol = $request->input('order.0.column');
        $orderableCol = $request->input("columns." . $orderCol . ".orderable");

        // Search
        $search = $request->input('search.value');
        $numColumns = count($request->input("columns"));

        if (isset($length_in) && $start_in != '-1') {
            $start = intval($start_in);
            $length = intval($length_in);
        } else {
            $start = 0;
            $length = 10;
        }

        // Orderable
        if (isset($order) && $order != "") {
            $nameCol = $request->input("columns." . $orderCol . ".name");
            $orderDir = $request->input('order.0.dir');
        }

        // Searchable
        if (isset($search) && $search != "") {
            for ($i = 0; $i <= $numColumns; $i++) {
                if ($request->input("columns." . $i . ".searchable") == 'true') {
                    $conditions[] = $request->input("columns." . $i . ".name");
                }
            }
        } else {
            $conditions = null;
        }

        //Search individual
        for ($i = 0; $i <= $numColumns; $i++) {
            $search_value = $request->input("columns." . $i . ".search.value");
            if ($search_value != "") {
                $searchVal = $request->input("columns." . $i . ".search.value");
                $searchName = $request->input("columns." . $i . ".name");
                $like = $request->input("columns." . $i . ".searchable");
            }
        }

        $dataRequest = [
            'columns' => $conditions,
            'limitStart' => $start,
            'limitLength' => $length,
            'orderColumn' => $nameCol,
            'orderDir' => $orderDir,
            'searchVal' => $search,
            'searchName' => $searchName,
            'individualSearch' => trim($searchVal),
            'like' => $like
        ];
        return $dataRequest;
    }

    /**
     * Render data from datatable
     *
     * @param $request
     * @param $recordsTotal
     * @param $data
     * @return array
     */
    public static function render($request, $recordsTotal, $data)
    {
        $draw = $request->input('draw');

        $dataResponse = [
            'draw' => $draw,
            'recordsTotal' => intval($recordsTotal),
            'recordsFiltered' => intval($recordsTotal),
            'data' => $data,
            'input' => $request
        ];

        return $dataResponse;

    }

    /**
     * first load vacia no data
     *
     * @return array
     */
    public static function firstLoad()
    {
        $data = [
            'draw' => 1,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => []
        ];

        return response()->json($data);
    }
}