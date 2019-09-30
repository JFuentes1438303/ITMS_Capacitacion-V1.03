	<div class="container div2 color2">
		<div class="row b_bottom">
			<div class="col-sm-3 color1">
				<img src="../../files/img/Logo ITMS.png" class="logo2">
			</div>
			<div class="col-sm-9 encabezado2">
				Mis cursos
			</div>
		</div>

<?php

	$documento = $_SESSION['documento'];
	$directorio = "../../cursos/";
	include("conexion.php");

	$sql = "SELECT * FROM archivos WHERE documento = '$documento'";

	if(!$result = $db ->query($sql)){
		die ('Error al buscar los datos [' .$db->error .']');
	}

	while ($row = $result -> fetch_array()) {
		$nnombre = stripcslashes($row["nombre_archivo"]);
		$rruta = stripcslashes($row["ruta"]);
		$iid = stripcslashes($row["id_archivo"]);


		echo "<div class='row espacio'>";
			echo "<div class='col-sm-4 t_centro'>";
				echo "ID del archivo $iid";
			echo "</div>";
			echo"<div class='col-sm-4 t_centro'>";
				echo "<a href=\"".$directorio . $rruta."\" target='blanck' class='a_cursos' title='Abrir Archivo'>".$nnombre."<br></a>";
			echo "</div>";
			echo "<div class='col-sm-4 t_centro'>";
				echo "<a href='../models/eliminar_archivo.php?eliminar=".$row['id_archivo']."' class='btn btn-sm btn-outline-danger' onclick='eliminar()' title='Eliminar Archivo'><i class='fas fa-trash-alt'></i></a>";
			echo "</div>";
		echo "</div>";
	}
		echo "<br>";
?>	
		<div class="row centro">
			<a href="../views/home.php" class="links">Volver</a>
		</div>
		<script type="text/javascript">
			function eliminar(e){
				alert("Se eliminara el archivo seleccionado.");
				return false;
				e.preventDefault();
			}
		</script>
	<br>
	</div>	

