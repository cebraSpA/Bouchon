<?php 

	/*
	Plugin Name: Advance Tabs for Visual Composer
	Description: Easy way to display your content in tabs.
	Plugin URI: http://webdevocean.com
	Author: labibahmed
	Author URI: http://webdevocean.com/about-me
	Version: 1.0
	License: GPL2
	Text Domain: wdo-tabs
	*/
	
	include 'plugin.class.php';
	if (class_exists('VC_WDO_Tabs')) {
	    $obj_init = new VC_WDO_Tabs;
	}

 ?>