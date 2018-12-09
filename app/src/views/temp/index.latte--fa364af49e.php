<?php
// source: views/index.latte

use Latte\Runtime as LR;

class Templatefa364af49e extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/extra.css">
	<link rel="icon" href="../public/favicon.ico">
	<title>Pesan Tiket Kereta Murah dan Mudah Hanya di Travely</title>
</head>
<body>
	<section id="nav">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="/">Travely</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
					</ul>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="#">Promo</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Booking</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Layanan</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Akun
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
<?php
		if ($akun) {
			if ($akun) {
?>								<a class="dropdown-item" href="/akun">Akun</a>
<?php
			}
			if ($akun) {
?>								<a class="dropdown-item" href="/keluar">Keluar</a>
<?php
			}
		}
		else {
?>
								<a class="dropdown-item" href="/masuk">Masuk</a>
								<a class="dropdown-item" href="/daftar">Daftar</a>
<?php
		}
?>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</section>
	<section id="content">
		<div class="container">
			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title font-weight-bold">Cari Tiket Kereta dan Promo</h5>
							<br>
							<form method="get" action="/jadwal">
								<div class="row"> 
									<div class="col">
										<h6>Stasiun Asal</h6>
										<select class="custom-select" name="asal">
											<option selected disabled="disabled">Pilih Stasiun Asal</option>
<?php
		$iterations = 0;
		foreach ($domisili as $d) {
			?>											<option value="<?php echo LR\Filters::escapeHtmlAttr($d->id_stasiun) /* line 66 */ ?>"><?php
			echo LR\Filters::escapeHtmlText($d->nama_domisili) /* line 66 */ ?> (<?php echo LR\Filters::escapeHtmlText($d->id_stasiun) /* line 66 */ ?>)</option>
<?php
			$iterations++;
		}
?>
										</select>
									</div>
									<div class="col">
										<h6>Stasiun Tujuan</h6>
										<select class="custom-select" name="tujuan">
											<option selected disabled="disabled">Pilih Stasiun Tujuan</option>
<?php
		$iterations = 0;
		foreach ($domisili as $d) {
			?>											<option value="<?php echo LR\Filters::escapeHtmlAttr($d->id_stasiun) /* line 73 */ ?>"><?php
			echo LR\Filters::escapeHtmlText($d->nama_domisili) /* line 73 */ ?> (<?php echo LR\Filters::escapeHtmlText($d->id_stasiun) /* line 73 */ ?>)</option>
<?php
			$iterations++;
		}
?>
										</select>
									</div> 
								</div>
								<br>
								<div class="row"> 
									<div class="col">
										<h6>Tanggal Keberangkatan</h6>
										<input type="date" name="tanggal" class="form-control">
									</div>
									<div class="col">
										<h6>Jumlah Tiket</h6>
										<select name="jumlah" class="form-control">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
										</select>
									</div> 
								</div>
								<br>
								<p><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</small></p>
								<button type="submit" class="btn btn-primary btn-block">Cari Tiket</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-6">
					<img class="img-fluid" src="../public/img/home2.png" alt="">
				</div>
			</div>
		</div>
	</section>
	<script src="../public/js/jquery-3.3.1.js"></script>
	<script src="../public/js/popper.min.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
</body>
</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['d'])) trigger_error('Variable $d overwritten in foreach on line 66, 73');
		
	}

}
