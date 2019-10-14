<?php

class Database extends mysqli
{
  public function __construct($host, $user, $pass, $bd)
  {
    parent::__construct($host, $user, $pass, $bd);

    if (mysqli_connect_error()) {
      die('Error de Conexión ' . mysqli_connect_errno() . mysqli_connect_error());
    }
  }
}
