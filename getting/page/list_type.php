<?php extract($GLOBALS) ?>
<main id="windows-app" class="list-page">
	<section class="list-page-trending">
			<div class="use-list-club">
				<span class="button-back btn-scroll"></span>
				<div class="contenaire-list-horizontal contenaire-use-scroll-cbtn">
					<div class="ctn">
						<?php
						foreach ($ListHome->use->ListClub as $key => $value) {
						?>
						<div class="element-link">
							<a href="?s=<?= $value->ID ?>">
								<div class="element-block" style="background-image: url(<?= $value->banner ?>)">
									<div class="texte">
										<h2><?= $value->club_name ?></h2>
									</div>
								</div>
							</a>
						</div>
						<?php
						}
						?>
					</div>
				</div>
				<span class="button-next btn-scroll"></span>
			</div>
		</section>
</main>
<script>
	 let scrollWidthBTN = document.querySelector('.contenaire-use-scroll-cbtn .ctn').scrollWidth - document.querySelector('.contenaire-use-scroll-cbtn .ctn').offsetWidth
	document.querySelector('.button-next.btn-scroll').onclick = function () {
	  document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft += 200;
	  console.log(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft)

	  if(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft >= scrollWidthBTN) {
	  	document.querySelector('.button-next.btn-scroll').style.display = "none"
	  }

	  if(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft <= 4) {
	  	document.querySelector('.button-back.btn-scroll').style.display = "none"
	  }

	  if(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft >= 4) {
	  	document.querySelector('.button-back.btn-scroll').style.display = "block"
	  }
	};


	document.querySelector('.button-back.btn-scroll').onclick = function () {
	  document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft -= 200;

	  if(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft < scrollWidthBTN) {
	  	document.querySelector('.button-next.btn-scroll').style.display = "block"
	  }

	  if(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft <= 4) {
	  	document.querySelector('.button-back.btn-scroll').style.display = "none"
	  }
	};
</script>