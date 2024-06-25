<div class="container is-fluid mb-6">
	<h1 class="title">Productos</h1>
	<h2 class="subtitle">Actualizar producto</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$ing = (isset($_GET['ing_id_up'])) ? $_GET['ing_id_up'] : 0;
		$ing =limpiar_cadena($ing);

		/*== Verificando producto ==*/
    	$check_empleado=conexion();
    	$check_empleado=$check_empleado->query("SELECT * FROM ingresos WHERE ing_codigo='$ing'");

        if($check_empleado->rowCount()>0){
        	$datos=$check_empleado->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<h2 class="title has-text-centered"><?php echo $datos['ing_habitacion']; ?></h2>

	<form action="./php/empleado_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="ing_codigo" value="<?php echo $datos['ing_codigo']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Codigo</label>
				  	<input class="input" type="number" name="ing_codigo" pattern="[/^[0-9]+$/]{1,11}" maxlength="11" required value="<?php echo $datos['ing_codigo']; ?>">
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Habitacion</label>
				  	<input class="input" type="text" name="ing_habitacion" pattern="[/^[\p{L}\s]+$/u]{3,100}" maxlength="100" required required value="<?php echo $datos['ing_habitacion']; ?>">
				</div>
		  	</div>
			<div class="column">
		    	<div class="control">
					<label>Cama</label>
				  	<input class="input" type="text" name="ing_cama" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required required value="<?php echo $datos['ing_cama']; ?>">
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Fecha Ingreso</label>
				  	<input class="input" type="text" name="ing_fecha_ingreso" pattern="[/^[\p{L}\s]+$/u]{3,50}" maxlength="50" required required value="<?php echo $datos['ing_fecha_ingreso']; ?>">
				</div>
		  	</div>
			  <div class="column">
    			<label>Medico</label><br>
    			<div class="select is-rounded">
        		<select name="med_codigo">
            	<option value="" selected="">Seleccione una opción</option>
            	<?php
                $categorias1 = conexion();
                $categorias1 = $categorias1->query("SELECT * FROM medicos");
                if ($categorias1->rowCount() > 0) {
                    $categorias1 = $categorias1->fetchAll();
                    foreach ($categorias1 as $row) {
                        $selected = ($row['med_codigo'] == $datos['med_codigo']) ? 'selected' : '';
                        echo '<option value="' . $row['med_codigo'] . '" ' . $selected . '>' . $row['med_nombre'] . '</option>';
                    }
                }
                $categorias1 = null;
            ?>
        	</select>
    	</div>
	</div>

	<div class="column">
    <label>Usuario</label><br>
    <div class="select is-rounded">
        <select name="pa_codigo">
            <option value="" selected="">Seleccione una opción</option>
            <?php
            $categorias2 = conexion();
            $categorias2 = $categorias2->query("SELECT * FROM pacientes");
            if ($categorias2->rowCount() > 0) {
                $categorias2 = $categorias2->fetchAll();
                foreach ($categorias2 as $row) {
                    $selected = ($row['pa_codigo'] == $datos['pa_codigo']) ? 'selected' : '';
                    echo '<option value="' . $row['pa_codigo'] . '" ' . $selected . '>' . $row['pa_nombre'] . '</option>';
                }
            }
            $categorias2 = null;
            ?>
        </select>
    </div>
</div>

		  	</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_empleado=null;
	?>
</div>