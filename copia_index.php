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
</head>
<style type="text/css">
table {
    font-size: 12px;
    color: #333333;
    width: 100%;
    border-width: 1px;
    border-color: #729ea5;
    border-collapse: collapse;
}
table th {
    font-size: 12px;
    background-color: #acc8cc;
    border-width: 1px;
    padding: 8px;
    border-style: solid;
    border-color: #729ea5;
    text-align: left;
    cursor: pointer;
}
table tr {
    background-color: #ffffff;
}
table td {
    font-size: 12px;
    border-width: 1px;
    padding: 8px;
    border-style: solid;
    border-color: #729ea5;
}
table tr:hover {
    background-color: #ffff99;
}
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
  </div>
  <br />
  <table border="1">
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
				<td><img src="imagenes/<?php echo $row['card_Img']; ?>" width="50" alt="<?php echo $card_Nombre ?>" /></td>
				<td><?php echo $card_Nombre ?></td>
				<td><?php echo $card_Tipo ?></td>
				<td><?php echo $card_Nivel ?></td>
				<td><?php echo $card_Cantidad ?></td>
				<td><?php echo $card_NextLevel ?></td>
				<td><?php echo $card_Lavel13 ?></td>
				<td><?php echo $card_OroTotal ?></td>
				<td>
					<span> 
      					<a class="btn btn-info" href="EditarImagen.php?edit_id=<?php echo $row['card_ID']; ?>" title="click for edit" onclick="return confirm('Esta seguro de editar el archivo ?')"><span class="glyphicon glyphicon-edit"></span> Editar</a> 
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


</div>
<script src="bootstrap/js/bootstrap.min.js"></script>


<script>
// NEW
const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr) );
})));

</script>

</body>
</html>