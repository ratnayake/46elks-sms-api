<?php
/**
 * Author:  Isuru Ratnayake
 * Link:    http://isuru.ratnayake.info
 *
 *
 * This class allows you to access the 56elks api some funcations need to register phone number and send sms via php.
 *
 * You'll find examples at ../index.php
 *
 * Thanks for downloading, I've provided this as part of the MIT licensing agreement so that you are pretty much
 * free to do whatever you want with it.
 *
 */
class A6elks{
	var $username;
	var $password;
	
	/**
	 * Here is main staring location for every api calls
	 * setting it as part of every instantiation.
	 * @param string $username your api username from 46elks control panel
	 * @param string $password your api password from 46elks control panel
	 */
	function __construct($username,$password) {
		$this->username = $username;
		$this->password = $password;
	}
	
	/**
	 * This method used to Allocate number from 46elks.
	 * all params are optional please set according to your need.
	 * @param  string $country contry code that phone number need to allocate default will be sweden
	 * @param string $sms_url url of your server that sms need to transfer from 46elks server
	 * @param string $voice_start url of your server that content json string to advice 46elks what action should take
	 * @return an array or false based on the sucsess of api call 
	 */
	function Allocate_Number($country = 'se',$sms_url = '',$voice_start = ''){
		$post_var = array('country' => $country);
		if($sms_url != ''){
			$post_var['sms_url'] = $sms_url;
		}
		if($voice_start != '')
		{
			$post_var['voice_start'] = $voice_start;
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

	/**
	 * This method used to Modify voice or sms url after allocate number.
	 * $id is mandatory set other param based on your need.
	 * @param  string $id unique id you got return from Allocate_Number call please note you can't find this from control panel of website.
	 * @param string $sms_url new url of your server that sms need to transfer from 46elks server. if you don't need to modify you can leave it.
	 * @param string $voice_start new url of your server that content json string to advice 46elks what action should take. if you don't need to modify you can leave it.
	 * @return an array or false based on the sucsess of api call 
	 */
	function Modification($id,$sms_url = '',$voice_start = '')
	{
		$post_var = array();
		if($sms_url != ''){
			$post_var['sms_url'] = $sms_url;
		}
		if($voice_start != '')
		{
			$post_var['voice_start'] = $voice_start;
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
	
	/**
	 * This method used to Deallocate number please do this with extra care after you deallocate number there is no grantee you will get same again.
	 * $id is mandatory.
	 * @param  string $id unique id you got return from Allocate_Number call please note you can't find this from control panel of website.
	 * @return an array or false based on the sucsess of api call 
	 */
	function Deallocation($id){
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
	
	/**
	 * This method used to send sms please note you will get charge based on the location you are sending sms.
	 * all params are mandatory
	 * @param string $from this must be a number you are previously allocated via api.
	 * @param string $to number you need to send sms to. check coverate and cost from http://www.46elks.com/selectcountry
	 * @return an array or false based on the sucsess of api call 
	 */	
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