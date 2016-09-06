<html>
<head>
<style>
/* Paste this css to your style sheet file or under head tag */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	text-align:center;
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(assets/images/ajax-loader.gif) center no-repeat #fff;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script>
$( document ).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    $.ajax({
	  method: "POST",
	  type: "post",
	  url: "{{ route('front.get_available_tickets') }}",
	  data: { departure: "<?php echo $departure;?>", departure_date: "<?php echo $departure_date;?>", destination: "<?php echo $destination;?>", return_date: "<?php echo $return_date;?>", adult_count: "<?php echo $adult_count;?>", child_count: "<?php echo $child_count;?>",  infant_count: "<?php echo $infant_count;?>"}
	})
	  .done(function( msg ) {
	  	$(".se-pre-con").fadeOut("slow");
		if (  msg['result']=='1' ) window.location.replace("booking.php?o=<?php echo $departure;?>&od=<?php echo $departure_date;?>&d=<?php echo $destination;?>&dd=<?php echo $return_date;?>&a=<?php echo $adult_count;?>&c=<?php echo $child_count;?>&i=<?php echo $infant_count;?>");	
		else window.location.replace("error.php");	
	  });
});
</script>
</head>

<BODY>
<div class="se-pre-con">[translate]LOADING ... PLEASE WAIT ...</div>



</BODY>
</html>