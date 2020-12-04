<?php
// Set your own time zone
date_default_timezone_set("Europe/Warsaw"); 

// Bot API key. More: https://core.telegram.org/bots
$telegrambot='';
// Telegram chat ID
$telegramchatid=0;  

function send_message_telegram($msg) {
        global $telegrambot,$telegramchatid;
        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';
        $data=array('chat_id'=>$telegramchatid,'text'=>$msg);
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
}

function loghttp($targetFile) {
	$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $at = date("h:i:sa");
	$data = sprintf(
		"FROM:%s\tAT:%s\n\n%s %s %s\n\nHTTP headers:\n",
		$ip,
		$at,
		$_SERVER['REQUEST_METHOD'],
		$_SERVER['REQUEST_URI'],
		$_SERVER['SERVER_PROTOCOL']
	);
	$body = file_get_contents('php://input');


	foreach ($_SERVER as $name => $value) {
		if (preg_match('/^HTTP_/',$name)) {
			// convert HTTP_HEADER_NAME to Header-Name
			$name = strtr(substr($name,5),'_',' ');
			$name = ucwords(strtolower($name));
			$name = strtr($name,' ','-');
			// add to list
			$data .= $name . ': ' . $value . "\n";
		}
	}

	$data .= "\nRequest body:\n".$body;
    
    $fp = fopen($targetFile, 'a');
	fwrite($fp, $data . "\n");
	fclose($fp);
    
    send_message_telegram($data);

	echo("<h2>Logged ...</h2>");
}


loghttp("dumprequest.txt");



?>