
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<!--        <script src="js/bootstrap-datepicker.js"></script>-->
<script src="{{ asset('assets/dist/js/standalone/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/ru.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/transition.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/collapse.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script type="text/javascript">

    //            $('select').selectize();

</script>

<script type="text/javascript">

    var price_1 = 0;
    var price_child_1 = 0;
    var price_infant_1 = 0;
    var price_2 = 0;
    var price_child_2 = 0;
    var price_infant_2 = 0;
    var adult_count = {{ $adult_count }};
    var child_count = {{ $child_count }};
    var infant_count = {{ $infant_count }};
    var result_price = 0;

    $(function () {
        
        
        $('#swap').click(function() {
            var tmp = document.getElementById('fromAddress').value;
            document.getElementById('fromAddress').value = document.getElementById('toAddress').value;
            document.getElementById('toAddress').value = tmp;
        });

        $('#checkDir').click(function(){
            $(this).toggleClass('checked');
            $('#secondDate').toggleClass('visible');
        });

        $('#datetimepickerdate1').datetimepicker({
            language: 'ru',
            minDate: moment(),
            pickTime: false
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


    });
</script>
<!-- start -->

<script type="text/javascript">

        $('input:radio[name="radio_fl_out"]').change(
            function(){
                if ($(this).is(':checked')) {
                    $('input:radio[name="radio_fl_out"]').removeClass('selected');
                    $('input:radio[name="radio_fl_out"]').parent().parent().removeClass('info');
                    $(this).addClass('selected');
                    var parentTr = $(this).parent().parent();
                    parentTr.addClass('info');
                    var flNumber = parentTr.attr('data-number');
                    var flPrice = parentTr.attr('data-price');
                    var flPrice_child = parentTr.attr('data-child-price');
                    var flPrice_infant = parentTr.attr('data-infant-price');
                    var flFromDate = parentTr.attr('data-from-date');
                    var flFromTime = parentTr.attr('data-from-time');
                    var flToDate = parentTr.attr('data-to-date');
                    var flToTime = parentTr.attr('data-to-time');
                    var flFromCity = parentTr.attr('data-from-city');
                    var flFromAirport = parentTr.attr('data-from-airport');
                    var flToCity = parentTr.attr('data-to-city');
                    var flToAirport = parentTr.attr('data-to-airport');
                    var timestamp = parentTr.attr('data-timestamp');
                    $('input#flight_1').val(timestamp);
                    $('.toTable').slideDown(400);

                    $('.order-info').css('display', 'block');

                    $('.fl_out_header').css('display', 'table-row').addClass('cont_btn');
                    $('.fl_out_num_price').css('display', 'table-row');
                    $('.fl_out_dirs').css('display', 'table-row');
                    
                    $('.fl_out_num_price .order-number-num').html(flNumber);
                    $('.fl_out_num_price .order-fl-price').html(flPrice);
                    $('.fl_out_dirs .order-fromCity').html(flFromCity);
                    $('.fl_out_dirs .order-fromAirport').html(flFromAirport);
                    $('.fl_out_dirs .order-fromDate').html(flFromDate);
                    $('.fl_out_dirs .order-fromTime').html(flFromTime);
                    $('.fl_out_dirs .order-toCity').html(flToCity);
                    $('.fl_out_dirs .order-toAirport').html(flToAirport);
                    $('.fl_out_dirs .order-toDate').html(flToDate);
                    $('.fl_out_dirs .order-toTime').html(flToTime);
                    @if (count($fly_days_return) == 0) $('.continue-btn').removeClass('hidden'); @endif
                    calculate_flight_fee(1, flPrice, flPrice_child, flPrice_infant);
                }
            }
        );

        $('input:radio[name="radio_fl_in"]').change(
            function(){
                if ($(this).is(':checked')) {
                    $('input:radio[name="radio_fl_in"]').removeClass('selected');
                    $('input:radio[name="radio_fl_in"]').parent().parent().removeClass('info');
                    $(this).addClass('selected');
                    var parentTr = $(this).parent().parent();
                    parentTr.addClass('info');

                    var flNumber = parentTr.attr('data-number');
                    var flPrice = parentTr.attr('data-price');
                    var flPrice_child = parentTr.attr('data-child-price');
                    var flPrice_infant = parentTr.attr('data-infant-price');
                    var flFromDate = parentTr.attr('data-from-date');
                    var flFromTime = parentTr.attr('data-from-time');
                    var flToDate = parentTr.attr('data-to-date');
                    var flToTime = parentTr.attr('data-to-time');
                    var flFromCity = parentTr.attr('data-from-city');
                    var flFromAirport = parentTr.attr('data-from-airport');
                    var flToCity = parentTr.attr('data-to-city');
                    var flToAirport = parentTr.attr('data-to-airport');
                    var timestamp = parentTr.attr('data-timestamp');
                    $('input#flight_2').val(timestamp);

                    $('.order-info').css('display', 'block');

                    $('.fl_in_header').css('display', 'table-row').addClass('cont_btn');
                    $('.fl_in_num_price').css('display', 'table-row');
                    $('.fl_in_dirs').css('display', 'table-row');

                    $('.fl_in_num_price .order-number-num').html(flNumber);
                    $('.fl_in_num_price .order-fl-price').html(flPrice);
                    $('.fl_in_dirs .order-fromCity').html(flFromCity);
                    $('.fl_in_dirs .order-fromAirport').html(flFromAirport);
                    $('.fl_in_dirs .order-fromDate').html(flFromDate);
                    $('.fl_in_dirs .order-fromTime').html(flFromTime);
                    $('.fl_in_dirs .order-toCity').html(flToCity);
                    $('.fl_in_dirs .order-toAirport').html(flToAirport);
                    $('.fl_in_dirs .order-toDate').html(flToDate);
                    $('.fl_in_dirs .order-toTime').html(flToTime);
                    calculate_flight_fee(2, flPrice, flPrice_child, flPrice_infant);
                }
            });

        $(document).change(function(){
            @if(count($fly_days_return) > 0)
            if(($('.fl_in_header').hasClass('cont_btn')) && ($('.fl_out_header').hasClass('cont_btn'))){
                $('.continue-btn').removeClass('hidden');
            }
            @else
            if($('.fl_in_header').hasClass('cont_btn')){
                $('.continue-btn').removeClass('hidden');
            }
            @endif
        });
        
        function calculate_flight_fee(direction, flPrice, flPrice_child, flPrice_infant){
            result_price = 0;
            if (direction==1) {
                price_1 = parseInt(flPrice);
                price_child_1 = parseInt(flPrice_child);
                price_infant_1 = parseInt(flPrice_infant);
            }
            else {
                price_2 = parseInt(flPrice);
                price_child_2 = parseInt(flPrice_child);
                price_infant_2 = parseInt(flPrice_infant);
            }
            result_price = price_1 * adult_count + price_child_1 * child_count + price_infant_1 * infant_count + price_2 * adult_count + price_child_2 * child_count + price_infant_2 * infant_count;
            $('#order_total_sum').html(result_price);
            
        }
</script>

<!-- new design -->
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
    <!-- end new design scripts-->

</body>

</html>