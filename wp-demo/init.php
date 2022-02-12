<?php
/*
Plugin Name: My First Plugin
Plugin URI: https://rohitchouhan.com
Description: This is my first wordpress plugin
Version: 1.0.0
Author: Rohit Chouhan
Author URI: https://rohitchouhan.com

*/

require_once(plugin_dir_path(__FILE__).'dashboard.php');
require_once(plugin_dir_path(__FILE__).'demo_page.php');

//=========== create menu start =================
function my_demo_menu()
{
	//parent menu
	add_menu_page(
		'Demo Plugin First Page', //page title
		'Demo Dashboard', //menu title
		'manage_options', //capabilities
		'demo_dashboard', //menu slug
		'mydemo_dashboard', //page function
	);

	//this is a submenu
	add_submenu_page(
		'demo_dashboard', //parent slug
		'My New Page', //page title
		'Demo Page', //menu title
		'manage_options', //capability
		'demo_new_page', //menu slug
		'mydemo_page'
	); 
}
add_action('admin_menu', 'my_demo_menu');
//=========== create menu end =================


//=========== load static file start =================
function load_static()
{
		wp_register_style('bulma_datatable_css', 'https://cdn.datatables.net/1.11.4/css/dataTables.bulma.min.css', false, '1.0.0');
		wp_enqueue_style('bulma_datatable_css');

		wp_register_script('jquery_js', 'https://code.jquery.com/jquery-3.5.1.js', false, '1.0.0');
		wp_enqueue_script('jquery_js');	
}

add_action('admin_enqueue_scripts', 'load_static'); //in wordpress admin
add_action('enqueue_scripts', 'load_static'); //in whole website except admin panel
//=========== load static file end =================

//=========== register hook (only execute when plugin is activate) =================
function create_mydb(){
	global $wpdb;
	$table_name = $wpdb->prefix . "demo_users"; //{wp_}users
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE $table_name (
            `id` int NOT NULL AUTO_INCREMENT,
            `name` varchar(50) CHARACTER SET utf8 NOT NULL,
            `emaild` varchar(10) CHARACTER SET utf8 NOT NULL,
            `address` varchar(2000) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate;
		  ";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_mydb');
//=========== register hook end =================

