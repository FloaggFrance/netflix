<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $text ?> - LifeForDream.com</title>
	<link href="./main.css" rel="stylesheet">
	<?php if(isset($cssAdd)) { echo $cssAdd; } ?>
</head>
<body>
	<?php if(isset($adminUser->ID)) { ?>
	<header class="use-admin">
		<nav class="use-nav">
			<div class="right">
				<ul>
					<li><a class="ubuntu" href="user.php?id=<?= $adminUser->ID ?>">My Profil</a></li>
					<li><a class="ubuntu" href="quit.php?t=log-out">Log Out</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<?php } ?>