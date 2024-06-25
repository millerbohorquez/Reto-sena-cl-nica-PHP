<?php
	/*== Almacenando datos ==*/
    $ing_id_del=limpiar_cadena($_GET['ing_id_del']);

    /*== Verificando producto ==*/
    $check_empleado=conexion();
    $check_empleado=$check_empleado->query("SELECT * FROM ingresos WHERE ing_codigo ='$ing_id_del'");

    if($check_empleado->rowCount()==1){

    	$datos=$check_empleado->fetch();

    	$eliminar_empleado=conexion();
    	$eliminar_empleado=$eliminar_empleado->prepare("DELETE FROM ingresos WHERE ing_codigo =:ingcod");

    	$eliminar_empleado->execute([":ingcod"=>$ing_id_del]);

    	if($eliminar_empleado->rowCount()==1){
	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡INGRESO ELIMINADO!</strong><br>
	                Los datos del ingreso se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el ingreso, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_empleado=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Ingreso que intenta eliminar no existe
            </div>
        ';
    }
    $check_empleado=null;