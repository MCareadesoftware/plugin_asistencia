<?php
    global $wpdb;

    $tabla = "{$wpdb->prefix}registros_asistencias";

    $query = "SELECT * FROM  $tabla ORDER BY ID_registro";
    $lista_asistencia = $wpdb->get_results($query,ARRAY_A);
    if(empty($lista_asistencia)){
        $lista_asistencia = array();
    }
?>

<div class="wrap">
    <?php
        echo "<h1 class='wp-heading-inline'>" .get_admin_page_title() . "</h1>";
    ?>
    <a id="btnMarcar" class="page-title-action">Marcar</a>
    <br><br><br>
    <table class="wp-list-table widefat fixed striped pages">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha</th>
        </thead>
        <tbody id="the-list">
            <?php
                foreach ($lista_asistencia as $key => $value) {
                    $ID = $value['ID_registro'];
                    $Alumno = $value['nombre_registro'];
                    $Fecha = $value['fecha_registro'];
                    echo
                    "<tr>
                        <td>$ID</td>
                        <td>$Alumno</td>
                        <td>$Fecha</td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalinsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Marcar Asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Asistencia marcada satisfactoriamente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>