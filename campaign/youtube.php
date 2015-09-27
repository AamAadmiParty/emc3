<?php
include("includes/app_top.php");
$getid = get('id');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<title><?php echo $sitename;?> Video</title>
	
	<meta name="viewport" content="width=device-width"> 
	
	<style>
		* { margin: 0; padding: 0; }
		body script { display: block; white-space: pre; font: 11px Monaco, MonoSpace; margin: 0; }
		h1 { font: bold 50px/1 Sans-Serif; letter-spacing: -2px; margin: 0 0 20px 0; }

		body { width: 99%;}
		iframe { width: 100%; margin: 0; }
		@media (max-width: 480px) {
			body { width: 99%; }
		}
		
	</style>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript"> 

$(function() {
  /*  parent.$.colorbox.resize({
        innerWidth:$('body').width(),
        innerHeight:$('body').height()
    });*/
	
	

	// Find all YouTube videos
	var $allVideos = $("iframe[src^='http://www.youtube.com']"),

	    // The element that is fluid width
	    $fluidEl = $("body");

	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {

		$(this)
			.data('aspectRatio', this.height / this.width)
			
			// and remove the hard coded width/height
			.removeAttr('height')
			.removeAttr('width');

	});

	// When the window is resized
	// (You'll probably want to debounce this)
	$(window).resize(function() {

		var newWidth = $fluidEl.width();
		
		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {

			var $el = $(this);
			$el
				.width(newWidth)
				.height(newWidth * $el.data('aspectRatio'));

		});

	// Kick off one resize to fix all videos on page load
	}).resize();



});
</script>    
</head>
<body>
<iframe width="450" height="300" src="http://www.youtube.com/embed/<?php echo $getid;?>?autoplay=1&rel=0&amp;hd=1" frameborder="0" allowfullscreen></iframe>

</body>
</html>
