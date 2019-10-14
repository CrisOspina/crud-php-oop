<?php

class Usuario
{
  private $id, $nombre, $apellido, $pais, $conexion;

  public function __construct()
  {
    $this->conexion = Connection::startConnection();
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setApellido($apellido)
  {
    $this->apellido = $apellido;
  }

  public function getApellido()
  {
    return $this->apellido;
  }

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  public function getPais()
  {
    return $this->pais;
  }

  // Obtener todos los usuarios de la tabla
  public function getData()
  {
    $consulta = $this->conexion->query("SELECT * FROM usuario");
    return $consulta;
  }

  // Obtener el usuario por el nombre (en este ejemplo)
  public function getDataName($name)
  {
    $query = $this->conexion->query("SELECT * FROM usuario WHERE nombre ='$name'");
    return $query;
  }

  // Validar existencia de registro antes de registrar usuario
  public function validarRegistro()
  {
    $query = $this->conexion->query("SELECT nombre FROM usuario WHERE nombre = '$this->nombre'");
    return $query;
  }

  // Insertar nuevo registro a la tabla
  public function postUser()
  {
    $query = $this->conexion->query("INSERT INTO usuario (id, nombre, apellido, pais) 
      VALUES (null, '$this->nombre', '$this->apellido', '$this->pais')");

    return $query;
  }

  // Actualizar registro
  public function putUser()
  {
    $query = $this->conexion->query("UPDATE usuario SET apellido='$this->apellido', pais='$this->pais' WHERE nombre='$this->nombre'");
    return $query;
  }

  // Eliminar registro
  public function deleteUser()
  {
    $query = $this->conexion->query("DELETE FROM usuario WHERE nombre='$this->nombre'");
    return $query;
  }
}
