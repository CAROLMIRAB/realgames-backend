<div id="date-range" class="btn btn-fit-height grey-salt">
    <i class="fa fa-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp;
    <i class="fa fa-angle-down"></i>
</div>
<input type="hidden" id="start-date" name="start-date">
<input type="hidden" id="end-date" name="end-date">

@section('scripts')
    @parent
    <script src="{{ asset('packages/moment/min/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('packages/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection