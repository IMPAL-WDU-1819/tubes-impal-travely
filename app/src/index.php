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
	$cekEmail = $akun->getAkun($email, $password);

	global $latte;
		if (!is_null($cekEmail)) {
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

	if (is_null($cekEmail)) {
		$akunBaru = $akun->buatAkun($email, $password);
		
		session_start();
		$_SESSION['masuk'] = true;
		$_SESSION['email'] = $email;
		
		$response->redirect('/')->send();
	}

	$service->back();
});

$klein->respond('GET', '/jadwal/[:asal]/[:tujuan]/[:tanggal]', function ($request, $response, $service) {
	$service->validateParam('asal')->notNull();
	$service->validateParam('tujuan')->notNull();
	$service->validateParam('tanggal')->notNull();
	$service->validateParam('jumlah')->notNull();

	$asal = $request->paramsGet('asal');
	$tujuan = $request->paramsGet('tujuan');
	$tanggal = $request->paramsGet('tanggal');
	$jumlah = $request->paramsGet('jumlah');

	global $latte;
	$latte->render('views/jadwal.latte');
});

$klein->with('/transaksi', function () use ($klein) {
	$klein->respond('GET', '/form/[:id]', function ($request, $response, $service) {
		// Handle response
	});

	$klein->respond('GET', '/bayar/[:id]', function ($request, $response, $service) {
		// Handle response
	});

	$klein->respond('GET', '/tiket/[:id]', function ($request, $response, $service) {
		// Handle response
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
