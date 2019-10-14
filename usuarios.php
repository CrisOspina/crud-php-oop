<?php
require_once('./config/Connection.php');
require_once('./controllers/UsuarioCRUD.php');

$crud = new UsuarioCRUD();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'GET':
    if ($_SERVER['REQUEST_URI'] == "/crud-php-poo/usuarios.php/" || $_SERVER['REQUEST_URI'] == "/crud-php-poo/usuarios.php") {
      $crud->getUsuarios();
    } else {
      $crud->getUsuarioPorNombre();
    }
    break;

  case 'POST':
    if ($_SERVER['REQUEST_URI'] == "/crud-php-poo/usuarios.php/" || $_SERVER['REQUEST_URI'] == "/crud-php-poo/usuarios.php") {
      $crud->insertarUsuario();
    } else {
      // Actualizar Usuarios
      $crud->actualizarRegistro();
    }
    break;

  case 'DELETE':
    $crud->eliminarUsuario();
    break;

  default:
    echo 'Failed request method';
    break;
}
