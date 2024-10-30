<?php 
/*
	Plugin Name: Cool Category Menu
	Plugin URI: https://lexxa.com.br
	Description: Display a menu of automatic and much more beautiful product categories.
	Author: Lexxa Internet
	Version: 1.9
*/

defined ('ABSPATH') or die ('No script kiddies please!');
if (! Defined ('ABSPATH')) exit; // Sair se acessado diretamente

//require dirname(__FILE__) . '/includes/settings.php';
require_once dirname(__FILE__) . '/includes/functions.php';

register_activation_hook( __FILE__, 'ccm_createTableCSS' );
register_activation_hook( __FILE__, 'ccm_colocaDadosCSS' );




