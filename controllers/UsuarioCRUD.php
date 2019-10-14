<?php
include __DIR__ . '/../models/Usuario.php';

class UsuarioCRUD
{
  private $objUser;

  public function __construct()
  {
    $this->objUser = new Usuario();
  }

  function getUsuarios()
  {
    $usuarios = array();
    $consulta = $this->objUser->getData();

    if ($consulta->num_rows > 0) {
      foreach ($consulta as $fila) {
        $usuarios['users'][] = $fila;
      }
      echo json_encode($usuarios);
    } else {
      echo 'No hay registros disponibles, verifica';
    }
    return $usuarios;
  }

  function getUsuarioPorNombre()
  {
    if (isset($_GET['nombre'])) {
      $usuario = array();
      $name = $_GET['nombre'];
      $consulta = $this->objUser->getDataName($name);

      if ($consulta->num_rows > 0) {
        foreach ($consulta as $fila) {
          $usuario['users'][] = $fila;
        }
        echo json_encode($usuario);
      } else {
        echo 'No existe registro';
      }
    } else {
      echo 'Error al encontrar registro';
    }
  }

  function insertarUsuario()
  {
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["pais"])) {

      $campos = array(
        "nombre" => $this->objUser->setNombre($_POST["nombre"]),
        "apellido" => $this->objUser->setApellido($_POST["apellido"]),
        "pais" => $this->objUser->setPais($_POST["pais"])
      );

      foreach ($campos as $fila) {
        if (!($fila["nombre"] == null || $fila["apellido"] == null || $fila["pais"] == null)) {
          echo 'Hay campos vacios, revisa por favor';
          return;
        }
      }

      $comprobarRegistro = $this->objUser->validarRegistro();

      if ($comprobarRegistro->num_rows > 0) {
        echo 'El nombre ya existe, compruebe con otro';
        return;
      }

      $query = $this->objUser->postUser();
      echo 'Ingreso de registro exitoso';
      return $query;
    } else {
      echo 'Error al registrar el usuario';
    }
  }

  function actualizarRegistro()
  {
    if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["pais"])) {
      $this->objUser->setNombre($_POST["nombre"]);
      $this->objUser->setApellido($_POST["apellido"]);
      $this->objUser->setPais($_POST["pais"]);

      $campos = array(
        "nombre" => $this->objUser->setNombre($_REQUEST["nombre"]),
        "apellido" => $this->objUser->setApellido($_REQUEST["apellido"]),
        "pais" => $this->objUser->setPais($_REQUEST["pais"])
      );

      foreach ($campos as $fila) {
        if (!($fila["nombre"] == null || $fila["apellido"] == null || $fila["pais"] == null)) {
          echo 'Hay campos vacios, revisa por favor';
          return;
        }
      }

      $comprobarRegistro = $this->objUser->validarRegistro();

      if ($comprobarRegistro->num_rows > 0) {
        $query = $this->objUser->putUser();
        echo 'Actualizado correctamente';
        return $query;
      } else {
        echo 'Registro no encontrado';
      }
    } else {
      echo 'Error al actualizar el usuario';
    }
  }

  function eliminarUsuario()
  {
    if (isset($_GET['nombre'])) {
      $this->objUser->setNombre($_GET['nombre']);

      $comprobarRegistro = $this->objUser->validarRegistro();

      if ($comprobarRegistro->num_rows > 0) {
        $query = $this->objUser->deleteUser();
        echo 'Eliminado correctamente';
        return $query;
      } else {
        echo 'Registro no encontrado';
      }
    } else {
      echo 'Error';
    }
  }
}
