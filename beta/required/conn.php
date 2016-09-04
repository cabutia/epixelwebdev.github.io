<?php

  $DBuser   = 'root';
  $DBpass   = '';
  $DBserver = 'localhost';
  $DBname   = 'aulaonline_beta';

  $conn = mysqli_connect($DBserver, $DBuser, $DBpass, $DBname);

  if(!$conn){
    echo '<h3>No se pudo conectar a la base de datos <span>"'.$DBname.'".</span>.</h3>';
  }else{
    echo '<h3>Conexión exitosa a <span>"'.$DBname.'"</span>.</h3>';
  }

  date_default_timezone_set('America/Argentina/Buenos_Aires');
  echo '<br><b>Hoy es: </b>'.idate("d").' | '.idate("m").' | '.idate("Y");
  echo '<b> y son las</b> '.date('H:i').'.<hr>';
?>
