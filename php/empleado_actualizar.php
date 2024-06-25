<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

    /*== Almacenando id ==*/
    $ingcod=limpiar_cadena($_POST['ing_codigo']);

    /*== Verificando usuario ==*/
	$check_empleado=conexion();
	$check_empleado=$check_empleado->query("SELECT * FROM ingresos WHERE ing_codigo ='$ingcod'");

    if($check_empleado->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Ingreso no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_empleado->fetch();
    }
    $check_empleado=null;


    
    /*== Almacenando datos del usuario ==*/
    $ingcod = limpiar_cadena($_POST['ing_codigo']);
    $habitacion=limpiar_cadena($_POST['ing_habitacion']);
    $cama=limpiar_cadena($_POST['ing_cama']);
    $fechaing = isset($_POST['ing_fecha_ingreso']) ? limpiar_cadena($_POST['ing_fecha_ingreso']) : '';
    $medcod=limpiar_cadena($_POST['med_codigo']);
    $codigo = isset($_POST['pa_codigo']) ? limpiar_cadena($_POST['pa_codigo']) : '';


    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$ingcod)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El codigo no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$habitacion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La hibatacion no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    

    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$cama)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La cama no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,15}",$fechaing)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La fecha no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

   
    /*== Verificando categoria ==*/
	    $check_categoria=conexion();
	    $check_categoria=$check_categoria->query("SELECT med_codigo FROM medicos WHERE med_codigo='$medcod'");
	    if($check_categoria->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El medico seleccionado no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria=null;

        /*== Verificando categoria ==*/
	    $check_categoria2=conexion();
	    $check_categoria2=$check_categoria2->query("SELECT pa_codigo FROM pacientes WHERE pa_codigo='$codigo'");
	    if($check_categoria2->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El paciente seleccionado no existe
	            </div>
	        ';
	        exit();
	    }
	    $check_categoria2=null;


    /*== Actualizar datos ==*/
    $actualizar_empleado=conexion();
    $actualizar_empleado=$actualizar_empleado->prepare("UPDATE ingresos SET ing_codigo=:ingreso,ing_habitacion=:habitacion,ing_cama=:cama,ing_fecha_ingreso=:fecha,med_codigo=:medico,pa_codigo=:paciente WHERE ing_codigo =:ingreso");

    $marcadores=[
        ":ingreso"=>$ingcod,
        ":habitacion"=>$habitacion,
        ":cama"=>$cama,
        ":fecha"=>$fechaing,
        ":medico"=>$medcod,
        ":paciente"=>$codigo
    ];
    

    if($actualizar_empleado->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡INGRESO ACTUALIZADO!</strong><br>
                El ingreso se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el ingreso, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_empelado=null;