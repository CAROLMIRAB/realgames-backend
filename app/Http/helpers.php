<?php

if (!function_exists('active')) {
    /**
     * Active the current menu
     *
     * @param  string $path
     * @param  bool $secure
     * @return string
     */
    function active($route)
    {
        if (!is_null($route)) {
            if (route($route) == \Request::url()) {
                return 'active open';
            }
        }
        return $route;
    }
}

if (!function_exists('menu')) {

    /**
     * Get providers menu
     *
     * @return string
     */
    function menu()
    {
        $menu = [
            'Dashboard' => [
                'text' => __('Dashboard'),
                'route' => 'dashboard',
                'icon' => 'dashboard',
                'permission' => \App\Core\Enums\Roles::$client,
                'subMenu' => [],
            ],
            'DashboardAd' => [
                'text' => __('Dashboard'),
                'route' => 'dashboard',
                'icon' => 'dashboard',
                'permission' => \App\Core\Enums\Roles::$administrator,
                'subMenu' => [],
            ],
            'Users' => [
                'text' => __('Usuarios'),
                'route' => null,
                'icon' => 'users',
                'permission' => \App\Core\Enums\Roles::$client,
                'subMenu' => [

                    'Search' => [
                        'text' => __('Busqueda Avanzada'),
                        'route' => 'users.advancedsearch',
                        'icon' => 'search',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ],
                ],
            ],
            'Transactions' => [
                'text' => __('Transacciones'),
                'route' => null,
                'icon' => 'balance-scale',
                'permission' => \App\Core\Enums\Roles::$client,
                'subMenu' => [

                    'SearchTransaction' => [
                        'text' => __('Busqueda Avanzada'),
                        'route' => 'transactions.viewtransactionsadvancedsearch',
                        'icon' => 'search',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ],
                ],
            ],

            'Clients' => [
                'text' => __('Clientes'),
                'route' => null,
                'icon' => 'users',
                'permission' => \App\Core\Enums\Roles::$administrator,
                'subMenu' => [

                    'CreateClient' => [
                        'text' => __('Registrar'),
                        'route' => 'clients.createclients',
                        'icon' => 'edit',
                        'permission' => \App\Core\Enums\Roles::$administrator,
                        'subMenu' => [],
                    ],
                    'SearchClient' => [
                        'text' => __('Busqueda Avanzada'),
                        'route' => 'clients.advanced-search-clients-view',
                        'icon' => 'search',
                        'permission' => \App\Core\Enums\Roles::$administrator,
                        'subMenu' => [],
                    ],
                ],
            ],
            'ReportsClient' => [
                'text' => __('Reportes'),
                'route' => null,
                'icon' => 'bar-chart',
                'permission' => \App\Core\Enums\Roles::$client,
                'subMenu' => [

                    'Profit' => [
                        'text' => __('Profit'),
                        'route' => 'reports.profit',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ],

                    'ProfitUsers' => [
                        'text' => __('Profit por usuario'),
                        'route' => 'reports.profitbyuser',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ],

                    'ProfitGeneralUsers' => [
                        'text' => __('Profit General Usuarios'),
                        'route' => 'reports.profitgeneralusers',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ],

                    'SpinByGame' => [
                        'text' => __('Spin por juego'),
                        'route' => 'reports.spinbygame',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ],

                    'ProfitByGame' => [
                        'text' => __('Profit por juego'),
                        'route' => 'reports.profitbygame',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ],

                    'ProfitByProvider' => [
                        'text' => __('Profit por proveedor'),
                        'route' => 'reports.profitbyprovider',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$client,
                        'subMenu' => [],
                    ]

                ],
            ],
            'Reports' => [
                'text' => __('Reportes'),
                'route' => null,
                'icon' => 'bar-chart',
                'permission' => \App\Core\Enums\Roles::$administrator,
                'subMenu' => [

                    'ProfitClient' => [
                        'text' => __('Profit'),
                        'route' => 'reports.profitbyclient',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$administrator,
                        'subMenu' => [],
                    ],

                    'ProfitGeneralClient' => [
                        'text' => __('Profit General Clientes'),
                        'route' => 'reports.profitgeneralclients',
                        'icon' => 'credit-card',
                        'permission' => \App\Core\Enums\Roles::$administrator,
                        'subMenu' => [],
                    ],
                ],
            ],
        ];
        return json_decode(json_encode($menu));
    }
}

