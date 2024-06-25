<?php
	/*== Almacenando datos ==*/
    $pa_id_del=limpiar_cadena($_GET['pa_id_del']);

    /*== Verificando producto ==*/
    $check_producto=conexion();
    $check_producto=$check_producto->query("SELECT * FROM pacientes WHERE pa_codigo ='$pa_id_del'");

    if($check_producto->rowCount()==1){

    	$datos=$check_producto->fetch();

    	$eliminar_producto=conexion();
    	$eliminar_producto=$eliminar_producto->prepare("DELETE FROM pacientes WHERE pa_codigo=:codigo");

    	$eliminar_producto->execute([":codigo"=>$pa_id_del]);

    	if($eliminar_producto->rowCount()==1){
	        echo '
	            <div class="notification is-info is-light">
	                <strong>!Paciente ELIMINADO!</strong><br>
	                Los datos del paciente se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el paciente, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_producto=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El paciente que intenta eliminar no existe
            </div>
        ';
    }
    $check_producto=null;