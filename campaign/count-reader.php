<?php
$url = $_POST['url'];
//hard coded url for demo only, remove the follwoing line before using floatShare
$url = 'http://www.google.com';
echo get_data($_POST['type'],$url);
function get_data($type,$url)
{
    $count =0;
	switch($type)
	{
	 case 'twitter':	 
		$content = parse("http://cdn.api.twitter.com/1/urls/count.json?url=".$url);		
			$json = json_decode($content);			
			$result['count'] = $json->count;
			if( !isset($result['count']) ) $result['count'] = 0;		
			$count  = format_count($result['count']);
		break;
	 case 'stumbleupon':	
		 $content = parse("http://www.stumbleupon.com/services/1.01/badge.getinfo?url=".$url);	
		    $json = json_decode($content);			
			$result['count'] = $json->result->views;
			if( !isset($result['count']) ) $result['count'] = 0;
			$count  = format_count($result['count']);			
		break;
	 case 'googleplus':	 
		  $content = parse("https://plusone.google.com/u/0/_/+1/fastbutton?url=".$url."&count=true");
		  $dom = new DOMDocument;
		  $dom->preserveWhiteSpace = false;
		  @$dom->loadHTML($content);
		  $domxpath = new DOMXPath($dom);
		  $newDom = new DOMDocument;
		  $newDom->formatOutput = true;
		  
		  $filtered = $domxpath->query("//div[@id='aggregateCount']");
		  $result['count'] = str_replace('>', '', $filtered->item(0)->nodeValue);		 
		  $count  = $result['count'];		  
		break;
	 case 'facebook':		
		$content = parse("http://graph.facebook.com/?id=".$url);			
		    $json = json_decode($content);			
			try{
				$result['count'] = $json->likes;
			}
			catch(Exception $e)
			{
				$result['count'] =0;
				
			}
			if($result['count'] == 0)
			{
				try{
				$result['count'] = $json->shares;
				}
				catch(Exception $e)
				{
					$result['count'] =0;
					
				}			
			}		
			
			if( !isset($result['count']) ) $result['count'] = 0;			
			
			$count  = format_count($result['count']);
			break;
			
			case 'linkedin':
			
			$content = parse("http://www.linkedin.com/countserv/count/share?format=jsonp&url=".$url);			
			$content = substr_replace($content, '', 0,26);
			$startIndex = strlen($content);
			$content = substr_replace($content, '', $startIndex-2, 2);		
		    $json = json_decode($content);				
			try{
				$result['count'] = $json->count;
			}
			catch(Exception $e)
			{
				$result['count'] =0;				
			}
			if( !isset($result['count']) ) $result['count'] = 0;						
			$count  = format_count($result['count']);
			break;
	}
	return $count;
}
function format_count($count)
{
	if($count > 1000000)
		return ''.number_format(($count /1000000),1,'.','').'M';
	if($count> 1000)
		return ''.number_format(($count/1000),1,'.','').'K';
	else 
		return ''.$count;
	
}
function curl_download($Url){
 
    // is cURL installed yet?
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
 
    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();
 
    // Now set some options (most are optional)
 
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $Url);
 
    // Set a referer
    //curl_setopt($ch, CURLOPT_REFERER, "http://www.egrappler.com/");
 
    // User agent
    curl_setopt($ch, CURLOPT_USERAGENT, "EGrappler");
 
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
    // Download the given URL, and return output
    $output = curl_exec($ch);
	$err = curl_errno($ch);
    $errmsg = curl_error($ch);
    
    // Close the cURL resource, and free system resources
    curl_close($ch);
 //return 'page fetched';
   if ($errmsg != '')
	return $errmsg;	
   else if($err != '') 
    return $err;
   else
    return $output;
}
function parse($encUrl){

    $options = array(
      CURLOPT_RETURNTRANSFER => true, // return web page
      CURLOPT_HEADER => false, // don't return headers
      CURLOPT_FOLLOWLOCATION => true, // follow redirects
      CURLOPT_ENCODING => "", // handle all encodings
      CURLOPT_USERAGENT => 'sharrre', // who am i
      CURLOPT_AUTOREFERER => true, // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
      CURLOPT_TIMEOUT => 10, // timeout on response
      CURLOPT_MAXREDIRS => 3, // stop after 10 redirects
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => false,
    );
    $ch = curl_init();
    
    $options[CURLOPT_URL] = $encUrl;  
    curl_setopt_array($ch, $options);
    
    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    
    curl_close($ch);
    
    if ($errmsg != '' || $err != '') {
      
    }
    return $content;
  }
?>