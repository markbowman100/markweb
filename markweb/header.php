<!DOCTYPE html>
<html>
	<head>
		<script src="/markweb/includes/js/jQuery.js"></script>
		<script src="/markweb/includes/js/bootstrap.js"></script>
		<!--<script src="/markweb/includes/js/npm.js"></script>-->
		<link href="/markweb/includes/css/markweb.css" rel="stylesheet">
		<link href="/markweb/includes/css/bootstrap.css" rel="stylesheet">
		<link href="/markweb/includes/css/bootstrap-theme.css" rel="stylesheet">
	</head>
	<body>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class = "row">
			<div class = "col-sm-6">
				<h4>Hello, <?php echo $_SESSION['username']; ?></h4>
			</div>
			<div class = "col-sm-6">
				<ul class="nav navbar-nav" style="float:right;">
					<li><a href="#">Page 1</a></li>
					<li><a href="#">Page 2</a></li>
					<li><a href="/markweb/logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>