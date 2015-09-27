<?php
$callerLocation="Delhi";
$receiverNumber="7827227227";
$callerNumber="9999999999";
$feedback="Test";
$callStatus="Success";
$callEnded=1;
$callStarted=1;
$receiverLocation="Delhi";
$fields = array(
	'callerLocation'=>urlencode($callerLocation),
	'receiverNumber'=>urlencode($receiverNumber),
	'callerNumber'=>urlencode($callerNumber),
	'feedback'=>urlencode($feedback),
	'callStatus'=>urlencode($callStatus),
    'callEnded'=>urlencode($callEnded*1000),
    'callStarted'=>urlencode($callStarted*1000),
    'receiverLocation'=>urlencode($receiverLocation)
);

$fields_string = '';

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');
 
$url = "http://54.200.6.37/aapmc3/services/call/save";     
 
//open connection
$ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch,CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
?>