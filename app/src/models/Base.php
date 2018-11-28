<?php

require 'vendor/autoload.php';

use Medoo\Medoo;

class Base {
  public $db;

  public function __construct() {
    $this->db = new Medoo([
      'database_type' => 'mysql',
      'database_name' => 'travely',
      'server' => 'localhost',
      'username' => 'root',
      'password' => ''
    ]);
  }
}
