<?php

require_once "../config/Database.php";

class Curso {

  private $conexion;

  public function __construct() {
    $this->conexion = Database::getConexion();
  }

  /**
   * Registra un cyrso nuevo a mi bd cursos
   * @param array 
   * @return int Cantidad de filas afectadas
   */
  public function add($params = []): int {
    $sql = "CALL spu_cursos_registrar(?, ?, ?, ?, ?, ?)";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute([
      $params["idcategoria"],
      $params["titulo"],
      $params["duracion"],
      $params["nivel"],
      $params["precio"],
      $params["fechainicio"]
    ]);

    return $stmt->rowCount();
  }

}
