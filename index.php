<?php
// Archivo de conexion con la base de datos
require_once 'Conexion.php';
// Condicional para validar el borrado de la imagen
if(isset($_GET['delete_id']))
{
	// Selecciona imagen a borrar
	$stmt_select = $DB_con->prepare('SELECT card_Img FROM tbl_cards WHERE card_ID =:uid');
	$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
	$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
	// Ruta de la imagen
	unlink("imagenes/".$imgRow['card_Img']);
	
	// Consulta para eliminar el registro de la base de datos
	$stmt_delete = $DB_con->prepare('DELETE FROM tbl_cards WHERE card_ID =:uid');
	$stmt_delete->bindParam(':uid',$_GET['delete_id']);
	$stmt_delete->execute();
	// Redireccioa al inicio
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=yes" />
<title>Clash Royale Statics</title>
<meta name="keywords" content="Subir imagen al servidor usando PDO MySQL">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<script src="bootstrap/js/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<style type="text/css">

</style>

<body>
<div class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> <a class="navbar-brand" href="index.php" title='Inicio' target="_blank">Inicio</a> </div>
  </div>
</div>
<div class="container">
  <div class="page-header">
    <h1 class="h2">Mostrar todos. / <a class="btn btn-default" href="AgregarNuevo.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp; Agregar nuevo</a></h1>

    <div class="header__buttons">
      <a href="#" class="ctaComun">Comunes</a>
      <a href="#" class="ctaEspe">Especiales</a>
      <a href="#" class="ctaEpic">Épicas</a>
      <a href="#" class="ctaLegend">Legendarias</a>
      <a href="#" class="ctaAll">Todas</a>
    </div>
  </div>


  <br />

  <div class="results">
    <span id="calc13">CALCULA</span>
    <div id="total13suma"></div>
  </div>


  <div style="
    display: flex;
    justify-content: space-around;
    margin: 12px auto;
">
    <div id="soloComun">SOLO COMUNES</div>
    <div id="soloEspecial">SOLO ESPECIALES</div>
    <div id="soloEpica">SOLO ÉPICAS</div>
    <div id="soloLegendaria">SOLO LEGENDARIAS</div>
  </div>

  <div class="tablaEjemplo">
    <table class="GeneratedTable">
      <thead>
        <tr>
          <th>-</th>
          <th>II</th>
          <th>III</th>
          <th>IV</th>
          <th>V</th>
          <th>VI</th>
          <th>VII</th>
          <th>VIII</th>
          <th>IX</th>
          <th>X</th>
          <th>XI</th>
          <th>XII</th>
          <th>XIII</th>
        </tr>
      </thead>
      <tbody>
        <tr style="background-color: #a1d0dc;">
          <td rowspan="2">Común</td>
          <td>2</td>
          <td>4</td>
          <td>10</td>
          <td>20</td>
          <td>50</td>
          <td>100</td>
          <td>200</td>
          <td>400</td>
          <td>800</td>
          <td>1000</td>
          <td>2000</td>
          <td>5000</td>
        </tr>
        <tr style="background-color: #a1d0dc;">
          <!-- <td>Cell</td> -->
          <td>9586</td>
          <td>9584</td>
          <td>9580</td>
          <td>9570</td>
          <td>9550</td>
          <td>9500</td>
          <td>9400</td>
          <td>9200</td>
          <td>8800</td>
          <td>8000</td>
          <td>7000</td>
          <td>5000</td>
        </tr>
        <tr>
          <td rowspan="2">Especial</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td>20</td>
          <td>50</td>
          <td>100</td>
          <td>200</td>
          <td>400</td>
          <td>800</td>
          <td>1000</td>
        </tr>
        <tr>
          <!-- <td>Cell</td> -->
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td>2570</td>
          <td>2550</td>
          <td>2500</td>
          <td>2400</td>
          <td>2200</td>
          <td>1800</td>
          <td>1000</td>
        </tr>
        <tr  style="background-color: #c5a1dc;">
          <td rowspan="2">Épica</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td>2</td>
          <td>4</td>
          <td>10</td>
          <td>20</td>
          <td>50</td>
          <td>100</td>
          <td>200</td>
        </tr>
        <tr  style="background-color: #c5a1dc;">
          <!-- <td>Cell</td> -->
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td>386</td>
          <td>384</td>
          <td>380</td>
          <td>370</td>
          <td>350</td>
          <td>300</td>
          <td>200</td>
        </tr>
        <tr>
          <td rowspan="2">Legendaria</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td>2</td>
          <td>4</td>
          <td>10</td>
          <td>20</td>
        </tr>
        <tr>
          <!-- <td>Cell</td> -->
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td class="null">x</td>
          <td>36</td>
          <td>34</td>
          <td>30</td>
          <td>20</td>
        </tr>
      </tbody>
    </table>  
  </div>

  <br />
  <br />

  <table border="1" class="royaleTable" id="crudroyale">
    <tr>
    	<th>Imagen</th>
      <th>Carta</th>
      <th>Calidad</th>
      <th>Nivel</th>
      <th>Cantidad</th>
      <th>Sig. Nivel</th>
      <th>Nivel 13</th>
      <th>Total Oro</th>
      <th>Acciones</th>
    </tr>


    <?php
	
	$stmt = $DB_con->prepare('SELECT card_ID, card_Img, card_Nombre, card_Tipo, card_Nivel, card_Cantidad, card_NextLevel, card_Lavel13, card_OroTotal FROM tbl_cards ORDER BY card_ID DESC');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>

      <?php
        // $cardClass = "";
        // if ($card_Tipo == "Común") {

        // } else if ($card_Tipo == "Especial") {

        // } else if ($card_Tipo == "Épica") {

        // } else if ($card_Tipo == "Legendaria") {

        // }
      ?>

			<tr  class="colorClass <?php echo $card_Tipo ?> ">
				<td><img src="imagenes/<?php echo $row['card_Img']; ?>" width="80" alt="<?php echo $card_Nombre ?>" /></td>
				<td><?php echo $card_Nombre ?></td>
				<td><?php echo $card_Tipo ?></td>
				<td><?php echo $card_Nivel ?></td>
				<td style="font-weight: bolder;color: green;"><?php echo $card_Cantidad ?></td>
				<td><?php echo $card_NextLevel ?></td>
				<td style="color: red;"><?php echo $card_Lavel13 ?></td>
				<td><?php echo $card_OroTotal ?></td>
				<td>
					<span> 
      					<a class="btn btn-info" href="EditarImagen.php?edit_id=<?php echo $row['card_ID']; ?>" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
      					<a class="btn btn-danger" href="?delete_id=<?php echo $row['card_ID']; ?>" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
      				</span>
      			</td>
  			</tr>
    <?php
		}
	}
	else
	{
		?>
    <div class="col-xs-12">
      <div class="alert alert-warning"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Datos no encontrados ... </div>
    </div>
    <?php
	}
	
?>

  </table>

  <br>

<table class="totalesTabla royaleTable">
    <tr class="resumen">
        <td><span id="calcs">Calcular</span></td>
        <td>XXXX</td>
        <td>Valor Compra:</td>
        <td>XXXX</td>
        <td>Uds. Totales: </td>
        <td></td>
        <td>Resto N13:</td>
        <td>Oro Total:</td>
        <td>Progreso:</td>
    </tr>
    <tr>
        <td>---</td>
        <td>---</td>
        <td><span id="totalPurchase"></span></td>
        <td>---</td>
        <td><span id="totalUnits"></span></td>
        <td></td>
        <td><span id="totalLefts"></span></td>
        <td><span id="totalGold"></span></td>
        <td><span id="actualPercent"></span> %</td>
    </tr>
    <tr>
        <td colspan="9" style="background-color: black">---</td>
    </tr>
    <tr>
        <td colspan="9" style="text-align: center;">Registros Viejos</td>    
    </tr>
        
</table>









    <div class="information">
<table style="height: 215px;" width="830" class="infotable">
  <tbody>
    <tr>
    <td style="width: 133px;">
    <p>TIPO</p>
    </td>
    <td style="width: 115px;">
    <p>Uds. Totales</p>
    </td>
    <td style="width: 115px;">
    <p>Uds.</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Uds. 13</p>
    <p>Compra</p>
    </td>
    <td style="width: 116px;">
    <p>Todas</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Progreso</p>
    </td>
    <td style="width: 118px;">
    <p>Variaci&oacute;n</p>
    </td>
    </tr>
    <tr style="background-color: #91daf2;">
    <td style="width: 133px;">
    <p>Com&uacute;n</p>
    </td>
    <td style="width: 115px;">
    <p>181,777</p>
    </td>
    <td style="width: 115px;">
    <p>11,323</p>
    </td>
    <td style="width: 116px;">
    <p>113,230</p>
    </td>
    <td style="width: 116px;">
    <p>4,011,000</p>
    </td>
    <td style="width: 116px;">
    <p>94.14 %</p>
    </td>
    <td style="width: 118px;">
    <p>-</p>
    </td>
    </tr>
    <tr style="background-color: #fdac81;">
    <td style="width: 133px;">
    <p>Especial</p>
    </td>
    <td style="width: 115px;">
    <p>39,578</p>
    </td>
    <td style="width: 115px;">
    <p>12,492</p>
    </td>
    <td style="width: 116px;">
    <p>1,249,200</p>
    </td>
    <td style="width: 116px;">
    <p>3,988,000</p>
    </td>
    <td style="width: 116px;">
    <p>76.01 %</p>
    </td>
    <td style="width: 118px;">
    <p>-</p>
    </td>
    </tr>
    <tr style="background-color: #bc86e4;">
    <td style="width: 133px;">
    <p>&Eacute;pica</p>
    </td>
    <td style="width: 115px;">
    <p>3,116</p>
    </td>
    <td style="width: 115px;">
    <p>5,846</p>
    </td>
    <td style="width: 116px;">
    <p>5,846,000</p>
    </td>
    <td style="width: 116px;">
    <p>4,367,000</p>
    </td>
    <td style="width: 116px;">
    <p>34.77 %</p>
    </td>
    <td style="width: 118px;">
    <p>-</p>
    </td>
    </tr>
    <tr style="background-color: #729ea5;">
    <td style="width: 133px;">
    <p>Legendaria</p>
    </td>
    <td style="width: 115px;">
    <p>96</p>
    </td>
    <td style="width: 115px;">
    <p>474</p>
    </td>
    <td style="width: 116px;">
    <p>18,960,000</p>
    </td>
    <td style="width: 116px;">
    <p>2,846,000</p>
    </td>
    <td style="width: 116px;">
    <p>16.84 %</p>
    </td>
    <td style="width: 118px;">
    <p>-</p>
    </td>
    </tr>
    <tr>
    <td style="width: 133px;">
    <p>TODAS:</p>
    </td>
    <td style="width: 115px;">
    <p>224,567</p>
    </td>
    <td style="width: 115px;">
    <p>30,135</p>
    </td>
    <td style="width: 116px;">
    <p>26,168,430</p>
    </td>
    <td style="width: 116px;">
    <p>15,212,000</p>
    </td>
    <td style="width: 116px;">
    <p>88.17%</p>
    </td>
    <td style="width: 118px;">
    <p>-</p>
    </td>
    </tr>
  </tbody>
</table>      
    </div>

<br><br>
<h2>SEMANA 2</h2>
    <div class="information">
<table style="height: 215px;" width="830" class="infotable">
  <tbody>
    <tr>
    <td style="width: 133px;">
    <p>TIPO</p>
    </td>
    <td style="width: 115px;">
    <p>Uds. Totales</p>
    </td>
    <td style="width: 115px;">
    <p>Uds.</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Uds. 13</p>
    <p>Compra</p>
    </td>
    <td style="width: 116px;">
    <p>Todas</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Progreso</p>
    </td>
    <td style="width: 198px;">
    <p>Variaci&oacute;n</p>
    </td>
    </tr>
    <tr style="background-color: #91daf2;">
    <td style="width: 133px;">
    <p>Com&uacute;n</p>
    </td>
    <td style="width: 115px;">
    <p>183,389</p>
    </td>
    <td style="width: 115px;">
    <p>9,711</p>
    </td>
    <td style="width: 116px;">
    <p>97,110</p>
    </td>
    <td style="width: 116px;">
    <p>4,011,000</p>
    </td>
    <td style="width: 116px;">
    <p>94.97 %</p>
    </td>
    <td style="width: 198px;">
    <p>1.612 - 0.83 % - [16.120 €]</p>
    </td>
    </tr>
    <tr style="background-color: #fdac81;">
    <td style="width: 133px;">
    <p>Especial</p>
    </td>
    <td style="width: 115px;">
    <p>39,937&nbsp;&nbsp;</p>
    </td>
    <td style="width: 115px;">
    <p>12,133</p>
    </td>
    <td style="width: 116px;">
    <p>1,213,300</p>
    </td>
    <td style="width: 116px;">
    <p>3,988,000</p>
    </td>
    <td style="width: 116px;">
    <p>76.70 %</p>
    </td>
    <td style="width: 198px;">
    <p>359 - 0.69% - [35.900 €]</p>
    </td>
    </tr>
    <tr style="background-color: #bc86e4;">
    <td style="width: 133px;">
    <p>&Eacute;pica</p>
    </td>
    <td style="width: 115px;">
    <p>3,162</p>
    </td>
    <td style="width: 115px;">
    <p>5,800</p>
    </td>
    <td style="width: 116px;">
    <p>5,800,000</p>
    </td>
    <td style="width: 116px;">
    <p>4,367,000</p>
    </td>
    <td style="width: 116px;">
    <p>35.28 %</p>
    </td>
    <td style="width: 198px;">
    <p>46 - 0.51% - [46.000 €]</p>
    </td>
    </tr>
    <tr style="background-color: #729ea5;">
    <td style="width: 133px;">
    <p>Legendaria</p>
    </td>
    <td style="width: 115px;">
    <p>96</p>
    </td>
    <td style="width: 115px;">
    <p>474</p>
    </td>
    <td style="width: 116px;">
    <p>18,960,000</p>
    </td>
    <td style="width: 116px;">
    <p>2,846,000</p>
    </td>
    <td style="width: 116px;">
    <p>16.84 %</p>
    </td>
    <td style="width: 198px;">
    <p> 3 - 0 - [0]</p>
    </td>
    </tr>
    <tr>
    <td style="width: 133px;">
    <p>TODAS:</p>
    </td>
    <td style="width: 115px;">
    <p>224,567</p>
    </td>
    <td style="width: 115px;">
    <p>30,135</p>
    </td>
    <td style="width: 116px;">
    <p>26,168,430</p>
    </td>
    <td style="width: 116px;">
    <p>15,212,000</p>
    </td>
    <td style="width: 116px;">
    <p>88.17%</p>
    </td>
    <td style="width: 198px;">
    <p>-</p>
    </td>
    </tr>
  </tbody>
</table>      
    </div>

  <br>

<br><br>
<h2>SEMANA 3</h2>
    <div class="information">
<table style="height: 215px;" width="830" class="infotable">
  <tbody>
    <tr>
    <td style="width: 133px;">
    <p>TIPO</p>
    </td>
    <td style="width: 115px;">
    <p>Uds. Totales</p>
    </td>
    <td style="width: 115px;">
    <p>Uds.</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Uds. 13</p>
    <p>Compra</p>
    </td>
    <td style="width: 116px;">
    <p>Todas</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Progreso</p>
    </td>
    <td style="width: 198px;">
    <p>Variaci&oacute;n</p>
    </td>
    </tr>
    <tr style="background-color: #91daf2;">
    <td style="width: 133px;">
    <p>Com&uacute;n</p>
    </td>
    <td style="width: 115px;">
    <p>184,695</p>
    </td>
    <td style="width: 115px;">
    <p>8,405</p>
    </td>
    <td style="width: 116px;">
    <p>84,050</p>
    </td>
    <td style="width: 116px;">
    <p>4,011,000</p>
    </td>
    <td style="width: 116px;">
    <p>95.65 %</p>
    </td>
    <td style="width: 198px;">
    <p>1.306 - 0.68 % - [13.060 €]</p>
    </td>
    </tr>
    <tr style="background-color: #fdac81;">
    <td style="width: 133px;">
    <p>Especial</p>
    </td>
    <td style="width: 115px;">
    <p>40,211</p>
    </td>
    <td style="width: 115px;">
    <p>11,859</p>
    </td>
    <td style="width: 116px;">
    <p>1,185,900</p>
    </td>
    <td style="width: 116px;">
    <p>3,988,000</p>
    </td>
    <td style="width: 116px;">
    <p>77.22 %</p>
    </td>
    <td style="width: 198px;">
    <p>274 - 0.52% - [27.400 €]</p>
    </td>
    </tr>
    <tr style="background-color: #bc86e4;">
    <td style="width: 133px;">
    <p>&Eacute;pica</p>
    </td>
    <td style="width: 115px;">
    <p>3,174</p>
    </td>
    <td style="width: 115px;">
    <p>5,788</p>
    </td>
    <td style="width: 116px;">
    <p>5,788,000</p>
    </td>
    <td style="width: 116px;">
    <p>4,367,000</p>
    </td>
    <td style="width: 116px;">
    <p>35.42 %</p>
    </td>
    <td style="width: 198px;">
    <p>12 - 0.12% - [12.000 €]</p>
    </td>
    </tr>
    <tr style="background-color: #729ea5;">
    <td style="width: 133px;">
    <p>Legendaria</p>
    </td>
    <td style="width: 115px;">
    <p>99</p>
    </td>
    <td style="width: 115px;">
    <p>471</p>
    </td>
    <td style="width: 116px;">
    <p>18,840,000</p>
    </td>
    <td style="width: 116px;">
    <p>2,846,000</p>
    </td>
    <td style="width: 116px;">
    <p>17.37 %</p>
    </td>
    <td style="width: 198px;">
    <p> 3 - 0.53% - [120.000 €]</p>
    </td>
    </tr>
    <tr>
    <td style="width: 133px;">
    <p>TODAS:</p>
    </td>
    <td style="width: 115px;">
    <p>228,179</p>
    </td>
    <td style="width: 115px;">
    <p>26,523</p>
    </td>
    <td style="width: 116px;">
    <p>24,897,950</p>
    </td>
    <td style="width: 116px;">
    <p>15,212,000</p>
    </td>
    <td style="width: 116px;">
    <p>89.59%</p>
    </td>
    <td style="width: 198px;">
    <p>3.612 - 1.42% - [172.460 €] </p>
    </td>
    </tr>
  </tbody>
</table>      




<br><br>
<h2>SEMANA 4</h2>
    <div class="information">
<table style="height: 215px;" width="830" class="infotable">
  <tbody>
    <tr>
    <td style="width: 133px;">
    <p>TIPO</p>
    </td>
    <td style="width: 115px;">
    <p>Uds. Totales</p>
    </td>
    <td style="width: 115px;">
    <p>Uds.</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Uds. 13</p>
    <p>Compra</p>
    </td>
    <td style="width: 116px;">
    <p>Todas</p>
    <p>Nivel 13</p>
    </td>
    <td style="width: 116px;">
    <p>Progreso</p>
    </td>
    <td style="width: 198px;">
    <p>Variaci&oacute;n</p>
    </td>
    </tr>
    <tr style="background-color: #91daf2;">
    <td style="width: 133px;">
    <p>Com&uacute;n</p>
    </td>
    <td style="width: 115px;">
    <p>186,373</p>
    </td>
    <td style="width: 115px;">
    <p>6,727</p>
    </td>
    <td style="width: 116px;">
    <p>67,270</p>
    </td>
    <td style="width: 116px;">
    <p>4,011,000</p>
    </td>
    <td style="width: 116px;">
    <p>96.52 %</p>
    </td>
    <td style="width: 198px;">
    <p>1.678 - 0.87% - [16.780 €]</p>
    </td>
    </tr>
    <tr style="background-color: #fdac81;">
    <td style="width: 133px;">
    <p>Especial</p>
    </td>
    <td style="width: 115px;">
    <p>40,409</p>
    </td>
    <td style="width: 115px;">
    <p>11,661</p>
    </td>
    <td style="width: 116px;">
    <p>1,166,100</p>
    </td>
    <td style="width: 116px;">
    <p>3,988,000</p>
    </td>
    <td style="width: 116px;">
    <p>77.61 %</p>
    </td>
    <td style="width: 198px;">
    <p>198 - 0.39% - [19.800 €]</p>
    </td>
    </tr>
    <tr style="background-color: #bc86e4;">
    <td style="width: 133px;">
    <p>&Eacute;pica</p>
    </td>
    <td style="width: 115px;">
    <p>3,190</p>
    </td>
    <td style="width: 115px;">
    <p>5,772</p>
    </td>
    <td style="width: 116px;">
    <p>5,772,000</p>
    </td>
    <td style="width: 116px;">
    <p>4,367,000</p>
    </td>
    <td style="width: 116px;">
    <p>35.59 %</p>
    </td>
    <td style="width: 198px;">
    <p>16 - 0.17% - [16.000 €]</p>
    </td>
    </tr>
    <tr style="background-color: #729ea5;">
    <td style="width: 133px;">
    <p>Legendaria</p>
    </td>
    <td style="width: 115px;">
    <p>100</p>
    </td>
    <td style="width: 115px;">
    <p>470</p>
    </td>
    <td style="width: 116px;">
    <p>18,800,000</p>
    </td>
    <td style="width: 116px;">
    <p>2,846,000</p>
    </td>
    <td style="width: 116px;">
    <p>17.54 %</p>
    </td>
    <td style="width: 198px;">
    <p> 1 - 0.17% - [40.000 €]</p>
    </td>
    </tr>
    <tr>
    <td style="width: 133px;">
    <p>TODAS:</p>
    </td>
    <td style="width: 115px;">
    <p>230,072</p>
    </td>
    <td style="width: 115px;">
    <p>24,630</p>
    </td>
    <td style="width: 116px;">
    <p>25.805.370</p>
    </td>
    <td style="width: 116px;">
    <p>15,212,000</p>
    </td>
    <td style="width: 116px;">
    <p>90.33%</p>
    </td>
    <td style="width: 198px;">
    <p>1.893 - 1.74% - [92.580 €] </p>
    </td>
    </tr>
  </tbody>
</table>   
    </div>

  <br>


  <br>


    <h3>Preferencias:</h3>
    <ul>
      <li>Bruja: -222 || Bluk: 113 || Sct: 81 </li>
      <li>Bebé Dragón: -182 || Bluk: 97 || Sct: 74 </li>
      <li>Príncipe: -195 || Bluk: 111 || Sct: 123 </li>
      <li>Hielo: -228 || Bluk: 117 || Sct: 142 </li>
      <li>Verdugo: -187 || Bluk: 145 || Sct: 92 </li>
      <li>Ballesta: -266 || Bluk: 130 || Sct: 117 </li>
      <li>----</li>
      <li>Mega Caballero: -20 || Bluk: 13 || Sct: 5 </li>
      <li>Bruja Nocturna: -25 || Bluk:  5 || Sct: 9 </li>
      <li>Mago Eléctrico: -31 || Bluk:  8 || Sct: 9 </li>
    </ul>

<!--     <table border="1" class="royaleTable" id="caca">
      <tbody>
          <tr>
              <th>Imagen</th>
              <th>Carta</th>
              <th>Calidad</th>
              <th>Nivel</th>
              <th>Cantidad</th>
              <th>Sig. Nivel</th>
              <th>Nivel 13</th>
              <th>Total Oro</th>
              <th>Acciones</th>
         </tr>



            <tr class="colorClass Épica ">
                <td><img src="imagenes/621476.png" width="80" alt="Príncipe"></td>
                <td>Príncipe</td>
                <td>Épica</td>
                <td>11</td>
                <td>105</td>
                <td>-5</td>
                <td>195</td>
                <td>150000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=111" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=111" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
            <tr class="colorClass Épica ">
                <td><img src="imagenes/122596.png" width="80" alt="Bebé Dragón"></td>
                <td>Bebé Dragón</td>
                <td>Épica</td>
                <td>11</td>
                <td>118</td>
                <td>-18</td>
                <td>182</td>
                <td>150000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=104" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=104" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>            
            <tr class="colorClass Épica ">
                <td><img src="imagenes/650190.png" width="80" alt="Bruja"></td>
                <td>Bruja</td>
                <td>Épica</td>
                <td>11</td>
                <td>78</td>
                <td>22</td>
                <td>222</td>
                <td>150000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=110" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=110" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
            <tr class="colorClass Épica ">
                <td><img src="imagenes/471185.png" width="80" alt="Hielo"></td>
                <td>Hielo</td>
                <td>Épica</td>
                <td>10</td>
                <td>122</td>
                <td>-72</td>
                <td>228</td>
                <td>170000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=107" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=107" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
            <tr class="colorClass Épica ">
                <td><img src="imagenes/134301.png" width="80" alt="Verdugo"></td>
                <td>Verdugo</td>
                <td>Épica</td>
                <td>11</td>
                <td>113</td>
                <td>-13</td>
                <td>187</td>
                <td>150000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=113" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=113" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
            <tr class="colorClass Épica ">
                <td><img src="imagenes/580520.png" width="80" alt="Ballesta"></td>
                <td>Ballesta</td>
                <td>Épica</td>
                <td>8</td>
                <td>114</td>
                <td>-104</td>
                <td>266</td>
                <td>182000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=118" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=118" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
            <tr class="colorClass Legendaria ">
                <td><img src="imagenes/391877.png" width="80" alt="Megacaballero"></td>
                <td>Megacaballero</td>
                <td>Legendaria</td>
                <td>11</td>
                <td>10</td>
                <td>0</td>
                <td>20</td>
                <td>150000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=138" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=138" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
            <tr class="colorClass Legendaria ">
                <td><img src="imagenes/375516.png" width="80" alt="Bruja Nocturna"></td>
                <td>Bruja Nocturna</td>
                <td>Legendaria</td>
                <td>11</td>
                <td>5</td>
                <td>5</td>
                <td>25</td>
                <td>150000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=132" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=132" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
            <tr class="colorClass Legendaria ">
                <td><img src="imagenes/97280.png" width="80" alt="Mago Eléctrico"></td>
                <td>Mago Eléctrico</td>
                <td>Legendaria</td>
                <td>10</td>
                <td>3</td>
                <td>1</td>
                <td>31</td>
                <td>170000</td>
                <td>
                    <span> 
                        <a class="btn btn-info" href="EditarImagen.php?edit_id=131" title="click for edit" onclick="editCard()"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
                        <a class="btn btn-danger" href="?delete_id=131" title="click for delete" onclick="return confirm('Esta seguro de eliminar el archivo?')"><span class="glyphicon glyphicon-remove-circle"></span> Borrar</a> 
                    </span>
                </td>
            </tr>
        </tbody>
    </table> -->
</div>

<a id="back2Top" title="Back to top" href="#">&#10148;</a>





</body>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="funciones.js"></script>

<script>

</script>

</html>