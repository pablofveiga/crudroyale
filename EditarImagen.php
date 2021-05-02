<?php
error_reporting( ~E_NOTICE );	
require_once 'Conexion.php';

if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	$stmt_edit = $DB_con->prepare('SELECT card_Img, card_Nombre, card_Tipo, card_Nivel, card_Cantidad, card_NextLevel, card_Lavel13, card_OroTotal FROM tbl_cards WHERE card_ID =:uid');
	$stmt_edit->execute(array(':uid'=>$id));
	$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
	extract($edit_row);
}
else
{
	header("Location: index.php");
}	

if(isset($_POST['btn_save_updates']))
{
	$cardname = $_POST['card_name'];// nombre de carta
	$cardtipo = $_POST['card_tipo'];// tipo de carta
	$cardnivel = $_POST['card_nivel'];// nivel de carta
	$cardcantidad = $_POST['card_cantidad'];// cant. de cartas
	$cardnextlevel = $_POST['card_nextlevel'];// cant. de cartas sig nivel
	$cardlevel13 = $_POST['card_level13'];// cant. de cartas sig nivel
	$cardorototal = $_POST['card_orototal'];// cant. oro nivel 13
		
	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];
				
	if($imgFile)
	{
		$upload_dir = 'imagenes/'; // upload directory	
		$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		$userpic = rand(1000,1000000).".".$imgExt;
		if(in_array($imgExt, $valid_extensions))
		{			
			if($imgSize < 1000000)
			{
				unlink($upload_dir.$edit_row['card_Img']);
				move_uploaded_file($tmp_dir,$upload_dir.$userpic);
			}
			else
			{
				$errMSG = "Su archivo es demasiado grande mayor a 1MB";
			}
		}
		else
		{
			$errMSG = "Solo archivos JPG, JPEG, PNG & GIF .";		
		}	
	}
	else
	{
		// if no image selected the old image remain as it is.
		$userpic = $edit_row['card_Img']; // old image from database
	}	
					
	
	// if no error occured, continue ....
	if(!isset($errMSG))
	{
		$stmt = $DB_con->prepare('UPDATE tbl_cards 
									 SET card_Nombre=:cname, 
										 card_Tipo=:ctipo, 
										 card_Img=:upic,
										 card_Nivel=:cnivel,
										 card_Cantidad=:ccant,
										 card_NextLevel=:cnlevl,
										 card_Lavel13=:clev13,
										 card_OroTotal=:cortt
								   WHERE card_ID=:uid');
		$stmt->bindParam(':cname',$cardname);
		$stmt->bindParam(':ctipo',$cardtipo);
		$stmt->bindParam(':upic',$userpic);
		$stmt->bindParam(':cnivel',$cardnivel);
		$stmt->bindParam(':ccant',$cardcantidad);
		$stmt->bindParam(':cnlevl',$cardnextlevel);
		$stmt->bindParam(':clev13',$cardlevel13);
		$stmt->bindParam(':cortt',$cardorototal);




		$stmt->bindParam(':uid',$id);
			
		if($stmt->execute()){
			?>
<script>
			// alert('Archivo editado correctamente ...');
			window.location.href='index.php';
			</script>
<?php
		}
		else{
			$errMSG = "Los datos no fueron actualizados !";
		}		
	}						
}	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Subir imagen al servidor usando PDO MySQL</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->

</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> <a class="navbar-brand" href="index.php" title='Inicio' target="_blank">Inicio</a> </div>
  </div>
</div>
<div class="container">
  <div class="page-header">
    <h1 class="h2">Actualización producto. <a class="btn btn-default" href="index.php"> Mostrar todos los modelos </a></h1>
  </div>
  <div class="clearfix"></div>
  <form method="post" enctype="multipart/form-data" onsubmit="calculations();" class="form-horizontal">
    <?php
	if(isset($errMSG)){
		?>
    <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?> </div>
    <?php
	}
	?>
    <table class="table table-bordered table-responsive">
      <tr>
        <td><label class="control-label">Nombre.</label></td>
        <td><input class="form-control" type="text" name="card_name" value="<?php echo $card_Nombre; ?>" required /></td>
      </tr>
      <tr>
        <td><label class="control-label">Tipo.</label></td>
        <td>
        	<!-- <input class="form-control" type="text" name="card_tipo" value="<?php echo $card_Tipo; ?>"  /> -->
        	<select class="form-control card_tipo" name="card_tipo" placeholder="Elija la calidad" >
        		<option <?php if ( $card_Tipo == "Común") { echo "selected";} ?> value="Común">Común</option>
        		<option <?php if ( $card_Tipo == "Especial") { echo "selected";} ?> value="Especial">Especial</option>
        		<option <?php if ( $card_Tipo == "Épica") { echo "selected";} ?> value="Épica">Épica</option>
        		<option <?php if ( $card_Tipo == "Legendaria") { echo "selected";} ?> value="Legendaria">Legendaria</option>
        	</select>
        </td>
      </tr>
      <tr>
        <td><label class="control-label">Imágen.</label></td>
        <td><p><img src="imagenes/<?php echo $card_Img; ?>" height="150" width="150" /></p>
          <input class="input-group" type="file" name="user_image" accept="image/*" /></td>
      </tr>

      <!-- AÑADIR CAMPOS -->
      <tr>
        <td><label class="control-label">Nivel:</label></td>
        <td>
        	<input class="form-control card_nivel" type="number" name="card_nivel" value="<?php echo $card_Nivel; ?>"  />
        </td>
      </tr>      
      <tr>
        <td><label class="control-label">Cantidad:</label></td>
        <td><input class="form-control card_cantidad" type="number" name="card_cantidad" value="<?php echo $card_Cantidad; ?>" /></td>
      </tr>
      <tr style="display: none;">
        <td><label class="control-label">Sig. Nivel:</label></td>
        <td><input class="form-control card_nextlevel" type="text" name="card_nextlevel" value="<?php echo $card_NextLevel; ?>" /></td>
      </tr>
      <tr style="display: none;">
        <td><label class="control-label">Nivel 13</label></td>
        <td><input class="form-control card_level13" type="text" name="card_level13" value="<?php echo $card_Lavel13; ?>" /></td>
      </tr>
      <tr style="display: none;">
        <td><label class="control-label">Total Oro:</label></td>
        <td><input class="form-control card_orototal" type="text" name="card_orototal" value="<?php echo $card_OroTotal; ?>" /></td>
      </tr>



      <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default"> <span class="glyphicon glyphicon-save"></span> Actualizar </button>
          <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancelar </a></td>
      </tr>
    </table>
  </form>
  <div class="alert alert-success"> <strong>Tutorial Vinculo!</strong> <a href="https://baulcode.com">Ir al Tutorial</a>! </div>
</div>

<script>
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

	// let valorUd;
	// let compra = document.querySelector(".card_Cantidad").value * valorUd;

	return true;

}
</script>
</body>
</html>