<?php

require_once "../models/Cursos.php";

$curso = new Curso();

//Parametros de prueba
$params = [
  "idcategoria"   => 1,
  "titulo"        => "Curso de Laravel",
  "duracion"      => "01:00:00",
  "nivel"         => "Avanzado",
  "precio"        => 200.00,
  "fechainicio"   => "2025-04-15"
];

try {
  $resultado = $curso->add($params);
  echo $resultado > 0 
    ? "Curso registrado correctamente." 
    : "No se pudo registrar el curso.";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}
