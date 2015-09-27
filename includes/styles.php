<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Aam Aadmi Party - Delhi Citizen Call campaign</title>
<meta name="keywords" content="<?php if(isset($row['keywords'])&& $row['keywords']!="")echo $row['keywords'];?>" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css' />
<meta name="Description" content= "A Delhi Citizen Call Campaign by Aam Aadmi Party supporters around the Globe!!Please join this effort!
" />
<link rel="image_src" href="http://emc3.aamaadmiparty.org/images/emc3.png" />
<meta content="http://emc3.aamaadmiparty.org/images/emc3.png" property="og:image" />
<meta content="Aam Aadmi Party" property="og:title" />
<meta content="A Delhi Citizen Call Campaign by Aam Aadmi Party supporters around the Globe!!Please join this effort!" property="og:description" />
<meta content="http://emc3.aamaadmiparty.org/" property="og:url" />
<meta name="robots" content="index, follow"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/nav2.css"  />
<link href="css/aam-admi-party.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" language="javascript" src="js/jqueryv.js"></script>
<script type="text/javascript" src="js/top.js"></script>
<script type="text/javascript" src="js/scroll.js"></script>
<link href="css/scrolltop.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/scrolltop.js"></script>
<script type="text/javascript" src="js/jquery.jcountdown1.3.3.js"></script>
<link href="css/countdown.css" type="text/css" rel="stylesheet" />

<link rel="shortcut icon" href="favicon.ico" />
<script>
jQuery( document ).ready( function( $ ) {
	
		$('body').addClass('js');
		  var $menu = $('#menu'),
		  	  $menulink = $('.menu-link'),
		  	  $menuTrigger = $('.has-submenu > a');

		$menulink.click(function(e) {
			e.preventDefault();
			$menulink.toggleClass('active');
			$menu.toggleClass('active');
		}); 
		
		$menuTrigger.click(function(e) {
			e.preventDefault();
			var $this = $(this);
			$this.toggleClass('active').next('ul').toggleClass('active');
		});
		
/* Change the time to count down to */
	$("#time").countdown({
		date: "dec 04, 2013 10:00:00", /* Counting to a date */
		offset: 1,
		hoursOnly: false,
		onComplete: function( event ) {
		
			$(this).html("<span class='complete'>The site will launch today!</span>");
			$("#progressbar").css("display", "none"); /* When the countdown reaches above 100%, there's no use in displaying the progressbar */
			$(".tool").css("display", "none");
		},
		leadingZero: true
		
	}); 
	 	
});
</script>