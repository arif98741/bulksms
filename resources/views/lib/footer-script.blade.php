<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{ asset('backend/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/app.js')}}"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<script>
    $(document).ready(function () {
        App.init();
    });
</script>
<script src="{{ asset('backend/assets/js/custom.js')}}"></script>
<script>
    @if(session()->has('alert-type'))
    @php
        $alert = session()->get('alert-type');
        $alertMessage = session()->get('message');
    @endphp
    @if($alert == 'success')
    toastr.success('{{ $alertMessage }}');
    @endif
    @if($alert == 'warning')
    toastr.warning('{{ $alertMessage }}');
    @endif
    @if($alert == 'error')
    toastr.error('{{ $alertMessage }}');
    @endif
        @endif

        window.onload = function () {
        clock();

        function clock() {
            var now = new Date();
            var TwentyFourHour = now.getHours();
            var hour = now.getHours();
            var min = now.getMinutes();
            var sec = now.getSeconds();
            var mid = 'pm';
            if (min < 10) {
                min = "0" + min;
            }
            if (hour > 12) {
                hour = hour - 12;
            }
            if (hour == 0) {
                hour = 12;
            }
            if (TwentyFourHour < 12) {
                mid = 'am';
            }
            document.getElementById('digital-clock').innerHTML = hour + ':' + min + ':' + sec + '' + mid;
            setTimeout(clock, 1000);
        }
    }

    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

</script>
@stack('script')
