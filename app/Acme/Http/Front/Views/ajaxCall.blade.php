<html>
<head>
<meta name="_token" content="{!! csrf_token() !!}"/>
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
	background: url(images/ajax-loader.gif) center no-repeat #fff;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script>
$( document ).ready(function() {
    $.ajax({
	  method: "POST",
	  type: "post",
	  url: "{{ route('front.ajaxRequest') }}",
	  data: { departure: "<?php echo $departure;?>", departure_date: "<?php echo $departure_date;?>", destination: "<?php echo $destination;?>", return_date: "<?php echo $return_date;?>", adult_count: "<?php echo $adult_count;?>", child_count: "<?php echo $child_count;?>",  infant_count: "<?php echo $infant_count;?>"}
	})
	  .done(function( msg ) {
	  	$(".se-pre-con").fadeOut("slow");
	  	<?php $return_date = ($return_date)? $return_date:0;?>
		window.location.replace("{{ route('front.result',['o'=>$departure, 'od'=>$departure_date,'d'=>$destination,'dd'=>$return_date,'a'=>$adult_count,'c'=>$child_count,'i'=>$infant_count]) }}");
		});
});
</script>
</head>
<BODY>
<div class="se-pre-con">Пожалуйста подождите ...</div>



</BODY>
</html>