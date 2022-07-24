<div class="background-white"></div>
<div class="background-pink content load-page-JScroll JScroll"></div>
<div class="background-red content load-page-JScroll JScroll"></div>
<div class="background-blue content load-page-JScroll JScroll"></div>
<!-- content page -->
<main id="page-content-IDpreset" class="IDpreset">
	<div class="content-width window-height">
		<div class="content-width">
			<div class="profil-info">
				<div class="pdp-use">
					<img src="<?= $data[0]->pdp ?>" width="200">
				</div>
				<div class="use-title-profil">
					<h1><?= $data[0]->name ?>.</h1>
				</div>
			</div>
			<div class="content">
				<p><?= $data[0]->content ?></p>
			</div>
		</div>
	</div>
	<div class="content-width content-profil liste-img">
		<div class="loist">
			<?php
			foreach ($data[0]->imgs as $key => $value) {
			?>
			<div class="element-list img-ele">
				<img src="./img/posts/<?= $value->use_link ?>" width="300">
			</div>
			<?php
			}
			?>
		</div>
	</div>
</main>