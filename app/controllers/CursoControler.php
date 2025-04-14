<?php

if (isset($_SERVER['REQUEST_METHOD'])) {

  require_once "../models/Cursos.php";
  $curso = new Curso();

  switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
      $input = file_get_contents('php://input');
      $dataJSON = json_decode($input, true);


      $registro = [
        'idcategoria'   => $dataJSON['idcategoria'],
        'titulo'        => $dataJSON['titulo'],
        'duracion'      => $dataJSON['duracion'],  //formato HH:MM:SS
        'nivel'         => $dataJSON['nivel'],
        'precio'        => $dataJSON['precio'],
        'fechainicio'   => $dataJSON['fechainicio']
      ];

      $filasAfectadas = $curso->add($registro);

      header('Content-Type: application/json; charset=utf-8');
      echo json_encode(["filas" => $filasAfectadas]);

      break;

  }
}
