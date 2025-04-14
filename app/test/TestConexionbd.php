<?php

require_once '../config/Database.php';

try {
  $conexion = Database::getConexion();
  echo "Conexión exitosa";
} catch (PDOException $e) {
  echo "Error al conectar: " . $e->getMessage();
}
