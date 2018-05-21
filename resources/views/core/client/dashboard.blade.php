@extends('template')
@section('content')
    <section class="content-header">
        <h1>
            {{ __('Dashboard') }}
            <small>{{ __('Control panel') }}</small>
        </h1>

    </section>
    <section class="content">
        @include('core.client.dashboardresume')
        @include('core.client.dashboardinfo')
    </section>
@endsection

@section('scripts')

    <script src="{{ asset('packages/jquery-ui/ui/widgets/sortable.js') }}"></script>
    <script src="{{ asset('packages/datatables-plugins/api/fnReloadAjax.js') }}"></script>
    <script src="{{ asset('packages/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('packages/jquery-number/jquery.number.min.js') }}"></script>
    <script src="{{ asset('src/js/date-range.js') }}"></script>
    <script src="{{ asset('src/js/money-format.js') }}"></script>
    <script src="{{ asset('src/js/dashboard.js') }}"></script>
    <script src="{{ asset('src/js/reports.js') }}"></script>
    <script>
        $(function () {
            Dashboard.loadData();
            Dashboard.drawChart();
            Dashboard.transactionsViewer();
            Dashboard.sortableResume();
            Dashboard.firstThreeSpin();
            Dashboard.topPlayers();
            Dashboard.favoritesGames();
        });

    </script>
@endsection