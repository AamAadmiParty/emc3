//Copy Right
function copyright() {	
	var startYear="2010";
    date = new Date();
    year = date.getFullYear();
    if ( (year - startYear) > 0){ 

       document.write(startYear + "-" + year);
    }else{
     document.write(startYear);
    } 
}


function EmbedFlash(swf,w,h){
// Main Flash animation - XHTML 1.0 compliant workaround for IE and Firefox (write as javascript rather then embed HTML))
document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" id="main01" width="'+w+'" height="'+h+'">');
document.write('<param name="movie" value="'+swf+'"/>');
document.write('<param name="quality" value="high"/>');
document.write('<param name="base" value=""/>');
document.write('<param name="wmode" value="transparent"/>');
document.write('<param name="loop" value="true"/>');
document.write('<embed type="application/x-shockwave-flash" wmode="transparent" src="'+swf+'" width="'+w+'" height="'+h+'"></embed>');
document.write('</object>');	
}


function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}


function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

   

function CheckEmail(address) {
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(address)){
	return (true)
	}
	return (false)
}


function IsChar(strString)
{

var strValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.' "; 

 var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
 return blnResult;	
	}

function IsNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789.-";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
 return blnResult;
} 


function IsPhoneNo(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789.- ()";
   var strNumbers= "0123456789";
   var strChar;
   var blnResult = true;
	j=0;
   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
		 if (strNumbers.indexOf(strChar) != -1)
         {
         j++;
         }		 
      }
	  if(j!=10) 
	  {
         blnResult = false;
         }
 return blnResult;
} 

function getCheckedRadio(rname) {
var radioButtons = document.getElementsByName(rname);
for (var x = 0; x < radioButtons.length; x ++) {
if (radioButtons[x].checked) {
return radioButtons[x].value;
}
}
}

$(function() {

            function runEffect() { 
                $("#messages").hide(500);
            };

                $("#messages").click(function() {
                        runEffect();
                        return false;
                }); 
        });


 function popup2(URL,w,h) {
     var winl = (screen.width - w) / 2;
     var wint = (screen.height - h) / 2;
     winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+'resizable=1,scrollbars=yes'
   window.open(URL, "", winprops)
 } 


function validateenquiry(form){
if (form.name.value=='') {alert('Please enter your name'); form.name.focus(); return false}
if (!IsChar(form.name.value) && form.name.value!="") {alert('Special Characters, Numerics not allowed in name'); form.name.focus(); return false}
if (form.email.value=='') {alert('Please enter email'); form.email.focus(); return false}
if (!CheckEmail(form.email.value)) {alert('Invalid email id'); form.email.focus(); return false}
if (form.security_code.value=='') {alert('Please provide the security code provided below');form.security_code.focus();return false}
return true;
}
function displayadd()
{
document.getElementById("addrecord").style.display="block";	
}
function closeadd()
{
document.getElementById("addrecord").style.display="none";	
}

function chk_pass(form)
{
 if(form.old.value==""){alert("Please Enter Old Password.");form.old.focus();return false;}
  if(form.newpass.value==""){alert("Please Enter New Password.");form.newpass.focus();return false;}
  if(form.newpass2.value==""){alert("Please Confirm Your New Password.");form.newpass2.focus();return false;}
  if(form.newpass2.value!=form.newpass.value){alert("Password does not match.");form.newpass.focus();return false;}
return true;   
}

function chk_pass2(form)
{
  if(form.newpass.value=="") {   alert("Please Enter New Password.");form.newpass.focus();	return false;  }
 if((eval(form.newpass.value.length)<6)){alert("Password should be minimum 6 characters");form.newpass.focus();return false;}	
  if(form.newpass2.value=="")   {    alert("Please Confirm Your New Password.");form.newpass2.focus();	 return false;  }
  if(form.newpass2.value!=form.newpass.value)  {  alert("New password and Confirm password should be given same values"); form.newpass.focus();	 return false; }
  }

function  validatefp(form)
{
if (form.email.value=='') {alert('Please enter email'); form.email.focus(); return false}
if (!CheckEmail(form.email.value)) {alert('Invalid email id'); form.email.focus(); return false}
return true;
}


$(document).ready(function() {


$(".close_editbox").click(function() {
   var parent = $(this).parent().parent().parent().parent().parent();
   parent.fadeOut(500,function() {
					parent.remove();
					scroll(0,0);
				});    
});

						   
$('a.familydelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this family details?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=members_family',
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

				   
$('a.participantdelete').click(function(e) {
		e.preventDefault();
		 var1=confirm("Do you want to Delete this participant?");
    if(var1)
	{
		var parent = $(this).parent().parent();
		$.ajax({
			type: 'post',
			url: 'delete_item.php',
			data: 'id=' + $(this).attr('id')+'&t=program_participants',
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

  function validatelogin(form) {	
	if(form.email.value==""){alert("Please enter Email ID");form.email.focus();return false;}
	if (!CheckEmail(form.email.value)) {alert('Invalid email id'); form.email.focus(); return false}	
	if(form.password.value==""){alert("Please enter password");form.password.focus();return false;}
}