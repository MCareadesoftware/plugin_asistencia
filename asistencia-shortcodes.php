<?php

function listar_asistencia(){
    global $wpdb;

    $current_user = wp_get_current_user();
    $tabla = "{$wpdb->prefix}registros_asistencias";
    $argumento = $current_user->user_login;

    $consulta = "SELECT * FROM $tabla WHERE nombre_registro = '$argumento' ORDER BY ID_registro";

    $asistencias = $wpdb->get_results($consulta, OBJECT);

    $return = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">';
    $return .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>';
    $return .= '<div class="wrap">';
    if($asistencias):
        $return .= '<table class="table table-hover">';
        $return .= '<thead>';
        $return .= '<th>'.__('Nombre').'</th>';
        $return .= '<th>'.__('Fecha').'</th>';
        $return .= '</thead>';
        $return .= '<tbody class="table-group-divider">';
        foreach ($asistencias as $key => $value) :
            $return .= '<tr>';
            $return .= '<td>'.$value->nombre_registro.'</td>';
            $return .= '<td>'.$value->fecha_registro.'</td>';
            $return .= '</tr>';
            /* $return .= '';
            $return .= ''; */
        endforeach;
            
        $return .= '</tbody>';
        $return .= '</table>';
    endif;
    $return .= '</div>';

    return $return;

}

add_shortcode( 'listar_asistencia', 'listar_asistencia' );

function marcar_asistencia(){

    $return = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">';
    $return .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>';
    $return .= '<div class="d-grid gap-2 col-6 mx-auto">';
    $return .= '<button id="btnMarcarA" class="btn btn-danger btn-lg">'.__('Marcar Asistencia').'</button>';
    $return .= '</div>';
    /*  */

    return $return;
}

add_shortcode( 'marcar_asistencia', 'marcar_asistencia' );


