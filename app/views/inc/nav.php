<nav id="nav"<?= Utility::isActive('/') ? "class=\"fadeInDown\"" : ""; ?>>	
	<div class="nav-logo">
		<img src="/public/img/dancer.png" alt="dancer">
		<div class="nav-logo-text">
			<h2>biannual retreat</h2>
			<h1>Hillcrest Dancers</h1>
		</div>
	</div>

	<hr>

	<ul class="nav-links">
		<li><a href="/"<?= Utility::setActive('/') ?>>Home</a></li>
		<li><a href="/dancers"<?= Utility::setActive('/dancers') ?>>View Dancers</a></li>
		<li><a href="/dancers/assign"<?= Utility::setActive('/dancers/assign') ?>>Assign Seats</a></li>
		<li><a href="/materials"<?= Utility::setActive('/materials') ?>>Print Materials</a></li>
	</ul>
</nav>			