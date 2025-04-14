<?php

require_once "../config/Database.php";

class Curso {

  private $conexion;

  public function __construct() {
    $this->conexion = Database::getConexion();
  }

  /**
   * @return array
   */
  public function getAll(): array{
    $sql = "SELECT * FROM vista_cursos_todos";
    
    $stmt = $this->conexion->prepare($sql); //1. Preparación (seguridad)
    $stmt->execute(); //2. Ejecución

    return $stmt->fetchAll(PDO::FETCH_ASSOC); //3. Retorno FETCH_ASSOC (arreglo asociativo)
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

  public function getById($id): array{
    $sql = "SELECT * FROM cursos WHERE id = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array($id)
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
