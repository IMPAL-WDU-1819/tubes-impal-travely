<?php

require 'vendor/autoload.php';
require_once 'Base.php';

class Stasiun extends Base {
  public $idStasiun;
  public $namaStasiun;
  public $domisili;  

  public function getDomisili() {
    $data = $this->db->select('stasiun', [
        '[><]domisili' => ['domisili' => 'id_domisili']
      ],
      [
        'stasiun.id_stasiun',
        'domisili.nama_domisili'
      ]
    );

    return json_encode($data);
  }
}
