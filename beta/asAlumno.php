
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BETA | Alumnos</title>
  </head>
  <body>
    <style>
      *{font-family:sans-serif}
      h3{color:#3d3d3d;font-weight:normal}
      span{color:black}
      table{width:80%;margin:.5%;float:left;border:1px solid black;border-collapse:collapse}
      tr{border-bottom:1px solid lightgrey}
      td{border-right:1px solid black}
    </style>
    <?php include('required/conn.php') ?>

    <h3>Entrando como <span>alumno</span>:</h3>
    <?php
      $dniAlumno = $_GET['dni'];
      $getAlumnos = "SELECT * FROM alumnos WHERE DNI=".$dniAlumno;
      $resultados = $conn->query($getAlumnos);

      if($resultados->num_rows == 1){
        $r = mysqli_fetch_assoc($resultados);
      }
    ?>
    <!--  DATOS DEL ALUMNO -->
    <table>
      <table>
        <tr style="border-bottom:1px solid black">
          <td>
            <b>TUS DATOS:</b>
          </td>
        </tr>
        <tr>
          <td>
            <b>DNI</b>
          </td>
          <td style="text-align:right">
            <?php echo $r['DNI']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Nombre</b>
          </td>
          <td style="text-align:right">
            <?php echo $r['nombre']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Apellido</b>
          </td>
          <td style="text-align:right">
            <?php echo $r['apellido']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Curso</b>
          </td>
          <td style="text-align:right">
            <?php echo $r['curso'].'º '.$r['turno']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Edad</b>
          </td>
          <td style="text-align:right">
            <?php echo $r['edad']; ?>
          </td>
        </tr>
        <tr>
          <td>
            <b>Direccion</b>
          </td>
          <td style="text-align:right">
            <?php echo $r['direccion'] ?>
          </td>
        </tr>
        <tr style="border-bottom:1px solid black">
          <td>
            <b>Telefono</b>
          </td>
          <td style="text-align:right">
            <?php echo $r['telefono'] ?>
          </td>
        </tr>
      </table>
      <!--  DATOS DEL ALUMNO -->

      <!--  MATERIAS  -->
      <table style="width:32%">
        <tr style="border-bottom:1px solid black">
          <td>
            <b>Materias</b>
          </td>
        </tr>
        <?php
          $materiasDelAlumno = "SELECT materias_curso FROM cursos WHERE idCurso=".$r['curso'];
          $resultados = $conn->query($materiasDelAlumno);
          if($resultados->num_rows == 1){
            $r = mysqli_fetch_assoc($resultados);
            $str = $r['materias_curso'];
            $arrayMaterias = explode(',',$str);

            foreach($arrayMaterias as $tr){
              echo '<tr><td>'.$tr.'</td></tr>';
            }
          }
        ?>
      </table>
      <!--  MATERIAS  -->

      <!--  NOTAS  -->
      <table style="width:47%">
        <tr style="border-bottom:1px solid black">
          <td style="border-right:0px">
            INFORMACION DE NOTAS
          </td>
        </tr>
        <tr style="border-bottom:1px solid black">
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
            $getNotasByMateria = 'SELECT nota FROM notas WHERE materia="'.$materia.'" AND alumnoDNI="'.$dniAlumno.'"';
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
              echo 'No hay notas de <b>'.$materia.'</b> para el alumno <b>'.$dniAlumno.'</b>';
            }

            echo '</td></tr>';
          }
        ?>
      </table>
      <!--  NOTAS  -->
    </table>
  </body>
</html>
