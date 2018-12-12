<?php

require 'vendor/autoload.php';
require 'models/Akun.php';
require 'models/Jadwal.php';
require 'models/Kursi.php';
require 'models/Stasiun.php';
require 'models/Transaksi.php';
require 'models/Tiket.php';

$klein = new \Klein\Klein();

$latte = new Latte\Engine;
$latte->setTempDirectory('views/temp');

$klein->onHttpError(function ($code, $router) {
  switch ($code) {
  case 404:
    $router->response()->body('Halaman tidak ditemukan');
    break;
  case 500:
    $router->response()->body('Terjadi kesalahan: '. $code);
    break;
  }
});

$klein->respond('GET', '/', function ($request, $response, $service) {
  $parameters['akun'] = '';

  session_start();

  if (isset($_SESSION['email'])) {
    $parameters['akun'] = $_SESSION['email'];
  }
  
  $stasiun = new Stasiun();
  $dataDomisili = $stasiun->getDomisili();

  $parameters['domisili'] = json_decode($dataDomisili);

  global $latte;
  $latte->render('views/index.latte', $parameters);
});

$klein->respond('GET', '/masuk', function ($request, $response, $service) {
  session_start();
  if (isset($_SESSION['email'])) {
    $response->redirect('/akun')->send();
  }

  global $latte;
  $latte->render('views/masuk.latte');
});

$klein->respond('POST', '/masuk', function ($request, $response, $service) {
  $email = $request->param('email');
  $password = $request->param('password');

  $akun = new Akun();
  $dataAkun = $akun->getAkun($email, $password);

  if (!empty(json_decode($dataAkun))) {
    session_start();
    $_SESSION['email'] = $email;

    $response->redirect('/akun')->send();
  }

  $response->redirect('/masuk')->send();
});

$klein->respond('GET', '/daftar', function ($request, $response, $service) {
  session_start();
  if(isset($_SESSION['email'])) {
    $response->redirect('/')->send();
  }

  global $latte;
  $latte->render('views/daftar.latte');
});

$klein->respond('POST', '/daftar', function ($request, $response, $service) {
  $email = $request->param('email');
  $password = $request->param('password');

  $akun = new Akun();
  $cekEmail = $akun->cekAkun($email);

  if (empty(json_decode($cekEmail))) {
    $akun->buatAkun($email, $password);
    session_start();
    $_SESSION['email'] = $email;

    $response->redirect('/')->send();
  } else {
    $parameters['error'] = 'Email sudah digunakan';
    global $latte;
    $latte->render('views/daftar.latte', $parameters);
  }
});

$klein->respond('GET', '/akun', function ($request, $response, $service) {
  session_start();
  if (isset($_SESSION['email'])) {
    $parameters['akun'] = $_SESSION['email'];
  } else {
    $response->redirect('/masuk')->send();
  }

  $akun = new Akun();
  $dataAkun = $akun->getDetail($_SESSION['email']);

  $transaksi = new Transaksi();
  $dataTransaksi = $transaksi->getTransaksiAkun($_SESSION['email']);

  $parameters['detail'] = json_decode($dataAkun);
  $parameters['transaksi'] = json_decode($dataTransaksi);

  global $latte;
  $latte->render('views/akun.latte', $parameters);
});

$klein->respond('GET', '/keluar', function ($request, $response, $service) {
  session_start();
  if (isset($_SESSION['email'])) {
    $response->redirect('/')->send();
  }
  session_destroy();
  $service->redirect('/')->send();
});

$klein->respond('GET', '/jadwal', function ($request, $response, $service) {
  $parameters['akun'] = '';

  session_start();
  if (isset($_SESSION['email'])) {
    $parameters['akun'] = $_SESSION['email'];
  }

  $asal = $request->param('asal');
  $tujuan = $request->param('tujuan');
  $tanggal = $request->param('tanggal');
  $jumlah = $request->param('jumlah');

  $jadwal = new Jadwal();
  $dataJadwal = $jadwal->cariJadwal($asal, $tujuan, $tanggal, $jumlah);

  $stasiun = new Stasiun();
  $dataDomisili = $stasiun->getDomisili();

  $parameters['jumlah'] = $jumlah;
  $parameters['jadwal'] = json_decode($dataJadwal);
  $parameters['domisili'] = json_decode($dataDomisili);

  global $latte;
  $latte->render('views/jadwal.latte', $parameters);
});

$klein->with('/transaksi', function () use ($klein) {
  $klein->respond('GET', '/form/[:id]', function ($request, $response, $service) {
    $parameters['akun'] = '';

    session_start();
    if (isset($_SESSION['email'])) {
      $parameters['akun'] = $_SESSION['email'];
    }

    $id = $request->param('id');
    $jumlah = $request->param('jumlah');

    $kursi = new Kursi();
    $dataKursi = $kursi->getKursiKosong($id);

    $jadwal = new Jadwal();
    $dataJadwal = $jadwal->getJadwal($id);

    $parameters['id'] = $id;
    $parameters['jumlah'] = $jumlah;
    $parameters['kursi'] = json_decode($dataKursi);
    $parameters['jadwal'] = json_decode($dataJadwal);

    global $latte;
    $latte->render('views/transaksi/form.latte', $parameters);
  });

  $klein->respond('GET', '/bayar/[:id]', function ($request, $response, $service) {
    $parameters['akun'] = '';
    
    session_start();
    if (isset($_SESSION['email'])) {
      $parameters['akun'] = $_SESSION['email'];
    }

    $id = $request->param('id');
    $jumlah = $request->param('jumlah');

    $jadwal = new Jadwal();
    $dataJadwal = $jadwal->getJadwal($id);

    $parameters['id'] = $id;
    $parameters['jumlah'] = $jumlah;
    $parameters['jadwal'] = json_decode($dataJadwal);

    global $latte;
    $latte->render('views/transaksi/bayar.latte', $parameters);
  });

  $klein->respond('POST', '/bayar', function ($request, $response, $service) {
    $id = $request->param('transaksi');
    $total = $request->param('total');
    $tipe = $request->param('tipe');
    $tanggal = date('Y-m-d');
    $akun = $request->param('akun');
    $bank = $request->param('bank');

    if ($tipe == 'Transfer') {
      $status = 'Pending';
    } else {
      $status = 'Lunas';
    }

    $transaksi = new Transaksi();
    $transaksi->bayarTiket($id, $total, $tipe, $tanggal, $akun, $status, $bank);
  });

  $klein->respond('POST', '/tiket', function ($request, $response, $service) {
    $id = $request->param('id');
    $transaksi = $request->param('transaksi');
    $kursi = $request->param('kursi');
    $identitas = $request->param('identitas');
    $nama = $request->param('nama');
    $jadwal = $request->param('jadwal');
    
    $tiket = new Tiket();
    $tiket->addTiket($id, $kursi, $transaksi, $identitas, $nama, $jadwal);
  });

  $klein->respond('POST', '/upload', function ($request, $response, $service) {
    $transaksi = $request->param('id');
    $sourcePath = $_FILES['bukti']['tmp_name'];
    $targetPath = "uploads/" . $transaksi . "." . pathinfo($_FILES['bukti']['name'], 
                  PATHINFO_EXTENSION);
    move_uploaded_file($sourcePath, $targetPath);
  });

  $klein->respond('GET', '/tiket', function ($request, $response, $service) {
    $parameters['akun'] = '';
    
    session_start();
    if (isset($_SESSION['email'])) {
      $parameters['akun'] = $_SESSION['email'];
    }

    global $latte;
    $latte->render('views/transaksi/tiket.latte', $parameters);
  });

  $klein->respond('GET', '/cetak/[:id]', function ($request, $response, $service) {
    $id = $request->param('id');

    $transaksi = new Transaksi();
    $dataTransaksi = $transaksi->getTransaksi($id);

    $parameters['transaksi'] = json_decode($dataTransaksi);

    if ($parameters['transaksi'][0]->status == "Lunas") {
      $tiket = new Tiket();
      $dataTiket = $tiket->getETiket($id);

      $parameters['tiket'] = json_decode($dataTiket);

      $jadwal = new Jadwal();
      $dataJadwal = $jadwal->getJadwal($parameters['tiket'][0]->jadwal);

      $parameters['jadwal'] = json_decode($dataJadwal);

      global $latte;
      $latte->render('views/transaksi/cetak.latte', $parameters);
    } else {
      $response->redirect('/akun')->send(); 
    }
  });

  $klein->respond('POST', '/refund', function ($request, $response, $service) {
    $id = $request->param('id');

    $transaksi = new Transaksi();
    $transaksi->prosesRefund($id);

    $response->redirect('/akun')->send();
  });
});

$klein->with('/admin', function () use ($klein) {
  $klein->respond('GET', '/masuk', function ($request, $response, $service) {
    session_start();
    if (isset($_SESSION['admin'])) {
      $response->redirect('/admin/konfirmasi')->send();
    }

    global $latte;
    $latte->render('views/admin/masuk.latte');
  });

  $klein->respond('POST', '/masuk', function ($request, $response, $service) {
    $username = $request->param('username');
    $password = $request->param('password');

    if ($username == 'admin' && $password =='admin') {
      session_start();
      $_SESSION['admin'] = 'admin';
      $response->redirect('/admin/konfirmasi')->send();
    }

    $response->redirect('/admin/masuk')->send();
  });

  $klein->respond('GET', '/keluar', function ($request, $response, $service) {
    session_start();
    session_destroy();
    $response->redirect('/admin/masuk')->send();
  });

  $klein->respond('GET', '/refund', function ($request, $response, $service) {
    session_start();
    if (!isset($_SESSION['admin'])) {
      $response->redirect('/admin/masuk')->send();
    }

    $transaksi = new Transaksi();
    $dataTransaksi = $transaksi->getTransaksiRefund();

    $parameters['transaksi'] = json_decode($dataTransaksi);

    global $latte;
    $latte->render('views/admin/refund.latte', $parameters);
  });

  $klein->respond('POST', '/refund', function ($request, $response, $service) {
    $id = $request->param('id');

    $transaksi = new Transaksi();
    $transaksi->refundTransaksi($id);

    $response->redirect('/admin/refund')->send();
  });

  $klein->respond('GET', '/konfirmasi', function ($request, $response, $service) {
    session_start();
    if (!isset($_SESSION['admin'])) {
      $response->redirect('/admin/masuk')->send();
    }

    $transaksi = new Transaksi();
    $dataTransaksi = $transaksi->getTransaksiPending();

    $parameters['transaksi'] = json_decode($dataTransaksi);

    global $latte;
    $latte->render('views/admin/konfirmasi.latte', $parameters);
  });

  $klein->respond('GET', '/konfirmasi/[:id]', function ($request, $response, $service) {
    $id = $request->param('id');

    $transaksi = new Transaksi();
    $dataTransaksi = $transaksi->getTransaksi($id);

    $parameters['id'] = $id;
    $parameters['transaksi'] = json_decode($dataTransaksi);

    global $latte;
    $latte->render('views/admin/transaksi.latte', $parameters);
  });

  $klein->respond('POST', '/konfirmasi', function ($request, $response, $service) {
    $id = $request->param('id');

    $transaksi = new Transaksi();
    $transaksi->konfirmasiTransaksi($id);

    $response->redirect('/admin/konfirmasi')->send();
  });
});

$klein->dispatch();