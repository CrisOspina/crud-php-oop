
<?php
require_once('./config/Database.php');

class Connection
{
  public static function startConnection()
  {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $bd = 'bdusuariosphp';

    $executeConnection = new Database($host, $user, $pass, $bd);

    // echo "Conexión realizada... $executeConnection->host_info";

    $executeConnection->query("SET NAMES 'utf8");

    // $executeConnection->close();

    return $executeConnection;
  }
}
