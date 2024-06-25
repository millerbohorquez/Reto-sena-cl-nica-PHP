<?php
    require_once "../inc/session_start.php";
	require_once "main.php";

	/*== Almacenando id ==*/
    $codmed=limpiar_cadena($_POST['med_codigo']);


    /*== Verificando producto ==*/
	$check_equipo=conexion();
	$check_equipo=$check_equipo->query("SELECT * FROM medicos WHERE med_codigo ='$codmed'");

    if($check_equipo->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El medico no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_equipo->fetch();
    }
    $check_equipo=null;


    /*== Almacenando datos ==*/
    $medcod=limpiar_cadena($_POST['med_codigo']);
	$mednombre=limpiar_cadena($_POST['med_nombre']);
	$medapellido=limpiar_cadena($_POST['med_apellido']);
	$medtelefono=limpiar_cadena($_POST['med_telefono']);
    $especialidad=limpiar_cadena($_POST['med_especialidad']);


	/*== Verificando campos obligatorios ==*/
    if($medcod=="" || $mednombre=="" || $medapellido==""|| $medtelefono=="" || $especialidad==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[/^[\p{L}\s]+$/u]{1,50}",$medcod)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El codigo no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,30}",$mednombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El nombre no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{2}[/-][0-9]{2}[/-]([0-9]{2}|[0-9]{4})",$medapellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El apellido no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,150}",$medtelefono)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
               El telefono no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    if(verificar_datos("[/^[\p{L}\s]+$/u]{3,50}",$especialidad)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La especialidad no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Actualizando datos ==*/
    $actualizar_equipo=conexion();
    $actualizar_equipo=$actualizar_equipo->prepare("UPDATE medicos SET med_codigo=:medcodigo,med_nombre=:nombremed,med_apellido=:apellidomed,med_telefono=:telefonomed,med_especialidad=:especialidad WHERE med_codigo=:medcodigo");

    $marcadores=[
        ":medcodigo"=>$medcod,
        ":nombremed"=>$mednombre,
        ":apellidomed"=>$medapellido,
        ":telefonomed"=>$medtelefono,
        ":especialidad"=>$especialidad
    ];



    if($actualizar_equipo->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡MEDICO ACTUALIZADO!</strong><br>
                El medico se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el medico, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_equipo=null;