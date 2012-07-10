<?php
/**
 * @package FOXO Common
 * @version 1.0
 */
/*
Plugin Name: FOXO Common
Plugin URI: www.foxo.ca
Description:  
Author: FOXO
Version: 1.0
Author URI: http://www.foxo.ca
*/

define('fc_pluginDir', dirname(__FILE__));
define('fc_pluginUrl', WP_PLUGIN_URL.'/foxo_carbon/');
define('fc_basePage', 'fc_settings');
define('fc_pre', 'foxo_');


require(fc_pluginDir.'/libraries/functions.mysql.php');
require(fc_pluginDir.'/libraries/functions.common.php');
require(fc_pluginDir.'/libraries/class.inspiredrealty.php');
require(fc_pluginDir.'/libraries/class.phpmailer.php');





class FC_Template {
	public function __construct($template = '', $data = '') {
		if(!empty($template)) {
			$this->template = fc_pluginDir.'/themes/'.$template.'.php';	
		}
		
		if(is_array($data)) {
			$this->data = $data;	
		}
	}
	
	public function output() {
		$var = $this->data;
		
		if($this->template == 'json') {
			return json_encode($var);
		} else {
			ob_start();
			require($this->template);
			return ob_get_clean();
		}
	}
}

/*****************
 *	HELPER CLASS
 **************/		 
class FC_ClassHelper {
	public function loadOptions($o) {
		$this->options = $o;
		
		if(!empty($o['fromShortCode'])) {
			$scOptions = explode("&", $o['fromShortCode']);
			if(is_array($scOptions)) {
				foreach($scOptions as $option) {
					$parts = explode(":", $option);
					
					$this->options[$parts[0]] = $parts[1];
				}
			}
		}
	}
	
	public function printInTemplate($print = false) {
		$html = new FC_Template($this->template, $this->content);
		
		if($html === false) {
			wp_die('You are trying to access a theme or template file that does not exist.', 'Theme file does not exist');	
		} else {
			if($print) {
				echo $html->output();
			} else {
				return $html->output();
			}
		}
	}
	
	public function validateInputFields($fields, $post) {
		if(is_array($fields) && is_array($post)) {
			foreach($fields as $f => $r) {
				$d = $post[$f];
				
				if(is_array($r)) {
					if(empty($d) && $r['required'] === true) {
						$this->errors[$f] = $r['error'];
					}
					
					if(!empty($r['regex']) && preg_match() === false) {
						$this->errors[$f] = $r['error'];
					}
				}
				
				$this->postData[$f] = $d;	
			}
			
			return $data;	
		} else {
			return false;	
		}
	}
}

class FC_Plugin extends FC_ClassHelper {
	public function __construct() {
		add_filter('the_content', array($this, 'parseContent'));
		add_action('init', array($this, 'pluginStart'));
		
		register_activation_hook( __FILE__, array($this, install));
		register_uninstall_hook( __FILE__, array($this, uninstall));
	}
	
	/**************************************
	 * GLOBAL FUNCTIONS 
	 * These functions may be use by either the admin or front-end
	 ******/
	public function fc_query_vars($vars) {
	  $vars[] = "playerID";
	  return $vars;
	}
	
	public function pluginStart() {
		// Load global scripts (jquery, etc...)	
		wp_deregister_script('jquery'); 
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"), false); 
		wp_enqueue_script('jquery');
		
		if(is_admin()) {
			// Admin Javascript
			wp_enqueue_script('notifier', ir_pluginUrl.'javascript/notifier.js', 'jquery');
			
			// Admin Hooks
			add_action('admin_menu', array($this, 'adminMenu'));
			//add_action('wp_ajax_ir_profiles', array($this, 'ajaxController'));
		} else {
			// Add Filters
			add_filter('wp_title', array($this, 'modifyPageTitle'), 10, 2);
			add_filter('query_vars', array($this, 'fc_query_vars'));
			
			//wp_enqueue_style('irealtyStyle', ir_pluginUrl.'themes/default/iRealty.css');
				
			
			/*	
				// Front-end Scripts
				wp_enqueue_script('googleMaps', 'http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAU1bCYB-zD9j1YTfF36yBwxQzpv4en2YjA2RXL00rwuJWDFXRmBQPE-wfy6owC4O0oM6XyyWeZUZvrg');
				wp_enqueue_script('irealtyCore', ir_pluginUrl.'javascript/irealty.core.jquery.js', 'jquery');
				wp_enqueue_script('irealtyTemplate', ir_pluginUrl.'themes/default/template.js');
				wp_enqueue_script('irealtyLibraries', ir_pluginUrl.'javascript/frameworks.js', 'jquery');	
				wp_enqueue_script('irealtyHelper', ir_pluginUrl.'javascript/irealty.helper.jquery.js', 'jquery');
				
				// Front-end Hooks
				/*
				add_action('wp_print_scripts', 'ir_Scripts');
				add_action('wp_print_styles', 'ir_Css');
			*/						
		}	
	}
	
	/**************************************
	 * ADMIN HOOK FUNCTIONS 
	 * These functions are called when the plugin is loaded from within the admin panel
	 ******/
	public function adminMenu() {
		add_object_page(__('Foxo Common'), __('Foxo Common'), 2, fc_basePage);
		add_submenu_page(ir_basePage, __('Event Manager'),  __('Event Manager'), 2, 'fc_events', array($this, 'eventManager'));
		add_submenu_page(ir_basePage, __('Customers'),  __('Customers'), 1, 'fc_customers', array($this, 'customerManager'));
		add_submenu_page(ir_basePage, __('Contacts'),  __('Contacts'), 1, 'fc_contacts', array($this, 'contactManager'));
		add_submenu_page(ir_basePage, __('Settings'),  __('Settings'), 1, fc_basePage, array($this, 'settingsManager'));
			
	}
	
	public function profileManager() {
		$this->content['profiles'] = $this->Profile->all();
		$this->template = 'admin/profileManager';
		$this->printInTemplate(true);	
	}
	
	public function settingsManager() {
		$this->template = 'admin/settingsManager';
		$this->printInTemplate(true);	
	}
	
	public function ajaxController() {
		switch($_POST['do']) {
			case 'profileForm':
				if(is_numeric($_POST['id'])) {
					if($this->Profile->load($_POST['id']) === true) {
						$this->content['profile'] = $this->Profile->profile[0];
						$this->content['profile']['profile_data'] = json_decode($this->content['profile']['profile_data'], true);
					}
				}
				
				$this->content['statuses'] = $this->IR->statuses();
				$this->content['cities'] = $this->IR->cities();
				$this->content['datatypes'] = $this->IR->datatypes();
				
				foreach($this->content['datatypes'] as $x => $dt) {
					$fields = $this->IR->datatypes($dt['id']);
					$this->content['datatypes'][$x]['fields'] = $fields['fields'];			
				}
				
				$this->template = 'admin/profileFields';
			break;
			
			case 'saveProfile':
				//TODO: Why isn't this with printInTemplate
				if($this->Profile->save($_POST['post'])) {
					$json = array('success' => 1, 'profile' => $this->Profile->profile, 'profileIsNew' => $this->Profile->isNew);
				} else {
					$json = array('success' => 0);
				}
				
				die(json_encode($json));
			break;
		}
		
		die($this->printInTemplate());
	}
	
	/**************************************
	 * FRONT-END HOOK FUNCTIONS 
	 * These functions are called when the plugin is loaded from the front-end
	 ******/
	public function parseShortCode($match) {
		global $post; 
		
		$this->loadOptions(array(
			'shortCodeOptions' => $match['options'],
			'mode' => $match['mode'],
			'permaLink' => get_permalink($post->ID)
		));
		
		switch($this->options['mode']) {
			case 'video_gallery':
				$html = new FC_Template('default/video_gallery', $data);
				return $html->output();	
			break;
			
			case 'inspired_realty':
				$IR = new InspiredRealtyCore;
				
				$data['listings'] = $IR->listings();
				
				print_r($data);
				
				$html = new FC_Template('default/inspired_realty/listing_index', $data);
				return $html->output();	
			break;
			
			case 'contact':
				if(count($_POST) > 0) {
					$data = array(
						'name' => $_POST['full_name'],
						'email' => $_POST['email'],
						'comment' => $_POST['comment']
					);
					
					$email = new FC_Template('default/contact_email', $data);
					
					$mailer = new phpmailer;
					$mailer->preconfig_Send('scott@foxo.ca', 'Contact Form Submission', $email->output(), $data['email'], $data['name']);
					
					$data['submitted'] = true;	
				}
				
				$html = new FC_Template('default/contact_form', $data);
				return $html->output();
			break;
			
			case 'url':
				return '/';
			break;	
		}
		
		
		//return $this->printInTemplate();
	}
	
	
	public function parseContent($content) {
		global $post, $wp;
	
		if($post->post_type !== 'page') {
			return $content;
		}
		
		
		return preg_replace_callback('/\[foxo_(?P<mode>\w*)\s?(options="(?P<options>.*)")?\]/', array($this, 'parseShortCode'), $content);	
	}
	
	public function modifyPageTitle($title) {
		if(is_numeric($_GET['showListing'])) {
			$this->IR->listings(array('id' => $_GET['showListing']));
			$title.= $this->IR->results['street_address'].' | '.$this->IR->results['city']['city_title'].' |';
		}	
		
		return $title;
		
	}
	
	/**************************************
	 * ACTIVATION/UNINSTAL HOOK FUNCTIONS 
	 * These functions are called when the plugin is activated or deactivated
	 ******/
	public function install() {
		sql_query("CREATE TABLE IF NOT EXISTS `foxo_form_submissions` (`submit_id` INT(9) NOT NULL auto_increment PRIMARY KEY, `submit_date` DATETIME, `submit_type` VARCHAR(20) NOT NULL, `submit_data` TEXT NOT NULL)");			
	}
	
	public function uninstall() {
		if(__FILE__ == WP_UNINSTALL_PLUGIN ) {
			// Remove tables
		}
	}
}

$IR = new FC_Plugin;
