<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= SITE_NAME; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
	<link rel="icon" type="image/png" href="/public/img/favicon.png">
	<link rel="stylesheet" href="/public/css/style.css">
</head>
<body <?= !Utility::isActive('/') ? "class=\"fadeIn\"" : ""; ?>>
	<header id="header"<?= Utility::isActive('/') ? "class=\"fadeIn\"" : " class=\"secondary\""; ?>>
		<?php require_once "nav.php"; ?>
		
		<?php if(Utility::isActive('/')): ?>
		<div id="welcome" class="fadeInRight">
			<h3>Welcome!</h3>

			<p>Twice a year, individuals attending the weekly social gatherings at Hillcrest Lodge in Mount Vernon, WA plan a getaway to Harrison Hot Springs for two nights of dinner and dancing.</p>

			<p>This website enables the event coordinator to prepare a participant list, seating chart, and table decorations for the festivities.</p>

			<img src="/public/img/swirl.png" alt="swirls">
		</div>
		<?php endif; ?>
	</header>