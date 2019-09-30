<?php  
  session_start();
  if ($_SESSION["usuario"] != "1") {
    header("Location: ../../index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="../../vendor/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../css/estilos.css">
		<link rel="stylesheet" href="../../css/simple-sidebar.css">
		<link rel="shortcut icon" href="../../files/img/ITMS2.ico">
		<title>Home ITMS Capacitacion</title>
	</head>

	<body>

    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">

        <div class="">
            <a href="home.php">
              <img src="../../files/img/Logo ITMS.png" class="logo">
            </a>
        </div>

        <div class="list-group list-group-flush b_right">

          <ul class="navbar-nav list-group-item-action">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                <div class="barra"></div>
                <span>Mi Perfil</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="subir_curso.php">Subir curso</a>
                <a class="dropdown-item" href="mis_cursos.php">Mis cursos</a>
                <a class="dropdown-item" href="mis_cursos.php">Actualizar perfil</a>
                <hr>
                <a class="dropdown-item" href="../models/cerrar_sesion.php">Cerrar sesión</a>
                <a href="#"></a>
              </div>
            </li>
          </ul>

          <a href="#" class="list-group-item list-group-item-action enlaces">
            <div class="barra"></div>
            <span>Audios</span>
          </a>

          <a href="#" class="list-group-item list-group-item-action enlaces">
            <div class="barra"></div>
            <span>Videos</span>
          </a>

          <a href="#" class="list-group-item list-group-item-action enlaces">
            <div class="barra"></div>
            <span>Multimedia</span> 
          </a>

          <a href="#" class="list-group-item list-group-item-action enlaces">
            <div class="barra"></div>
            <span>Documentos</span> 
          </a>

          <div class="row centro color3 b_bottom2" style="width: 106%; padding-top: 14%; padding-bottom: 5%">
              <a href="../views/home.php"><img src="../../files/img/ITMS2.png" class="logohome"></a>
          </div>

          <div class="t_centro color3 b_bottom" style="font-size: 11px; padding-top: 5%; padding-bottom: 5%">
            ITMS Capacitación (1) 593-1770<br>
            &copy; Todos los derechos reservados <br>
            2019
          </div>

        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navegacion b_bottom fixed-top">
        <button class="btn boton_menu" id="menu-toggle">
          <i class="fas fa-bars"></i>
        </button>

          <ul class="navbar-nav sesion">
            <li class="nav-item">
              <?php 
                echo "Bienvenido(a) ".$_SESSION["nombres"]." ".$_SESSION["apellidos"];
              ?>
            </li>
          </ul>
      </nav>
      
      <?php  

        class Datos{
          public function mostrar($doc_perfil){

            include("conexion.php");

            $doc_perfil = $_SESSION['documento'];
            $cont = "0";

            $sql = "SELECT * FROM usuarios WHERE documento = '$doc_perfil'";

            if (!$result = $db -> query($sql)) {
              die('Hay un error en la consulta [' .$db->error. ']');
            }

            while($row = $result -> fetch_assoc()){
              $ttipo_documento = stripcslashes($row['tipo_documento']);
              $ddocumento = stripcslashes($row['documento']);
              $nnombres = stripcslashes($row['nombres']);
              $aapellidos = stripcslashes($row['apellidos']);
              $ccorreo = stripcslashes($row['correo']);
              $cont = $cont + 1;
            }

            if ($cont == "0") {
              include("../views/alerts/alerta_d_perfil.html");
            }

            if ($cont != "0") {
?>
            <br>
            <div class="container div color2">

              <form action="#" method="POST">
                <div class="row b_bottom">
                  <div class="col-sm-3 color1">
                    <img src="../../files/img/Logo ITMS.png" class="logo2">
                  </div>
                  <div class="col-sm-9 encabezado2">
                    ACTUALIZAR INFORMACION DEL USUARIO
                  </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-2 t_centro">Tipo de documento</div>
                    <div class="col-sm-2 t_centro">Documento</div>
                    <div class="col-sm-2 t_centro">Nombres</div>
                    <div class="col-sm-2 t_centro">Apellidos</div>
                    <div class="col-sm-4 t_centro">Correo</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-2 t_centro">
                      <?php         
                        echo "<select class='' name='tipo_documento'>";

                        $sql2 = "SELECT * FROM tipo_documento";

                          if(!$result2 = $db ->query($sql2)){
                            die ('Hay un error en la consulta [' .$db->error .']');
                          }

                          while($row2 = $result2->fetch_assoc()){
                            $iid_tipo_documento = stripcslashes($row2["id_tipo_documento"]);
                            $tttipo_documento = stripcslashes($row2["tipo_documento"]);

                            if($iid_tipo_documento==$ttipo_documento){
                              echo"<option value=$iid_tipo_documento SELECTED>$tttipo_documento</option>";
                            } 
                            // else{
                            //     echo"<option value=$iid_tipo_documento>$tttipo_documento</option>"; 
                            //   }
                          }
                          echo "</select>";
                      ?>
                    </div>
                    <div class="col-sm-2 t_centro">
                      <?php echo $ddocumento ?>
                    </div>
                    <div class="col-sm-2 t_centro">
                      <input type="text" id="nombres" name="nombres" value="<?php echo $nnombres ?>">
                    </div>
                    <div class="col-sm-2 t_centro">
                      <input type="text" id="apellidos" name="apellidos" value="<?php echo $aapellidos ?>">
                    </div>
                    <div class="col-sm-4 t_centro">
                      <input type="text" id="correo" name="correo" style="width: 250px" value="<?php echo $ccorreo ?>">
                    </div>
                  </div>
                    <br>
                    <div class="row centro ">
                      <input type="submit" class="btn btn-sm btn-outline-dark" value="Actualizar">
                    </div>
                    <br>
                    <div class="row centro">
                      <a href="../views/home.php" class="links">Volver</a>
                    </div>
                    <br>
              </form>
            </div>
<?php
      }
    }
  }
        $nuevo = new Datos();
        $nuevo->mostrar($_POST["doc_perfil"]);
?>

    		<script src="../../vendor/js/bootstrap.bundle.min.js"></script>
    		<script src="../../vendor/jquery/jquery.js"></script>
      	<script src="https:kit.fontawesome.com/2c36e9b7b1.js"></script>


		 <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
      </script>
	</body>
</html>