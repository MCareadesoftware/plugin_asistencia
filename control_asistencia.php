<?php
   /*
   Plugin Name: Control de Asistencia
   Plugin URI: https://monstruocreativo.com/
   Description: Control de Asistencias para Aula Virtual
   Version: 0.0.1
   License: GPLv2 or later
   Author: Monstruo Creativo
   */

define('ASISTENCIA_PLUGIN_PATH',plugin_dir_path(__FILE__));
define('ASISTENCIA_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once ASISTENCIA_PLUGIN_PATH. 'asistencia-shortcodes.php';

/*----*/
/* Activación del Plugin */
/*----------------------------------------------------------------------------------*/
function Activar(){
   global $wpdb;

   $sql = 
   "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}registros_asistencias(
      `ID_registro` INT NOT NULL AUTO_INCREMENT,
      `nombre_registro` VARCHAR(60) NOT NULL,
      `fecha_registro` DATETIME NOT NULL,
   PRIMARY KEY (`ID_registro`));";

   $wpdb->query($sql);
}
/*----------------------------------------------------------------------------------*/
/*----*/

/*----*/
/* Desactivación del Plugin */
/*----------------------------------------------------------------------------------*/
function Desactivar(){
   flush_rewrite_rules();
}
/*----------------------------------------------------------------------------------*/
/*----*/

/*----*/
/* Llamado de hooks de Activación y Desactivación del Plugin */
/*----------------------------------------------------------------------------------*/
register_activation_hook(__FILE__,'Activar');
register_deactivation_hook(__FILE__,'Desactivar');
/*----------------------------------------------------------------------------------*/
/*----*/

 /*----*/
 /* Creación del Admin del Plugin */
 /*----------------------------------------------------------------------------------*/
 function CrearMenu(){
    add_menu_page(
        'Control de Asistencia',
        'Control de Asistencia Plugin',
        'manage_options',
        plugin_dir_path(__FILE__).'admin/lista_asistencia.php',
        null
    );
 }

 add_action('admin_menu','CrearMenu');
/*----------------------------------------------------------------------------------*/
/*----*/

 /*----*/
 /* Añadir BootstrapJS y jQuery en el Plugin */
 /*----------------------------------------------------------------------------------*/
function EncolarBootstrapJS($hook){
   if($hook != "control_asisitencia/admin/lista_asistencia.php"){
      return;
   }

   wp_enqueue_script('bootstrapJs',plugins_url('admin/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
}

add_action('admin_enqueue_scripts','EncolarBootstrapJS');
/*----------------------------------------------------------------------------------*/
/*----*/

/*----*/
/* Añadir BootstrapCSS en el Plugin */
/*----------------------------------------------------------------------------------*/
function EncolarBootstrapCSS($hook){
   if($hook != "control_asisitencia/admin/lista_asistencia.php"){
      return;
   }

   wp_enqueue_style('bootstrapCSS',plugins_url('admin/bootstrap/css/bootstrap.min.css',__FILE__));
}

add_action('admin_enqueue_scripts','EncolarBootstrapCSS');
/*----------------------------------------------------------------------------------*/
/*----*/

/*----*/
/* Añadir customJS en el Plugin */
/*----------------------------------------------------------------------------------*/
function EncolarJSPropio($hook){
   if($hook != "control_asisitencia/admin/lista_asistencia.php"){
      return;
   }

   wp_enqueue_script('JSPropio',plugins_url('admin/js/lista_asistencia.js',__FILE__),array('jquery'));
}

add_action('admin_enqueue_scripts','EncolarJSPropio');
/*----------------------------------------------------------------------------------*/
/*----*/

/*----*/
/* Añadir AJAX en el Plugin */
/*----------------------------------------------------------------------------------*/
function EncolarAJAX() {
	wp_enqueue_script('encolarAjax', plugins_url('admin/js//ajax.js', __FILE__ ), array('jquery') );

	wp_localize_script('encolarAjax', 'encolarAjax_vars', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
}

add_action('admin_enqueue_scripts','EncolarAJAX');
/*----------------------------------------------------------------------------------*/
/*----*/

function grabarAsistencia(){
   global $wpdb;

   $current_user = wp_get_current_user();
   $tabla = "{$wpdb->prefix}registros_asistencias";
   $argumento = $current_user->user_login;
   $hora = getdate();

   $data = array(
     'ID_registro' => NULL, 
     'nombre_registro' => $argumento,
     'fecha_registro' =>	$hora
  );

   $wpdb->insert($tabla,$data);
}

