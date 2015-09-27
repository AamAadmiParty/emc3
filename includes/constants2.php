<?php
$action = get('action');
$action1 = get('action1');
$page = get('page');

$pagename=curPageName();
$pageurl=CurPageQS();

$date=date("Y-m-d H:i:s");
$date2=date("Y-m-d");
$thisyear=date("Y");
$page_per_set=6;
 
$getconnected= array("","Yes","Wrong Number","Call Later","Not Reached");
$vote4aap= array("No","Yes","Undecided");
$mstatus= array("No","Yes","Block");
?>