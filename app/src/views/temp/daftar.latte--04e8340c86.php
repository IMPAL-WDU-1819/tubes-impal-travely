<?php
// source: views/daftar.latte

use Latte\Runtime as LR;

class Template04e8340c86 extends Latte\Runtime\Template
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
	<title>Pesan Tiket Kereta Murah dan Mudah Hanya di Travely</title></head>
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
								<a class="dropdown-item" href="/masuk">Masuk</a>
								<a class="dropdown-item" href="/daftar">Daftar</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</section>
	<section id="content">
		<div class="row">
			<div class="container">
				<div class="col-md-4 offset-md-4">
					<h5 class="text-center"><strong>Daftar Sekarang</strong></h5>
					<br>
					<form method="post" action="/daftar">
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Email Anda" required="required">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password Anda" required="required">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Daftar</button>
						<br>
<?php
		if ($error) {
			?>						<small><?php echo LR\Filters::escapeHtmlText($error) /* line 63 */ ?></small>
<?php
		}
?>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script src="../public/js/jquery-3.3.1.slim.min.js"></script>
	<script src="../public/js/popper.min.js"></script>
	<script src="../public/js/bootstrap.min.js"></script>
</body>
</html>
<?php
		return get_defined_vars();
	}

}
