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
        <td>XXXX</td>
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
        <td>---</td>
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



<?php include("partials/stats.php") ?>





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