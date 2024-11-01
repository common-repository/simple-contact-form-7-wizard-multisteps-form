<?php
/*
	Plugin Name: Simple Contact form 7 Wizard Multisteps Form
	Plugin URI: http://wpsenior.com
	Description: Simple Contact form 7 Wizard Multisteps Form , light weight no ajax simple jquery and easy.
	Version: 1.0.3
	Author: Junaid Bhatti
	Author URI: http://wpsenior.com
	License: GPLv2 or later
	Text Domain: simple_contact_form_7_wizard_multisteps_form
    Domain Path: languages
*/

define('SCF7WMF_PATH', dirname(__FILE__));
define('SCF7WMF_ASSETS_PATH', SCF7WMF_PATH . 'assets/');
define('SCF7WMF_URL', plugin_dir_url( __FILE__ ));
define('SCF7WMF_ASSETS_URL', SCF7WMF_URL . 'assets/');

//Admin Notice    
function scf7wmf_admin_notice() {
    echo "<div class='error'><p><strong>Simple Contact form 7 Wizard Multisteps Form</strong> requires <strong> Contact form 7</strong> </p></div>";
}
//Load plugin textdomain.
function simple_contact_form_7_wizard_multisteps_form() {
  load_plugin_textdomain( 'simple-contact-form-7-wizard-multisteps-form', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'simple_contact_form_7_wizard_multisteps_form' );

if(!class_exists('WPCF7_ContactForm')){
add_action('admin_notices', 'scf7wmf_admin_notice');
return;
}
if(class_exists('WPCF7_ContactForm')){
function scf7wmf_form(){
    wp_register_script('scf7wmf-wizard-form-js', SCF7WMF_ASSETS_URL.'js/wizard-js.js',array('jquery'), '1.0');
    wp_enqueue_script('scf7wmf-wizard-form-js');
}
add_action('init', 'scf7wmf_form');
add_action('admin_print_styles', 'scf7wmf_form');

}
//Step shortcode
function scf7wmf_step($attr, $content) {
   extract(shortcode_atts(array(
       's' => '',
       'title' =>'',
       
   ), $attr));
   return "
   <section class=wizardform' data-step='".$s."'>
<h3>".$title."</h3>
" . do_shortcode($content) ."
</section>";
}
add_shortcode('step', 'scf7wmf_step');
//step
//Next button
function scf7wmf_nextbotton(){
    return"<button id='jb' class='button button-next'>". __("Next", 'simple-contact-form-7-wizard-multisteps-form')."</button>";   
}
add_shortcode('nextbutton', 'scf7wmf_nextbotton');
//Back Button
function scf7wmf_backbotton(){
    return"<button class='button button-back'>". __("Back", 'simple-contact-form-7-wizard-multisteps-form')."</button>";    
}
add_shortcode('backbutton', 'scf7wmf_backbotton');
//contact form 7 shortcode filter
function scf7wmf_steps( $content ) {
	$content = do_shortcode( $content );
	return $content;
}
add_filter( 'wpcf7_form_elements', 'scf7wmf_steps' );
?>