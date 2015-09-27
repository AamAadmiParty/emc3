/* Calculate for youself how many days there's left before the site launches. You can also check the counter after you set the date in the below code. Just write the startDays only once! Example: If you know your site will launch in exactly 1 year, you should write 365 days in the startDays. This way we can calculate the percentage done. */
 var startDays = 500;
$(document).ready(function(){	
	/* Change the time to count down to */
	$("#time").countdown({
		date: "dec 04, 2013 02:30:00", /* Counting to a date */
		offset: 1,
		hoursOnly: false,
		onComplete: function( event ) {
		
			$(this).html("<span class='complete'>The site will launch today!</span>");
			$("#progressbar").css("display", "none"); /* When the countdown reaches above 100%, there's no use in displaying the progressbar */
			$(".tool").css("display", "none");
		},
		leadingZero: true
		
	});
	
	/* The percentage of the progressbar */
	$("#progressbar").progressbar({
		value: percent
	});
	
	/* The position of the tooltip, where the percentage number is in */
	$("#percentage .tool").css({
		marginLeft: percent +"%"
	}).append(percent+"%"); 
	   
});