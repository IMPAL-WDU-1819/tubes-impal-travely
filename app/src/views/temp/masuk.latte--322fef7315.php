<?php
// source: views/masuk.latte

use Latte\Runtime as LR;

class Template322fef7315 extends Latte\Runtime\Template
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
	<title>Masuk</title>
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
					<h5 class="text-center"><strong>Selamat Datang Kembali</strong></h5>
					<br>
					<form method="post" action="/masuk">
						<div class="form-group">
							<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Anda">
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password Anda">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Masuk</button>
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
