<?php
	$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
	$tabla="";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM ingresos WHERE ((ing_codigo  AND ing_codigo  LIKE '%$busqueda%' OR ing_habitacion LIKE '%$busqueda%' OR ing_cama LIKE '%$busqueda%' OR ing_fecha_ingreso LIKE '%$busqueda%' OR med_codigo  LIKE '%$busqueda%' OR pa_codigo LIKE '%$busqueda%')) ORDER BY ing_fecha_ingreso ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(ing_codigo ) FROM ingresos WHERE ing_codigo  AND ((ing_codigo  LIKE '%$busqueda%' OR ing_habitacion LIKE '%$busqueda%' OR ing_cama LIKE '%$busqueda%' OR ing_fecha_ingreso LIKE '%$busqueda%' OR med_codigo LIKE '%$busqueda%' OR pa_codigo LIKE '%$busqueda%'))";

	}else{

		$consulta_datos="SELECT * FROM ingresos WHERE ing_codigo  ORDER BY ing_fecha_ingreso ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(ing_codigo ) FROM ingresos WHERE ing_codigo ";
		
	}

	$conexion=conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$Npaginas =ceil($total/$registros);

	$tabla.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>Codigo</th>
                    <th>Habitacion</th>
                    <th>Cama</th>
                    <th>Fecha Ingreso</th>
                    <th>Medico</th>
					<th>Paciente</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

	if($total>=1 && $pagina<=$Npaginas){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($datos as $rows){
			$tabla.='
				<tr class="has-text-centered" >
					<td>'.$rows['ing_codigo'].'</td>
                    <td>'.$rows['ing_habitacion'].'</td>
                    <td>'.$rows['ing_cama'].'</td>
                    <td>'.$rows['ing_fecha_ingreso'].'</td>
                    <td>'.$rows['med_codigo'].'</td>
					<td>'.$rows['pa_codigo'].'</td>
                    <td>
                        <a href="index.php?vista=emple_update&ing_id_up='.$rows['ing_codigo'].'" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    <td>
                        <a href="'.$url.$pagina.'&ing_id_del='.$rows['ing_codigo'].'" class="button is-danger is-rounded is-small">Eliminar</a>
                    </td>
                </tr>
            ';
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$tabla.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$tabla.='</tbody></table></div>';

	if($total>0 && $pagina<=$Npaginas){
		$tabla.='<p class="has-text-right">Mostrando ingresos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $tabla;

	if($total>=1 && $pagina<=$Npaginas){
		echo paginador_tablas($pagina,$Npaginas,$url,7);
	}