</div>

<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/dist/js/standalone/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/ru.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/transition.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/collapse.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.mobile.custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.js') }}"></script>

<script type="text/javascript">
    $("#userInfoForm").validate();
</script>

<script>
    $(document).ready(function() {
        $(".carousel-inner").swiperight(function() {
            $(this).parent().carousel('prev');
        });
        $(".carousel-inner").swipeleft(function() {
            $(this).parent().carousel('next');
        });
        
        
        
    });
</script>

<script>
    
    function changeOption(target, max_count){
        var mySelect = $(target);
        var current = mySelect.val();
        mySelect.empty();
        var i = 0;
        if (target == '#adult_count') i=1;
        for(; i<=max_count; i++){
            mySelect.append($('<option></option>').val(i).html(i));
        }
        if (current>0){
            mySelect.val(current);
        }
    }
        
    $(function () {
        $('#adult_count').on('change', function() {
            changeOption('#child_count', 6-this.value);
            changeOption('#infant_count', this.value);
        });
        
        $('#child_count').on('change', function() {
            changeOption('#adult_count', 6-this.value);
        });
        
    
        $('#swap').click (function() {
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
            pickTime: false,
            disabledDates: [
                new Date(2015, 02-1, 12)
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
    });
</script>

<script>
    $(document).ready(function() {
        
        $('#search_submit').on('click', function() {
            
            var message_passenger = "Жүргүнчүнүн саны 6 көп болбосу керек!";
            var message_data = "Маалымат жок!";
            var message_return_data = "Келүүнүн күнү берибеген!";
            
            var valid = true, message='';
            
            var adult = parseInt($( "#adult_count option:selected" ).val());
            var child = parseInt($( "#child_count option:selected" ).val());
            var infant = parseInt($( "#infant_count option:selected" ).val());
            
            var dept_date = $('#departure_date').val();
            var return_date = $('#return_date').val();
            
            if (adult + child > 6) {
                valid = false; 
                message = message_passenger+'\n\t';
            }
            if (dept_date=='') {
                valid = false; 
                message += message_data+'\n\t';
            }
            if ($('#checkDir').is(':checked') && return_date=='') {
                valid = false; 
                message += message_return_data+'\n\t';
            }
            if (!valid) {
                alert(message);
                return false;
            }
            return true;
        });     
    });
</script>
</body>
</html>