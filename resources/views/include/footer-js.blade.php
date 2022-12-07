<script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{ asset('backend/assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{ asset('backend/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{ asset('backend/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('backend/dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<!-- <script src="{{ asset('backend/assets/js/pages/dashboards/dashboard1.js')}}"></script> -->
<!-- Charts js Files -->
<script src="{{ asset('backend/assets/libs/flot/excanvas.js')}}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.pie.js')}}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.time.js')}}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.stack.js')}}"></script>
<script src="{{ asset('backend/assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
<script src="{{ asset('backend/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/pages/chart/chart-page-init.js')}}"></script>
<script src="{{ asset('backend/dist/js/toastr.min.js')}}"></script>

<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "200",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    const type = "{{ Session::get('alert-type') }}";
    switch (type) {

        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
</script>
@stack('extra-script')

