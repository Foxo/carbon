<?php
/**
 * @package FOXO Carbon
 * @version 1.0
 */
 
/*
Plugin Name: FOXO Carbon
Plugin URI: www.foxo.ca
Description: Foxo Carbon is a wordpress plugin that gives me (or, any developer) the ability to easily add dynamic functionality to a site. This plugin is meant to handle various tasks, such as contact form, inspired realty listings, sudoc files and much more...
Author: FOXO
Version: 1.0
Author URI: http://www.foxo.ca
*/

define('fc_plugin_dir', dirname(__FILE__).'/');
define('fc_plugin_url', WP_PLUGIN_URL.'/foxo_carbon/');
define('fc_basePage', 'fc_settings');
define('fc_pre', 'foxo_');


require(fc_plugin_dir.'helpers/help.mysql.php');
require(fc_plugin_dir.'helpers/help.common.php');


class FC_Template {
	private $data = false;
	private $template = false;
	
	public function __construct($template = false, $data = false) {
		if($template) {
			$this->set_template($template);
		}
		
		if($data) {
			$this->set_data($data);
		}
	}
	
	public function set_template($file) {
		if(strtolower($file) === 'json') {
			$this->template = 'json';	
		} else {
			$file = fc_plugin_dir.'themes/'.$file.'.php';
			
			if(!file_exists($file)) {
				throw new Exception('The template file you have specified does not exist');	
			}
			
			$this->template = $file;
		}
		
		return $this;
	}
	
	public function set_data($key, $value = false) {
		if(is_array($key)) {
			foreach($key as $x => $v) {
				$this->data[$x] =	$v;
			}
		} else {
			$this->data[$key] = $value;	
		}
		
		return $this;
	}
	
	public function output($print = false) {
		$var = $this->data;
		
		if($this->template == 'json') {
			$out = json_encode($var);
		} else {
			ob_start();
			require($this->template);
			$out = ob_get_clean();
		}
		
		if($print) {
			echo $out;
		} else {
			return $out;
		}
	}
}

/*****************
 *	HELPER CLASS
 **************/		 
class FC_ClassHelper {
	public function load_options($o) {
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
	
	function load_lib($class) {
		$class_file = fc_plugin_dir.'libraries/class.'.$class.'.php';
		
		if(file_exists($class_file)) {
			require_once($class_file);
			
			if(class_exists($class)) {
				$this->{ucfirst($class)} = new $class;
				
				return true;
			} else {
				throw new Exception('Unable to load specified library, Make sur the class name matches the file?');	
			}
		}
		
		return false;
	}
	
	function load_help($file) {
		$file = fc_plugin_dir.'helpers/help.'.$file.'.php';
		
		if(file_exists($file)) {
			require_once($file);
			
			return true;
		} else {
			throw new Exception('Unable to load helper');	
		}
		
		return false;
	}
}

class FC_Plugin extends FC_ClassHelper {
	public function __construct() {
		$this->load_lib('realty');
		$this->load_lib('phpmailer');
		
		add_filter('the_content', array($this, 'parse_content'));
		add_action('init', array($this, 'plugin_start'));
		
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
	
	public function plugin_start() {
		// Load global scripts (jquery, etc...)	
		wp_deregister_script('jquery'); 
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"), false); 
		wp_enqueue_script('jquery');
		
		if(is_admin()) {
			// Admin Javascript
			wp_enqueue_script('notifier', fc_plugin_url.'javascript/notifier.js', 'jquery');
			
			// Admin Hooks
			//add_action('admin_menu', array($this, 'adminMenu'));
			//add_action('wp_ajax_ir_profiles', array($this, 'ajaxController'));
		} else {
			// Add Filters
			//add_filter('wp_title', array($this, 'modifyPageTitle'), 10, 2);
			//add_filter('query_vars', array($this, 'fc_query_vars'));
			
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
	 * FRONT-END HOOK FUNCTIONS 
	 * These functions are called when the plugin is loaded from the front-end
	 ******/
	public function parse_shortcode($match) {
		global $post; 
		
		$this->load_options(array(
			'shortCodeOptions' => $match['options'],
			'mode' => $match['mode'],
			'permaLink' => get_permalink($post->ID)
		));
		
		switch($this->options['mode']) {
			case 'video_gallery':
				//$html = new FC_Template('default/video_gallery', $data);
				//return $html->output();	
			break;
			
			case 'inspired_realty':
				$data['listings'] = $this->Realty->listings();
				
				//print_r($data);
				
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
	
	
	public function parse_content($content) {
		global $post, $wp;
	
		if($post->post_type !== 'page') {
			return $content;
		}
		
		
		return preg_replace_callback('/\[foxo_(?P<mode>\w*)\s?(options="(?P<options>.*)")?\]/', array($this, 'parse_shortcode'), $content);	
	}
	
	/**************************************
	 * ADMIN HOOK FUNCTIONS 
	 * These functions are called when the plugin is loaded from within the admin panel
	 *****
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
	*/
	
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

$Carbon = new FC_Plugin;
