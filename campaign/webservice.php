<?php

// Request Yahoo! REST Web Service using
// HTTP POST with curl. PHP4/PHP5
// Allows retrieval of HTTP status code for error reporting
// Author: Jason Levitt
// February 1, 2006

error_reporting(E_ALL);

// The POST URL and parameters
$request =  'http://54.200.6.37/aapmc3/services/call/save';

$callerLocation = 'MU';
$receiverNumber = '9871139137';
$callerNumber = '9871139137';
$feedbackOne="Yes";
$callerName="Sekhar";
$callStarted="1383719719200";
$callStatus="Success";
$receiverLocation="Delhi";

$postargs = 'callerLocation='.$callerLocation.'&receiverNumber='.$receiverNumber.'&callerNumber='.$callerNumber.'&feedbackOne='.$feedbackOne.'&callerName='.$callerName.'&callStarted='.$callStarted.'&callStatus='.$callStatus.'&receiverLocation='.$receiverLocation;

// Get the curl session object
$session = curl_init($request);

// Set the POST options.
curl_setopt ($session, CURLOPT_POST, true);
curl_setopt ($session, CURLOPT_POSTFIELDS, $postargs);
curl_setopt($session, CURLOPT_HEADER, true);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// Do the POST and then close the session
$response = curl_exec($session);
curl_close($session);

// Get HTTP Status code from the response
$status_code = array();
preg_match('/\d\d\d/', $response, $status_code);

// Check for errors
switch($status_code[0] ) {
	case 200:
		// Success
		break;
	case 503:
		die('Your call to Yahoo Web Services failed and returned an HTTP status of 503. That means: Service unavailable. An internal problem prevented us from returning data to you.');
		break;
	case 403:
		die('Your call to Yahoo Web Services failed and returned an HTTP status of 403. That means: Forbidden. You do not have permission to access this resource, or are over your rate limit.');
		break;
	case 400:
		// You may want to fall through here and read the specific XML error
		die('Your call to Yahoo Web Services failed and returned an HTTP status of 400. That means:  Bad request. The parameters passed to the service did not match as expected. The exact error is returned in the XML response.');
		break;
	default:
		die('Your call to Yahoo Web Services returned an unexpected HTTP status of:' . $status_code[0]);
}

// Get the XML from the response, bypassing the header
if (!($xml = strstr($response, '<?xml'))) {
	$xml = null;
}

// Output the XML
echo htmlspecialchars($xml, ENT_QUOTES);
?>