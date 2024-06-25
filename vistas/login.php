<style>
	.main-container{
		background-image: url(https://media.istockphoto.com/id/1141178054/es/vector/abstracto-dise%C3%B1o-de-luz-poligonal-de-cruz-m%C3%A9dica.jpg?s=2048x2048&w=is&k=20&c=mnUCbtBVbmmZFyNml4YrXxk2Lb79Q6J7qiSaILoRS6M=);
		background-repeat: no-repeat;
  		background-size: cover;
  		background-attachment: fixed;
  		background-position: center;
	}
	.box{
		background-image: url(https://media.istockphoto.com/id/1141178054/es/vector/abstracto-dise%C3%B1o-de-luz-poligonal-de-cruz-m%C3%A9dica.jpg?s=2048x2048&w=is&k=20&c=mnUCbtBVbmmZFyNml4YrXxk2Lb79Q6J7qiSaILoRS6M=);
		background-repeat: no-repeat;
  		background-size: cover;
  		background-attachment: fixed;
  		background-position: center;
	}
</style>
<div class="main-container">

	<form class="box login" action="" method="POST" autocomplete="off">
		<h5 class="title is-5 has-text-centered is-uppercase text-white">Clinica Mas Vida</h5>

		<div class="field">
			<label class="label text-white">Usuario</label>
			<div class="control">
			    <input class="input" type="text" name="login_usuario" pattern="[/^[\p{L}\s]+$/u]{3,100}" maxlength="100" required >
			</div>
		</div>

		<div class="field">
		  	<label class="label text-white">Clave</label>
		  	<div class="control">
		    	<input class="input" type="password" name="login_clave" pattern="[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/]" maxlength="100" required >
		  	</div>
		</div>

		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
		</p>
		

		<?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				require_once "./php/main.php";
				require_once "./php/iniciar_sesion.php";
			}
		?>
	</form>

	
</div>
