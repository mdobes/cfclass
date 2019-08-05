<?php
/**
 * Simple PHP class for Cloudflare API
 *
 * @author Michal Dobeš (michal@dobes.pw)
 * @copyright 2018-2019 © Michal Dobeš (https://dobes.pw)
 *
 * @link https://dobes.pw
 */

class CloudFlare{

	public $email;
	public $apikey;
	public $name;
	public $zoneid;

	public function zoneRegister(){
		if (isset($this->email) && isset($this->apikey) && isset($this->name)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'X-Auth-Key: '.$this->apikey,
			    'X-Auth-Email: '.$this->email,
			    'Content-Type:application/json',
			    'charset=utf-8'
			));
			curl_setopt($ch, CURLOPT_POSTFIELDS,
			            json_encode(
				array('name' => $this->name)
			));
			curl_exec($ch);
	        curl_close($ch);
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "zoneRegister",
					  'success' => "false")
			);
		}

	}

	public function zoneInfo(){
		if (isset($this->email) && isset($this->apikey) && isset($this->name)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones?name=". $this->name ."");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'X-Auth-Key: '.$this->apikey,
			    'X-Auth-Email: '.$this->email,
			));


			curl_exec($ch);

	        curl_close($ch);
	    }else{
			return json_encode(
				array('error' => "c100",
					  'action' => "zoneInfo",
					  'success' => "false")
			);	    	
	    }
	}		
	
	public function zoneRemove(){
		if (isset($this->apikey) && isset($this->email) && isset($this->zoneid)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones/". $this->zoneid);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				   'X-Auth-Key: '.$this->apikey,
				   'X-Auth-Email: '.$this->email,
				   'Content-Type:application/json',
				   'charset=utf-8'
			));
			curl_exec($ch);
			curl_close($ch);
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "zoneRemove",
					  'success' => "false")
			);	
		}
	}

	public function zoneDevMode($value){
		if (isset($this->email) && isset($this->apikey) && isset($this->name) && isset($this->zoneid) && isset($value)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones/". $this->zoneid ."/settings/development_mode");
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'X-Auth-Key: '.$this->apikey,
			    'X-Auth-Email: '.$this->email,
			    'Content-Type:application/json',
			    'charset=utf-8'
			));
			curl_setopt($ch, CURLOPT_POSTFIELDS,
			            json_encode(
				array('value' => $value)
			));
			curl_exec($ch);
	        curl_close($ch);
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "zoneDevMode",
					  'success' => "false")
			);
		}

	}

	public function zoneDevModeInfo(){
		if (isset($this->email) && isset($this->apikey) && isset($this->name) && isset($this->zoneid)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones/". $this->zoneid ."/settings/development_mode");
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'X-Auth-Key: '.$this->apikey,
			    'X-Auth-Email: '.$this->email,
			    'Content-Type:application/json',
			    'charset=utf-8'
			));
			curl_exec($ch);
	        curl_close($ch);
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "zoneDevMode",
					  'success' => "false")
			);
		}

	}

	public function dnsList(){
		if (isset($this->email) && isset($this->apikey) && isset($this->zoneid)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones/". $this->zoneid ."/dns_records");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			    'X-Auth-Key: '.$this->apikey,
			    'X-Auth-Email: '.$this->email,
			));


			curl_exec($ch);

	        curl_close($ch);
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "dnsList",
					  'success' => "false")
			);				
		}					
	}


	public function dnsAdd($type, $name, $content, $proxied){
		if (isset($type) && isset($name) && isset($content) && isset($this->apikey) && isset($this->email) && isset($this->zoneid) && isset($proxied)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones/". $this->zoneid ."/dns_records");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				   'X-Auth-Key: '.$this->apikey,
				   'X-Auth-Email: '.$this->email,
				   'Content-Type:application/json',
				   'charset=utf-8'
			));
			if ($type == "SRV"){
				curl_setopt($ch, CURLOPT_POSTFIELDS,
				            json_encode(array('type' => 'SRV',
				        		  'name' => $name,
				        		  'content' => $content,
				        		  'proxied' => $proxied
				        		  )));
			}else{
				curl_setopt($ch, CURLOPT_POSTFIELDS,
				            json_encode(array('type' => $type,
				        		  'name' => $name,
				        		  'content' => $content,
				        		  'proxied' => $proxied,
				        		  )));		
			}
				curl_exec($ch);
		        curl_close($ch);				
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "dnsAdd",
					  'success' => "false")
			);					
		}
	}

	public function dnsUpdate($id, $type, $name, $content, $proxied){
		if (isset($type) && isset($name) && isset($content) && isset($this->apikey) && isset($this->email) && isset($this->zoneid) && isset($proxied) && isset($id)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones/". $this->zoneid ."/dns_records/" . $id);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				   'X-Auth-Key: '.$this->apikey,
				   'X-Auth-Email: '.$this->email,
				   'Content-Type:application/json',
				   'charset=utf-8'
			));
			if ($type == "SRV"){
				curl_setopt($ch, CURLOPT_POSTFIELDS,
				            json_encode(array('type' => 'SRV',
				        		  'name' => $name,
				        		  'content' => $content,
				        		  'proxied' => $proxied
				        		  )));
			}else{
				curl_setopt($ch, CURLOPT_POSTFIELDS,
				            json_encode(array('type' => $type,
				        		  'name' => $name,
				        		  'content' => $content,
				        		  'proxied' => $proxied,
				        		  )));		
			}
				curl_exec($ch);
		        curl_close($ch);				
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "dnsUpdate",
					  'success' => "false")
			);					
		}
	}

	public function dnsRemove($id){
		if (isset($id) && isset($this->apikey) && isset($this->email) && isset($this->zoneid)){
			$ch = curl_init("https://api.cloudflare.com/client/v4/zones/". $this->zoneid ."/dns_records/" . $id);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				   'X-Auth-Key: '.$this->apikey,
				   'X-Auth-Email: '.$this->email,
				   'Content-Type:application/json',
				   'charset=utf-8'
			));
			curl_exec($ch);
			curl_close($ch);
		}else{
			return json_encode(
				array('error' => "c100",
					  'action' => "dnsRemove",
					  'success' => "false")
			);	
		}
	}

}
