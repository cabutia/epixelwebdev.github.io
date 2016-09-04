<?php

  require_once('fnc.php');

  $qAsistencias = 'SELECT * FROM asistencias WHERE DNI='.$hijo['DNI'];
  $arrayInicial = $conn->query($qAsistencias);

  echo '<tr class="blow btop title"><th><b>INFORMACION SOBRE ASISTENCIAS</b></th><th></th><th></th></tr>';

  if($arrayInicial->num_rows != 0){
    $aC = mysqli_fetch_assoc($arrayInicial);
    $x = explode(',', $aC['asistencias']);

    echo '<tr class="blow">';
    echo '<td><b>FECHAS</b></td>';
    echo '<td>';
    echo '<b>ASISTENCIAS</b>';
    echo '</td>';
    echo '</tr>';

    $totalA = 0;

    foreach($x as $y){
      $a = explode('=',$y);
      echo '<tr><td>';
      echo $a[0];
      echo '</td>';
      if($a[1] == 0){
        echo '<td class="true">';
        echo '<b>PRESENTE</b>';
        echo '</td>';
        $totalA++;
      }else{
        echo '<td class="false">';
        echo '<b>AUSENTE</b>';
        echo '</td>';
      }
      echo '</tr>';
    }

    $totalC = count($x);
    $totalB = $totalC-$totalA;
    $subtotalA = ($totalA * 100) / $totalC;
    $subtotalB = ($totalB * 100) / $totalC;

    $porA = trunc($subtotalA, 1);
    $porB = 100 - $porA;
    echo '<tr class="btop"><th></th><th>';
    echo 'Total de asistencias: <b>'.$totalA. '</b><br>';
    echo 'Total de faltas: <b>'     .$totalB. '</b><br>';
    echo 'Total de clases: <b>'     .$totalC. '</b><br>';
    echo '<hr>';
    echo 'Porcentaje de asistencias: <b>'.$porA.'%</b><br>';
    echo 'Porcentaje de faltas: <b>'.$porB.'%</b><br>';
    echo '</th></tr>';
  }
?>
