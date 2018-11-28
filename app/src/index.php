<?php

require 'vendor/autoload.php';
require 'models/Akun.php';
require 'models/Jadwal.php';
require 'models/Transaksi.php';
require 'models/Stasiun.php';

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
  $stasiun = new Stasiun();
  $domisili = $stasiun->getDomisili();

  global $latte;
  $parameters['domisili'] = json_decode($domisili);
  $latte->render('views/index.latte', $parameters);
});

$klein->respond('GET', '/masuk', function ($request, $response, $service) {
  global $latte;
  $latte->render('views/masuk.latte');
});

$klein->respond('POST', '/masuk', function ($request, $response, $service) {
  $service->validateParam('email')->notNull();
  $service->validateParam('password')->notNull();

  $email = $request->paramsPost('email');
  $password = $request->paramsPost('password');

  $akun = new Akun();
  $dataAkun = $akun->getAkun($email, $password);

  global $latte;
  if (!empty($dataAkun)) {
    session_start();
    $_SESSION['masuk'] = true;
    $_SESSION['email'] = $email;

    $response->redirect('/')->send();
  }

  $service->back();
});

$klein->respond('GET', '/daftar', function ($request, $response, $service) {
  global $latte;
  $latte->render('views/daftar.latte');
});

$klein->respond('POST', '/daftar', function ($request, $response, $service) {
  $service->validateParam('email')->notNull();
  $service->validateParam('password')->notNull();

  $email = $request->paramsPost('email');
  $password = $request->paramsPost('password');

  $akun = new Akun();
  $cekEmail = $akun->cekAkun($email);

  global $latte;

  if (empty($cekEmail)) {
    $akunBaru = $akun->buatAkun($email, $password);

    session_start();
    $_SESSION['masuk'] = true;
    $_SESSION['email'] = $email;

    $response->redirect('/')->send();
  }

  $service->back();
});

$klein->respond('GET', '/keluar', function ($request, $response, $service) {
  session_start();
  session_destroy();
  $service->redirect('/')->send();
});

$klein->respond('GET', '/jadwal/[:asal]/[:tujuan]/[:tanggal]/[:jumlah]', function ($request, $response, $service) {
  $service->validateParam('asal')->notNull();
  $service->validateParam('tujuan')->notNull();
  $service->validateParam('tanggal')->notNull();
  $service->validateParam('jumlah')->notNull();

  $asal = $request->paramsGet('asal');
  $tujuan = $request->paramsGet('tujuan');
  $tanggal = $request->paramsGet('tanggal');
  $jumlah = $request->paramsGet('jumlah');

  $jadwal = new Jadwal();
  $dataJadwal = $jadwal->cariJadwal($asal, $tujuan, $tanggal);

  $parameters['jadwal'] = json_decode($dataJadwal);

  global $latte;
  $latte->render('views/jadwal.latte', $parameters);
});

$klein->with('/transaksi', function () use ($klein) {
  $klein->respond('GET', '/form/[:id]', function ($request, $response, $service) {
    $transaksi = new Transaksi();

    global $latte;
    $latte->render('views/transaksi/form.latte');
  });

  $klein->respond('GET', '/bayar/[:id]', function ($request, $response, $service) {
    $transaksi = new Transaksi();

    global $latte;
    $latte->render('views/transaksi/bayar.latte');
  });

  $klein->respond('POST', '/bayar', function ($request, $response, $service) {
    $service->validateParam('id')->notNull();
    $service->validateParam('total')->notNull();
    $service->validateParam('tipe')->notNull();
    $service->validateParam('tanggal')->notNull();
    $service->validateParma('akun')->notNull();

    $id = $request->paramsGet('id');
    $total = $request->paramsGet('total');
    $tipe = $request->paramsGet('tipe');
    $tanggal = $request->paramsGet('tanggal');
    $akun = $request->paramsGet('akun');

    $transaksi = new Transaksi();
    $dataPembayaran = $transaksi->bayarTiket();

    $service->redirect('/tiket/[:'. $id. ']')->send();
  });

  $klein->respond('GET', '/tiket/[:id]', function ($request, $response, $service) {
    $transaksi = new Transaksi();
    $dataTiket = $transaksi->getTiket($id);

    $parameters['tiket'] = json_decode($dataTiket);

    global $latte;
    $latte->render('views/transaksi/tiket.latte', $parameters);
  });
});

$klein->with('/admin', function () use ($klein) {
  $klein->respond('GET', '/refund', function ($request, $response, $service) {
    global $latte;
    $latte->render('views/admin/refund.latte');
  });

  $klein->respond('POST', '/refund/[:id]', function ($request, $response, $service) {
    // Handle response
  });

  $klein->respond('GET', '/konfirmasi', function ($request, $response, $service) {
    global $latte;
    $latte->render('views/admin/konfirmasi.latte');
  });

  $klein->respond('POST', '/konfirmasi[:id]', function ($request, $response, $service) {
    // Handle response
  });
});

$klein->dispatch();
