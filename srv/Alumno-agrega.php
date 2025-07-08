<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ALUMNO.php";

ejecutaServicio(function () {

    $nombre = recuperaTexto("nombre");
    $curso = recuperaTexto("curso");
    $calificacion = recuperaTexto("calificacion");
    $matricula = recuperaTexto("matricula");

    $nombre = validaNombre($nombre);

    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: ALUMNO, values: [
        ALU_NOMBRE => $nombre,
        ALU_CURSO => $curso,
        ALU_CALIFICACION => $calificacion,
        ALU_MATRICULA => $matricula
    ]);
    $id = $pdo->lastInsertId();

    $encodeId = urlencode($id);
    devuelveCreated("/srv/alumno.php?id=$encodeId", [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "curso" => ["value" => $curso],
        "calificacion" => ["value" => $calificacion],
        "matricula" => ["value" => $matricula],
    ]);
});
