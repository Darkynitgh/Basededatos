<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ALUMNO.php";

ejecutaServicio(function () {

  $id = recuperaIdEntero("id");
  $nombre = recuperaTexto("nombre");
  $curso = recuperaTexto("curso");
  $calificacion = recuperaTexto("calificacion");
  $matricula = recuperaTexto("matricula");

  $nombre = validaNombre($nombre);

  update(
    pdo: Bd::pdo(),
    table: ALUMNO,
    set: [
      ALU_NOMBRE => $nombre,
      ALU_CURSO => $curso,
      ALU_CALIFICACION => $calificacion,
      ALU_MATRICULA => $matricula
    ],
    where: [ALU_ID => $id]
  );

  devuelveJson([
    "id" => ["value" => $id],
    "nombre" => ["value" => $nombre],
    "curso" => ["value" => $curso],
    "calificacion" => ["value" => $calificacion],
    "matricula" => ["value" => $matricula]
  ]);
});
