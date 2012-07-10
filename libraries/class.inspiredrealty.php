<?php
class InspiredRealtyCore {
	public $errors = array();
	 
	public function __construct($options) {
		if(is_array($options)) {
			$this->options = $options;
		}
	}
	
	public function request($action, $parts = array()) {
		if(empty($action)) {
			$this->errors[] = 'An action is required to make an API request';	
		}
		
		if(count($parts) > 0) {
			$refiners = '/'.join('/', $parts);	
		}
		
		$data = file_get_contents('http://api.ircdn.com/'.$action.$refiners.'/format/php');
		
		if ($data === FALSE) {
			$this->errors[] = 'Could not access API';
			return FALSE;
		}
		
		
		$data = unserialize($data);
		
		if(!is_array($data)) {
			$this->errors[] = 'Error parsing data';
			return FALSE;
		}
		
		if(isset($data['error'])) {
			$this->errors[] = $data['error']['description'];
			return FALSE;
		}
		
		if(count($this->errors) == 0) {
			$this->results = $data['result'];
			$this->info = $data['info'];
			
			return true;
		} else {
			die(print_r($this->errors));
			false;	
		}
	}
	
	public function auth($username, $password) {
		if (($username == '') || ($password == '')) {
			return FALSE;
		}
		
		$ch = curl_init('http://api.ircdn.com/agencies/auth');
		curl_setopt($ch, CURLOPT_POST	   , 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS	   , 'user='.urlencode($username).'&pass='.urlencode($password));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION	 ,1);
		curl_setopt($ch, CURLOPT_HEADER		 ,0);  // DO NOT RETURN HTTP HEADERS
		curl_setopt($ch, CURLOPT_RETURNTRANSFER	 ,1);  // RETURN THE CONTENTS OF THE CALL
		$data = curl_exec($ch);
	
		$data = json_decode($data, true);
		
		if (!is_array($data)){
			$this->errors[] = 'Error parsing data';
			return FALSE;
		}
		
		if (!isset($data['result']['status'])) {
			$this->errors[] = 'Error parsing data';
			return FALSE;
		}
			
		$this->options['agent'] = ($data['result']['status'] == 1) ? (int) $data['agency'] : FALSE;	
	}
	
	public function statuses() {
		if($this->options['agent'] !== false) {
			$params = array('search', 'agency', $this->options['agent']);
			
			if($this->request('statuses', $params)) {
				return $this->results;	
			}
		}
		
		return false;		
	}
	
	public function cities() {
		if($this->options['agent'] !== false) {
			$params = array('search', 'agency', $this->options['agent']);
			
			if($this->request('cities', $params)) {
				return $this->results;	
			}
		}
		
		return false;	
	}
	
	public function datatypes($id='') {
		if(is_numeric($id)) {
			$params = array('get', 'id', $id);	
		} else {
			if($this->options['agent'] !== false) {
				$params = array('search', 'agency', $this->options['agent']);
			}
		}
		
		if($this->request('datatypes', $params)) {
			return $this->results;	
		}
				
		return false;	
	}
	
	public function listings($search = 0) {
		if(is_numeric($search['id'])) {
			$params = array('get', 'id', $search['id']);
		} else {
			// More complex search - cities/datatypes/fields/etc...
		}
		
		if($this->request('listings', $params)) {	
			if($this->parseListingFields()) {
				return $this->results;		
			}
		}
			
		return false;	
	}
	
	public function parseListingFields() {
		if(count($this->results) > 0) {
			foreach($this->results['fields'] as $field) {
				$newFields[$field['name']] = $field;		
			}
			
			$this->results['fields'] = $newFields;
			
			return true;
		} else {
			return false;	
		}
	}
	
	
	
	
}
?>