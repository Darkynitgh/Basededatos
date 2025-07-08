<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    "sqlite:srvbd.db",
    null,
    null,
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS ALUMNO (
      ALU_ID INTEGER PRIMARY KEY,
      ALU_NOMBRE TEXT NOT NULL,
      ALU_CURSO TEXT NOT NULL,
      ALU_CALIFICACION REAL NOT NULL,
      ALU_MATRICULA TEXT NOT NULL UNIQUE,
      CONSTRAINT ALU_NOMBRE_NV CHECK(LENGTH(ALU_NOMBRE) > 0),
      CONSTRAINT ALU_CURSO_NV CHECK(LENGTH(ALU_CURSO) > 0),
      CONSTRAINT ALU_CALIF_RNG CHECK(ALU_CALIFICACION >= 0 AND ALU_CALIFICACION <= 10),
      CONSTRAINT ALU_MATRICULA_NV CHECK(LENGTH(ALU_MATRICULA) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
