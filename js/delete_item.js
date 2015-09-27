$(document).ready(function() {

$('a.memberdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this member?");
    if(var1)
	{
	 var2=confirm("Are you sure delete all data about this member?");
    if(var2)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=users',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	}
	});
 $('a.contdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this Contact?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=contacts',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	
	});
 $('a.feddelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this feedback?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=feedback',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	
	});
 $('a.ocontdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this Contact?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=other_contacts',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	
	});
 $('a.prbdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this Report?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=problems',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	
	});
	 
 $('a.vntdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this Request for volunteering?");
    if(var1)
	{	 
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=volunteer',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	
	});
 
 
 $('a.ntdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this template?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=email_templates',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	});
 		
	$('a.videodelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this video?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=videos',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	}); 	
$('a.newsdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this news?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=news',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	}); 
	
	$('a.statedelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this state?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=states',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	}); 
 $('a.ucdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Remove contact from this user?");
    if(var1)
	{
	 	var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item2.php',
			data: 'id=' + $(this).attr('id')+'&t=contacts',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		}); 	
		}
	});	
		

		
 $('a.csdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this state?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=constituencies',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	 }
	});
	
		
 $('a.cddelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this constituency?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=constituency_details',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	 }
	});	
		
 $('a.catdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this category?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=categories',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	 }
	});
 
$('a.admindelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this admin?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=admins',
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FAF9C9'},200);
			},
			success: function(html) {
				parent.fadeOut(500,function() {
					parent.remove();	
					$('#messages').html(html);
					 $("#messages").show();	
					scroll(0,0);
				});
			}
		});
	}
	});	 
});
	 
 
 function change_status(tablename, id)
	{
		$.ajax({
			type: 'post',
			url: 'change_status.php',
			data: 'id=' + id+'&t='+tablename,
			success: function(html) {
			if(html==1)
			{
			$('#statusimg_'+id).removeClass('icon-ban-circle');
			$('#statusimg_'+id).addClass('icon-ok');
			}
			else
			{
				$('#statusimg_'+id).removeClass('icon-ok');
				$('#statusimg_'+id).addClass('icon-ban-circle');
			}
		//alert(html);	
		$('#messages').html("<div class='alert alert-success'>Changed Status Successfully</div>");
		//$('#messages').html(html);
		 $("#messages").show();	
		scroll(0,0);
			}
		});
		
}

function change_statusb(tablename, id)
	{
		$.ajax({
			type: 'post',
			url: 'change_statusb.php',
			data: 'id=' + id+'&t='+tablename,
			success: function(html) {
			if(html==1)
			{
			$('#statusimg_'+id).removeClass('icon-ban-circle');
			$('#statusimg_'+id).addClass('icon-ok');
			}
			else
			{
				$('#statusimg_'+id).removeClass('icon-ok');
				$('#statusimg_'+id).addClass('icon-ban-circle');
			}
		//alert(html);	
		$('#messages').html("<div class='alert alert-success'>Changed Status Successfully</div>");
		//$('#messages').html(html);
		 $("#messages").show();	
		scroll(0,0);
			}
		});
		
}

function change_status2(tablename, id)
	{
		$.ajax({
			type: 'post',
			url: 'change_status2.php',
			data: 'id=' + id+'&t='+tablename,
			success: function(html) {
			if(html==1)
			{
			$('#statusimg_'+id).removeClass('icon-ban-circle');
			$('#statusimg_'+id).addClass('icon-ok');
			}
			else
			{
				$('#statusimg_'+id).removeClass('icon-ok');
				$('#statusimg_'+id).addClass('icon-ban-circle');
			}
		//alert(html);	
		$('#messages').html("<div class='alert alert-success'>Changed Status Successfully</div>");
		//$('#messages').html(html);
		 $("#messages").show();	
		scroll(0,0);
			}
		});
}
function change_statusg(tablename, id)
	{
		$.ajax({
			type: 'post',
			url: 'change_statusg.php',
			data: 'id=' + id+'&t='+tablename,
			success: function(html) {	
			var img = document.getElementById('statusig_'+id);
			if(img.getAttribute('src')=='../images/ico_activate.gif')
			img.src='../images/ico_deactivate.gif';
			else
			img.src='../images/ico_activate.gif';
			
		$('#messages').html('<div class="alert alert-success">Changed Status Successfully</div>');
		 $("#messages").show();	
		scroll(0,0);
			}
		});
}

function change_status5(tablename, id)
	{
		$.ajax({
			type: 'post',
			url: 'change_status5.php',
			data: 'id=' + id+'&t='+tablename,
			success: function(html) {
			if(html==1)
			{
			$('#statusimg5_'+id).removeClass('icon-ban-circle');
			$('#statusimg5_'+id).addClass('icon-ok');
			}
			else
			{
				$('#statusimg5_'+id).removeClass('icon-ok');
				$('#statusimg5_'+id).addClass('icon-ban-circle');
			}
		//alert(html);	
		$('#messages').html("<div class='alert alert-success'>Changed Status of Show in Home</div>");
		//$('#messages').html(html);
		 $("#messages").show();	
		scroll(0,0);
			}
		});
}

function change_status3(tablename, id)
	{
		$.ajax({
			type: 'post',
			url: 'change_status3.php',
			data: 'id=' + id+'&t='+tablename,
			success: function(html) {
			if(html==1)
			{
			$('#statusv_'+id).html("Home");			
			$('#statusv_'+id).addClass('nolink');
			}
			else
			{
				$('#statusv_'+id).removeClass('nolink');
				$('#statusv_'+id).html("Show in Home");				
			}
		//alert(html);	
		$('#messages').html(html);
		 $("#messages").show();	
		scroll(0,0);
			}
		});
}

   
