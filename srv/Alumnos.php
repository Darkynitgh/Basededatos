<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ALUMNO.php";

ejecutaServicio(function () {

  $lista = select(pdo: Bd::pdo(), from: ALUMNO, orderBy: 'ALU_NOMBRE, ALU_CURSO, ALU_MATRICULA, ALU_CALIFICACION');

  $render = "";
  foreach ($lista as $modelo) {
    $encodeId = urlencode($modelo[ALU_ID]);
    $id = htmlentities($encodeId);
    $nombre = htmlentities($modelo[ALU_NOMBRE]);
    $curso = htmlentities($modelo[ALU_CURSO]);
    $matricula = htmlentities($modelo[ALU_MATRICULA]);
    $calificacion = htmlentities($modelo[ALU_CALIFICACION]);

    $render .=
      "<li class='md-two-line'>
     <span class='headline'><a href='modifica.html?id=$id'>$nombre</a></span>
     <span class='supporting'>Curso: $curso - Matricula: $matricula- Calificacion: $calificacion</span>
   </li>";
  }

  devuelveJson(["lista" => ["innerHTML" => $render]]);
});
