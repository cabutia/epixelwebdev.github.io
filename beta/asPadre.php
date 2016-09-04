<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BETA | Padres</title>
    <style>
      *{font-family:sans-serif}
      body{background:#eee}
      h3{color:#3d3d3d;font-weight:normal}
      span{color:black}
      table{background:white;width:80%;margin:.5%;float:left;border:2px solid black;border-collapse:collapse}
      tr{border-bottom:1px solid lightgrey}
      td{border-right:1px solid grey}
      .half{width:50%;}
      .low{border-bottom:1px solid grey}
      .right{border-right:1px solid grey}
      .top{border-top:1px solid grey}
      .blow{border-bottom:2px solid black}
      .btop{border-top:2px solid black}
      .q{width:30%;}
      .true{background-color:green;color:black}
      .false{background-color:red;color:white}
      .title{background-color:lightblue;}
      .hred{color:red};
    </style>
  </head>
  <body>
    <h3>Entrando como <span>padre</span>:</h3>
    <?php include('required/conn.php') ?>

    <?php
      $dniPadre   = $_GET['dni'];
      $queryP     = 'SELECT * FROM padres WHERE DNI='.$dniPadre;

      $arrayDatos = $conn->query($queryP);

      if($arrayDatos->num_rows != 0){
        $datosPadres = mysqli_fetch_assoc($arrayDatos);
      }
    ?>
    <table>   <!--Tabla general-->

      <table>
        <tr class="blow title">
          <th>
            <h2>TUS DATOS</h2>
          </th>
          <th></th><th></th>
        </tr>
        <tr class="top">
          <td class="half top">
            <b>DNI</b>
          </td>
          <td class="top">
            <?php echo $datosPadres['DNI']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Nombre</b>
          </td>
          <td>
            <?php echo $datosPadres['nombre']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Apellido</b>
          </td>
          <td>
            <?php echo $datosPadres['apellido'] ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Hijo/s</b>
          </td>
          <td>
            <b>
              <?php
                $arrayHijos = explode(',',$datosPadres['DNI_HIJO']);
                foreach($arrayHijos as $idHijos){
                  echo $idHijos.', ';
                }
              ?>
            </b>
          </td>
        </tr>
      </table>

      <?php
      //Para cada hijo ->
        foreach($arrayHijos as $hijoData){
      //Buscar los datos de la tabla alumnos
      if($hijoData != ''){
        $qDatos = 'SELECT * FROM alumnos WHERE DNI='.$hijoData;
        $aDatos = $conn->query($qDatos);


      ?>
      <?php
        if($aDatos->num_rows > 0){
          $hijo = mysqli_fetch_assoc($aDatos);
      ?>
        <table>
          <tr class="title blow">
            <th>
              <h2>DATOS DE <?php echo '\''.$hijo['nombre'].'\''; ?></h2>
            </th>
            <th></th><th></th>
          </tr>
          <tr>
            <td class="half top">
              <b>NOMBRE</b>
            </td>
            <td class="top">
              <?php echo $hijo['nombre']; ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>APELLIDO</b>
            </td>
            <td>
              <?php echo $hijo['apellido'] ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>CURSO</b>
            </td>
            <td>
              <?php echo $hijo['curso'].'º '.$hijo ['turno'] ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>EDAD</b>
            </td>
            <td>
              <?php echo $hijo['edad'] ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>DIRECCION</b>
            </td>
            <td>
              <?php echo $hijo['direccion'] ?>
            </td>
          </tr>
          <tr>
            <td>
              <b>TELEFONO</b>
            </td>
            <td>
              <?php echo $hijo['telefono'] ?>
            </td>
          </tr>
      <?php } //END IF DATOS ?>
          <tr class="title btop blow">
            <th>
              <b>MATERIAS DE SU CURSO</b>
            </th>
            <th></th><th></th>
          </tr>
      <?php
        $qMaterias = 'SELECT materias_curso FROM cursos WHERE idCurso='.$hijo['curso'];
        $aMaterias = $conn->query($qMaterias);
        if($aMaterias->num_rows != 0){
          $materiasEx = mysqli_fetch_assoc($aMaterias);
          $arrayMaterias = explode(',', $materiasEx['materias_curso']);

          //echo $materiasEx['materias_curso'];


          foreach($arrayMaterias as $materias){
            echo '<tr><td><b>';
            echo $materias;
            echo '</b></td></tr>';
      ?>

      <?php
        } //END FOREACH MATERIAS
        } //END IF MATERIAS
      ?>

      <tr class="title blow btop">
        <th>
          <b>INFORMACION SOBRE NOTAS</b>
        </th>
        <th></th><th></th>
      </tr>
      <tr>
        <td>
          <b>MATERIA</b>
        </td>
        <td>
          <b>NOTAS</b>
        </td>
        <td>
          <b>PROMEDIO</b>
        </td>
      </tr>

      <?php
        foreach($arrayMaterias as $materia){
          $getNotasByMateria = 'SELECT nota FROM notas WHERE materia="'.$materia.'" AND alumnoDNI="'.$hijo['DNI'].'"';
          $notas = $conn->query($getNotasByMateria);

          echo '<tr><td>';
          echo $materia.'</td><td>';
          if($notas->num_rows == 1){
            $notasRow = mysqli_fetch_assoc($notas);
            $arrayNotas = explode(',',$notasRow['nota']);

            foreach($arrayNotas as $aN){
              echo '<b>'.$aN.'</b>, ';
            }

            $promedio = array_sum($arrayNotas)/count($arrayNotas);
            echo '<td>'.number_format($promedio, 2).'</td>';

          }else{
            echo 'No hay notas de <b>'.$materia.'</b> para el alumno <b>\''.$hijo['nombre'].'\'</b>';
          }

          echo '</td></tr>';
        }
      ?>

      <?php include('required/asistencias.php'); ?>

      </table>
      <?php }} //END FOREACH ----GENERAL---- ?>
  </body>
</html>
