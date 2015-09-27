/* ---------------------------- */
/* XMLHTTPRequest Enable */
/* ---------------------------- */
function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
}else{
request_type = new XMLHttpRequest();
}
return request_type;
}

var http = createObject();

/* -------------------------- */
/* INSERT */
/* -------------------------- */
/* Required: var nocache is a random number to add to request. This value solve an Internet Explorer cache issue */
var nocache = 0;
 
function checkcaptcha() {
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('captcha_response').innerHTML = ""
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var scode= encodeURI(document.getElementById('security_code').value);

if(scode!='')
{
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get', 'includes/check.php?scode='+scode+'&nocache = '+nocache);
http.onreadystatechange = scodeReply;
http.send(null);
}
}
 

function scodeReply() {
if(http.readyState == 4){
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
if(response!=0)
{
document.getElementById('captcha_response').innerHTML = response;
if(response!="")
document.getElementById('security_code').value="";
}
}
} 


function isvalidmember(firstname, lastname) {
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get', 'includes/check.php?fname='+firstname+'&lname='+lastname+'&nocache = '+nocache);
http.onreadystatechange = memberReply;
http.send(null);
}
 

function memberReply() {
if(http.readyState == 4){
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
if(response!=0)
{
if(response!="")
{
 
	return false;
}
}
}
} 



function CheckEmail(address) {
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(address)){
	return (true)
	}
	return (false)
}

function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?characters=5&amp;rand="+Math.random()*1000;
	document.getElementById('captcha_response').innerHTML="";
}

var nocache = 0;
function checkmail() {
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('email_response').innerHTML = ""
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var email2 = encodeURI(document.getElementById('email').value);
// Set te random number to add to URL request
nocache = Math.random();
//alert(email2);
// Pass the login variables like URL variable
http.open('get', 'includes/check.php?email='+email2+'&nocache = '+nocache);
http.onreadystatechange = emailReply;
http.send(null);
}
function checkmailr() {
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('email_response').innerHTML = ""
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var email2 = encodeURI(document.getElementById('emailr').value);
// Set te random number to add to URL request
nocache = Math.random();
//alert(email2);
// Pass the login variables like URL variable
http.open('get', 'includes/check.php?emailr='+email2+'&nocache = '+nocache);
http.onreadystatechange = emailReply;
http.send(null);
}
function emailReply() {
if(http.readyState == 4){
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('email_response').innerHTML = response;
//document.getElementById('email').value="";
}
}

function ref()
{
	res=document.getElementById("errorr").innerHTML;
	
	if(res=="Email Id Already Registered.")
	{
		document.getElementById('submit').attributes["type"]= 'button';		
	}
	else
	{
		document.getElementById('submit').attributes["type"]= 'submit';
	}
}  

function checkcontact() {
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('contact_response').innerHTML = ""
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var email2 = encodeURI(document.getElementById('contact').value);
// Set te random number to add to URL request
nocache = Math.random();
//alert(email2);
// Pass the login variables like URL variable
http.open('get', '../includes/check.php?contact='+contact2+'&nocache = '+nocache);
http.onreadystatechange = contactReply;
http.send(null);
}
function contactReply() {
if(http.readyState == 4){
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('contact_response').innerHTML = response;
//document.getElementById('email').value="";
}
}

	
function checkconstituency() {
var keyword = document.getElementById('keyword').value;
if(keyword=="")
{
alert("Enter Constituency Name");	
document.getElementById('keyword').focus();
return false;
	}
else
{	
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('constituency_details').innerHTML = ""
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.

// Set te random number to add to URL request
nocache = Math.random();
//alert(email2);
// Pass the login variables like URL variable
http.open('get', 'includes/constituency.php?keyword='+keyword+'&nocache = '+nocache);
http.onreadystatechange = constituencyReply;
http.send(null);
}
function constituencyReply() {
if(http.readyState == 4){
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('constituency_details').innerHTML = response;
//document.getElementById('email').value="";
}}
}
    	