<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BETA | Aula online</title>
  </head>
  <style>
    *{font-family:sans-serif}
    h3{color:#3d3d3d;font-weight:normal}
    span{color:black}
    label{float:left;width:20%;text-align:right;margin-right:10px}
    input[type="submit"]{padding:0 20px}
    .hred{color:red}
  </style>
  <body>
    <script>
      function a(){
        var str = document.getElementById('DNI').innerHTML;
        var r = str.replace(/alumno/g, "<b>alumno</b>");
        document.getElementById('DNI').innerHTML = r;

      }

    </script>

    <?php include('required/conn.php') ?>

    <form action="asAlumno.php" method="get">
      <label for="dni" id="DNI">Entrar como alumno [DNI] </label>
      <input onchange="a()" type="text" name="dni" value="" placeholder="(Usuario: DNI)">
      <input type="submit" value="Enviar">
    </form>

    <form action="asPadre.php" method="get">
      <label for="dni">Entrar como padre [DNI] </label>
      <input type="text" name="dni" value="" placeholder="(Usuario: DNI)">
      <input type="submit" value="Enviar">
    </form>

    <form action="asProf.php" method="get">
      <label for="dni">Entrar como profesor [DNI] </label>
      <input type="text" name="dni" value="" placeholder="(Usuario: DNI)">
      <input type="submit" value="Enviar">
    </form>

    <form action="asPreceptor.php" method="get">
      <label for="dni">Entrar como preceptor [DNI] </label>
      <input type="text" name="dni" value="" placeholder="(Usuario: DNI)">
      <input type="submit" value="Enviar">
    </form>
    <button type="button" onclick="a()">ASD</button>
  </body>
</html>
