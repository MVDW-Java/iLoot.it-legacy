<html>
<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<style>
.adBanner {
    background-color: transparent;
    height: 1px;
    width: 1px;
}
</style>
<script>
	var blocked = false;

	$(document).ready(function(){
		$("body").show();

		$.get( "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", function( data ) {
			console.log(data.length);
			if(data.length === 0){
				blocked = true;
			}
		});


		check()
	});


	function check() {
    		setTimeout(function () {

			if(blocked) {
				$( "body" ).empty();
				$('body').append('<div>ADBLOCKER</div>');   
			} else {
				alert('No AdBlock :) ');
			}
    		}, 2000);
	}

</script>
</head>
<body>
<div id="wrapfabtest">
    <div class="adBanner">
    </div>
</div>