<script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/ru.js') }}"></script>
<script src="{{ asset('js/transition.js') }}"></script>
<script src="{{ asset('js/collapse.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
            });

            // header search form
            var searchForm = $('#searchForm');
            var searchToggle = $('#searchToggle');
            var searchClose = $('#searchClose');
            searchToggle.click(function (e) {
                $(this).addClass('hidden');
                searchForm.removeClass('hidden');
            });
            searchClose.click(function (e) {
                if(searchToggle.hasClass('hidden')){
                    searchForm.addClass('hidden');
                    searchToggle.removeClass('hidden');
                }
            });
            // Swap destinations
            $('#swap').click (function() {
                var fromAddress = $('#fromAddress');
                var toAddress = $('#toAddress');
                var tmp = fromAddress.val();
                fromAddress.val(toAddress.val());
                toAddress.val(tmp);
                $('.selectpicker').selectpicker('refresh');
            });
            // Init datepickers
            $('#datetimepickerdate1').datetimepicker({
                language: 'ru',
                minDate: moment(),
                pickTime: false,
                disabledDates: [
                    new Date(2017, 02-1)
                ]
            });
            $('#datetimepickerdate2').datetimepicker({
                language: 'ru',
                pickTime: false
            });
            $("#datetimepickerdate1").on("dp.change",function (e) {
                $('#datetimepickerdate2').data("DateTimePicker").setMinDate(e.date);
            });
            $("#datetimepickerdate2").on("dp.change",function (e) {
                $('#datetimepickerdate1').data("DateTimePicker").setMaxDate(e.date);
            });
            // Change trip type
            $('.flight-type li').click(function (e) {
                var returnDate = $('#datetimepickerdate2');
                if(!$(this).hasClass('current')){
                    $(this).addClass('current');
                    $(this).siblings().removeClass('current');
                    if($(this).hasClass('one-way')){
                        returnDate.addClass('disabled');
                    } else {
                        returnDate.removeClass('disabled');
                    }
                }
            });
        })
    </script>

@yield('footer')


</body>
</html>