<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'Conexion.php';
	
	if(isset($_POST['btnsave']))
	{
		$cardname = $_POST['card_name'];// user name
		$cardtipo = $_POST['card_tipo'];// user email

		// NUEVOS
		$cardnivel = $_POST['card_nivel'];
		$cardcantidad = $_POST['card_cantidad'];
		$cardnextlevel = $_POST['card_nextlevel'];
		$cardlevel13 = $_POST['card_level13'];
		$cardorototal = $_POST['card_orototal'];
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		
		
		if(empty($cardname)){
			$errMSG = "Ingrese la marca";
		}
		else if(empty($cardtipo)){
			$errMSG = "Ingrese el tipo.";
		}
		else if(empty($imgFile)){
			$errMSG = "Seleccione el archivo de imagen.";
		}
		else
		{
			$upload_dir = 'imagenes/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '1MB'
				if($imgSize < 1000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Su archivo es muy grande.";
				}
			}
			else{
				$errMSG = "Solo archivos JPG, JPEG, PNG & GIF son permitidos.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO tbl_cards(card_Img, card_Nombre, card_Tipo, card_Nivel, card_Cantidad, card_NextLevel, card_Lavel13, card_OroTotal) VALUES(:upic, :cname, :ctipo, :cnivel, :ccant, :cnlevl, :clev13, :cortt )');
		$stmt->bindParam(':cname',$cardname);
		$stmt->bindParam(':ctipo',$cardtipo);
		$stmt->bindParam(':upic',$userpic);
		$stmt->bindParam(':cnivel',$cardnivel);
		$stmt->bindParam(':ccant',$cardcantidad);
		$stmt->bindParam(':cnlevl',$cardnextlevel);
		$stmt->bindParam(':clev13',$cardlevel13);
		$stmt->bindParam(':cortt',$cardorototal);
			
			if($stmt->execute())
			{
				$successMSG = "Nuevo registro insertado correctamente ...";
				header("refresh:3;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "Error al insertar ...";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Subir, Insertar, Actualizar, Borrar una imágen usando PHP y MySQL</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/jquery.min.js"></script>

<style type="text/css">
/* TEMP HIDE SOME COLUMNS */	
table tr:nth-child(6),
table tr:nth-child(7),
table tr:nth-child(8) {
	display: none;
}

</style>

</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> <a class="navbar-brand" href="index.php" title='Inicio' target="_blank">Inicio</a> </div>
  </div>
</div>
<div class="container">
  <div class="page-header">
    <h1 class="h3">Agregar nueva imágen. <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Mostrar todo </a></h1>
  </div>
  <?php
	if(isset($errMSG)){
			?>
  <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong> </div>
  <?php
	}
	else if(isset($successMSG)){
		?>
  <div class="alert alert-success"> <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong> </div>
  <?php
	}
	?>
  <form method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="calculations();">
    <table class="table table-bordered table-responsive">
      <tr>
        <td><label class="control-label">Nombre</label></td>
        <td><input class="form-control" type="text" name="card_name" placeholder="Ingrese el Nombre" value="<?php echo $cardname; ?>" /></td>
      </tr>
      <tr>
        <td><label class="control-label">Tipo</label></td>
        <td>
        	<!-- <input class="form-control" type="text" name="card_tipo" placeholder="Ingrese la calidad" value="<?php echo $cardtipo; ?>" /> -->
        	<select class="form-control card_tipo" name="card_tipo" placeholder="Elija la calidad" >
        		<option value="Común">Común</option>
        		<option value="Especial">Especial</option>
        		<option value="Épica">Épica</option>
        		<option value="Legendaria">Legendaria</option>
        	</select>
        </td>
      </tr>
      <tr>
        <td><label class="control-label">Imágen.</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
      </tr>

      <tr>
        <td><label class="control-label">Nivel</label></td>
        <td><input class="form-control card_nivel" type="number" name="card_nivel" placeholder="Ingrese el Nivel" value="<?php echo $cardnivel; ?>" /></td>
      </tr>
      <tr>
        <td><label class="control-label">Cantidad:</label></td>
        <td>
        	<input class="form-control card_cantidad" type="text" name="card_cantidad" placeholder="Ingrese la Cantidad" value="<?php echo $cardcantidad; ?>" />
        </td>
      </tr>


      <tr>
        <td><label class="control-label">Sig. Nivel</label></td>
        <td><input class="form-control card_nextlevel" type="text" name="card_nextlevel" placeholder="Ingrese el Modelo" value="<?php echo $cardnextlevel; ?>" /></td>
      </tr>

      <tr>
        <td><label class="control-label">Nivel 13</label></td>
        <td><input class="form-control card_level13" type="text" name="card_level13" placeholder="Ingrese el Modelo" value="<?php echo $cardlevel13; ?>" /></td>
      </tr>

      <tr>
        <td><label class="control-label">Total Oro</label></td>
        <td><input class="form-control card_orototal" type="text" name="card_orototal" placeholder="Ingrese el Modelo" value="<?php echo $cardorototal; ?>" /></td>
      </tr>


      <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default"> <span class="glyphicon glyphicon-save"></span> &nbsp; Guardar Imagen </button></td>
      </tr>
    </table>
  </form>
  <div class="alert alert-info"> <strong>Tutorial Vinculo!</strong> <a href="https://baulcode.com">Ir al Tutorial</a>! </div>
</div>

<!-- Latest compiled and minified JavaScript --> 
<script src="bootstrap/js/bootstrap.min.js"></script>


<script>
// document.querySelector("form").addEventListener("submit",calculations);
function calculations(){
	let currentLevel = document.querySelector(".card_nivel").value;
	let currentAmmount = document.querySelector(".card_cantidad").value;
	let quality = document.querySelector(".card_tipo").value;
	let nextLevelUnits;
	let nextLevelGold;
	let finalLevelUnits;
	let finalLevelGold;
	let topCardsNextLevel;

	if ( currentLevel == 13 ) {
		nextLevelUnits = 0;
		nextLevelGold = 0;
		finalLevelGold = 0;
	} else {
		nextLevelUnits = parseInt(currentLevel) +1;

		switch(quality) {
			case "Común":
				// code				
				switch(currentLevel) {
					case "1":
						// code
						topCardsNextLevel = 2;
						var level13TotalCards = 9586;
						break;

					case "2":
						// code
						topCardsNextLevel = 4;
						var level13TotalCards = 9584;
						break;

					case "3":
						// code
						topCardsNextLevel = 10;
						var level13TotalCards = 9580;
						break;

					case "4":
						// code
						topCardsNextLevel = 20;
						var level13TotalCards = 9570;
						break;

					case "5":
						// code
						topCardsNextLevel = 50;
						var level13TotalCards = 9550;
						break;

					case "6":
						// code
						topCardsNextLevel = 100;
						var level13TotalCards = 9500;
						break;

					case "7":
						// code
						topCardsNextLevel = 200;
						var level13TotalCards = 9400;
						break;

					case "8":
						// code
						topCardsNextLevel = 400;
						var level13TotalCards = 9200;
						break;

					case "9":
						// code
						topCardsNextLevel = 800;
						var level13TotalCards = 8800;
						break;

					case "10":
						// code
						topCardsNextLevel = 1000;
						var level13TotalCards = 8000;
						break;

					case "11":
						// code
						topCardsNextLevel = 2000;
						var level13TotalCards = 7000;
						break;

					case "12":
						// code
						topCardsNextLevel = 5000;
						var level13TotalCards = 5000;
						break;
				}
				break;

			case "Especial":
				// code
				switch(currentLevel) {
					case "6":
						// code
						topCardsNextLevel = 20;
						var level13TotalCards = 2570;
						break;

					case "7":
						// code
						topCardsNextLevel = 50;
						var level13TotalCards = 2550;
						break;

					case "8":
						// code
						topCardsNextLevel = 100;
						var level13TotalCards = 2500;
						break;

					case "9":
						// code
						topCardsNextLevel = 200;
						var level13TotalCards = 2400;
						break;

					case "10":
						// code
						topCardsNextLevel = 400;
						var level13TotalCards = 2200;
						break;

					case "11":
						// code
						topCardsNextLevel = 800;
						var level13TotalCards = 1800;
						break;

					case "12":
						// code
						topCardsNextLevel = 1000;
						var level13TotalCards = 1000;
						break;
				}
				break;

			case "Épica":
				// code
				switch(currentLevel) {
					case "6":
						// code
						topCardsNextLevel = 2;
						var level13TotalCards = 386;
						break;

					case "7":
						// code
						topCardsNextLevel = 4;
						var level13TotalCards = 384;
						break;

					case "8":
						// code
						topCardsNextLevel = 10;
						var level13TotalCards = 380;
						break;

					case "9":
						// code
						topCardsNextLevel = 20;
						var level13TotalCards = 370;
						break;

					case "10":
						// code
						topCardsNextLevel = 50;
						var level13TotalCards = 350;
						break;

					case "11":
						// code
						topCardsNextLevel = 100;
						var level13TotalCards = 300;
						break;

					case "12":
						// code
						topCardsNextLevel = 200;
						var level13TotalCards = 200;
						break;
				}
				break;

			case "Legendaria":
				// code
				switch(currentLevel) {
					case "9":
						// code
						topCardsNextLevel = 2;
						var level13TotalCards = 36;
						break;

					case "10":
						// code
						topCardsNextLevel = 4;
						var level13TotalCards = 34;
						break;

					case "11":
						// code
						topCardsNextLevel = 10;
						var level13TotalCards = 30;
						break;

					case "12":
						// code
						topCardsNextLevel = 20;
						var level13TotalCards = 20;
						break;
				}				
				break;
		}
		nextLevelUnits = topCardsNextLevel - parseInt(currentAmmount);
		document.querySelector(".card_nextlevel").value = nextLevelUnits;

		finalLevelUnits = level13TotalCards - parseInt(currentAmmount);
		document.querySelector(".card_level13").value = finalLevelUnits;
	}

	// REVIEW CALCULATIONS
	switch(currentLevel) {
		case "1":
			finalLevelGold = 185625;
			break;
		case "2":
			finalLevelGold = 185620;
			break;
		case "3":
			finalLevelGold = 185600;
			break;
		case "4":
			finalLevelGold = 185550;
			break;
		case "5":
			finalLevelGold = 185400;
			break;

		case "6":
			// code
			finalLevelGold = 185000;
			break;

		case "7":
			// code
			finalLevelGold = 184000;
			break;

		case "8":
			// code
			finalLevelGold = 182000;
			break;

		case "9":
			// code
			finalLevelGold = 178000;
			break;

		case "10":
			// code
			finalLevelGold = 170000;
			break;

		case "11":
			// code
			finalLevelGold = 150000;
			break;

		case "12":
			// code
			finalLevelGold = 100000;
			break;
	}	
	document.querySelector(".card_orototal").value = finalLevelGold;

	return true;

}
</script>

</body>



</html>