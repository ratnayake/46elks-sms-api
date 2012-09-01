<?php

class A6elks{
	var $username;
	var $password;
	function __construct($username,$password) {
		$this->username = $username;
		$this->password = $password;
	}
	function Allocate_Number($country = 'se',$sms_url = '',$voice_url = ''){
		$post_var = array('country' => $country);
		if($sms_url != ''){
			$post_var['sms_url'] = $sms_url;
		}
		if($voice_url != '')
		{
			$post_var['voice_url'] = $voice_url;
		}
		$context = stream_context_create(array(
			'http' => array(
						'method' => 'POST',
						'header'  => "Authorization: Basic ".
						base64_encode($this->username.':'.$this->password). "\r\n".
						"Content-type: application/x-www-form-urlencoded\r\n",
						'content' => http_build_query($post_var),
						'timeout' => 10
						)));

		$return = file_get_contents(
			'https://api.46elks.com/a1/Numbers', false, $context );
		if(!empty($return))
		{
			return $return;
		}
		else{
			return false;
		}
	}
	function Modification($id,$sms_url = '',$voice_url = '')
	{
		$post_var = array();
		if($sms_url != ''){
			$post_var['sms_url'] = $sms_url;
		}
		if($voice_url != '')
		{
			$post_var['voice_url'] = $voice_url;
		}
		$context = stream_context_create(array(
			'http' => array(
						'method' => 'POST',
						'header'  => "Authorization: Basic ".
						base64_encode($this->username.':'.$this->password). "\r\n".
						"Content-type: application/x-www-form-urlencoded\r\n",
						'content' => http_build_query($post_var),
						'timeout' => 10
						)));

		$return = file_get_contents(
			"https://api.46elks.com/a1/Numbers/$id", false, $context );
		if(!empty($return))
		{
			return $return;
		}
		else{
			return false;
		}
	}
	function Deallocation(){
		$post_var = array("active" => "no");
		$context = stream_context_create(array(
			'http' => array(
						'method' => 'POST',
						'header'  => "Authorization: Basic ".
						base64_encode($this->username.':'.$this->password). "\r\n".
						"Content-type: application/x-www-form-urlencoded\r\n",
						'content' => http_build_query($post_var),
						'timeout' => 10
						)));

		$return = file_get_contents(
			"https://api.46elks.com/a1/Numbers/$id", false, $context );
		if(!empty($return))
		{
			return $return;
		}
		else{
			return false;
		}
	}
	function SendSMS($from,$to,$message){
		$post_var = array("from" => $from,"to" => $to,"message" => $message);
		$context = stream_context_create(array(
			'http' => array(
						'method' => 'POST',
						'header'  => "Authorization: Basic ".
						base64_encode($this->username.':'.$this->password). "\r\n".
						"Content-type: application/x-www-form-urlencoded\r\n",
						'content' => http_build_query($post_var),
						'timeout' => 10
						)));

		$return = file_get_contents(
			"https://api.46elks.com/a1/SMS", false, $context );
		if(!empty($return))
		{
			return $return;
		}
		else{
			return false;
		}
	}
	
}