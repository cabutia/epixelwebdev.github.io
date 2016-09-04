<?php
//---------------------FUNCIONES---------------------

function trunc($v, $f){
  if(($p = strpos($v, '.')) !== FALSE){
    $v = floatval(substr($v, 0, $p + 1 + $f));
  }
  return $v;
}

//---------------------FUNCIONES---------------------
?>
