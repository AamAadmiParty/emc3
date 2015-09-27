<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Citizen Call Campaign - Admin</title>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen" />
<!-- Mission C3 admin styles -->
<link href="../css/admin-style.css" rel="stylesheet" media="screen" />

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="../css/noJS.css"  />
<link rel="stylesheet" href="ui/ui-lightness/jquery.ui.all.css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/top.js"></script>
<script src="../js/go-top.js" type="text/javascript"></script>
<script src="ui/jquery.ui.core.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.widget.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.accordion.js" type="text/javascript"></script>
    <script src="ui/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script src="ui/jquery.ui.mouse.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.draggable.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.position.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.resizable.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.button.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.dialog.js" type="text/javascript"></script>
	<script src="ui/jquery.ui.effect.js" type="text/javascript"></script>
    <script src="ui/jquery.ui.tooltip.js" type="text/javascript"></script>
    <script src="ui/jquery.ui.menu.js" type="text/javascript"></script>
    <script src="ui/jquery.ui.autocomplete.js" type="text/javascript"></script>
<link rel="shortcut icon" href="../favicon.ico" />
<script src="../js/delete_item.js" type="text/javascript"></script>
<script type="text/javascript">
			
			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-3').removeClass('active');
				});

			});
		
		</script>
<script type="text/javascript">
		$(function() {
		$( ".ui-accordion" ).accordion({
			collapsible: true,
			heightStyle: "content"
		});
		
		// date picker
		$(function() {
		$(function() {
		$( ".datepicker" ).datepicker({
			altField: "#alternate",
			altFormat: "DD, d MM, yy"
		});
	});});});
</script>