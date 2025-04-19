<?php

if (isset($_SERVER['REQUEST_METHOD'])) {

  require_once "../models/Cursos.php";
  $curso = new Curso();

  switch ($_SERVER['REQUEST_METHOD']) {



    case 'GET':
      //sleep(5);
      header('Content-Type: application/json; charset=utf-8');
  
      if ($_GET['task'] == 'getAll'){
        echo json_encode($curso->getAll());
        }else if ($_GET['task'] == 'getById'){
          echo json_encode($curso->getById($_GET['id']));
        }
      break;


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

    case 'DELETE':
      header('Content-Type: application/json; charset=utf-8');
      $url = $_SERVER['REQUEST_URI'];
      $arrayURL = explode('/', $url);
      $id = end($arrayURL);

      $filasAfectadas = $curso->delete(['id' => $id]);
      echo json_encode(["filas" => $filasAfectadas]);
      break;

    case 'PUT':
      $input = file_get_contents('php://input');
      $dataJSON = json_decode($input, true);
  
      if ($dataJSON && isset($dataJSON['idcurso'])) {
        $registro = [
          'idcurso'       => $dataJSON['idcurso'],
          'idcategoria'   => $dataJSON['idcategoria'],
          'titulo'        => $dataJSON['titulo'],
          'duracion'      => $dataJSON['duracion'],
          'nivel'         => $dataJSON['nivel'],
          'precio'        => $dataJSON['precio'],
          'fechainicio'   => $dataJSON['fechainicio']
          ];
  
         $filasAfectadas = $curso->update($registro);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["filas" => $filasAfectadas]);
        } else {
          http_response_code(400);
          echo json_encode(["error" => "Datos incompletos para actualizar"]);
        }
        break;
  }
}
