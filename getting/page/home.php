<?php
extract($GLOBALS);
?>
<header class="fullscreen-page" style="background-image: url(<?= $informationBanner->banner_img ?>);">
	<!-- <span class="shadow-left"></span> -->
	<span class="shadow-bottom"></span>
	<section class="information-and-controls">
		<div class="information-video-contenaire">
			<div class="title-video">
				<span class="title">
					<img src="<?= $informationBanner->logo ?>" width="100%">
					<h1><?= $informationBanner->text_title ?></h1>
				</span>
			</div>
			<div class="information-video">
				<span class="time-video">2h 35m</span>
				<span class="time-video">Action, Adventure, Drama</span>
			</div>
			<div class="video-desc">
				<span class="content-texte">
					<p><?= $informationBanner->text_new ?></p>
				</span>
			</div>
			<div class="buttons">
				<a href="" class="playing-button ubutton">Play Now</a>
			</div>
		</div>
	</section>
</header>
<?php if($cookHist) { ?>
<?php
$i=0;
foreach ($data as $key => $values) {
	$i++;

	if(rand(1, count($data)-1) == $i) {
		$value = $key;
		$ti = $values;
	}
}

$video = new Open_API('get.php?item=player-video&video_id='.$value);
$getVideo=$video->use;
?>
section à faire charger par le client et mettre un chargement d'attente si il y as des data de detecter*
<section class="next-time">
	<div class="playing-contenaire row">
		<span class="player-img __IMG" style="background-image:url(<?= $getVideo->poster ?>);"></span>
	</div>
	<div class="information-playing row">
		<div class="information-video">
			<span class="litle">
				<span><?= $getVideo->full_name ?></span>
			</span>
			<span class="title">
				<h1><?= $getVideo->video_name ?></h1>
			</span>
			<div class="desc">
				<p><?= $getVideo->video_desc ?></p>
			</div>
			<div class="cont-prog">
				<span>00:00</span>
				<span class="progress">
					<span class="progress-color" style="width: <?= 100 * $ti / 100 ?>%;"></span>
				</span>
				<span>00:00</span>
			</div>
		</div>
	</div>
</section>
<?php } ?>
utiliser "localStorage.setItem('monChat', 'Tom');" pour stocker des data et à eviter coter server
<section class="list-suggestion-film">
	<!-- start ection -->
	<div class="head">
		<span class="title">
			<h1>Vidéos </h1>
		</span>
		<div class="right-option">
			<div id="num_scroll"></div>
		</div>
	</div>
	<div class="use-moove-bar-list">
		<span class="button-moove-scroll left"></span>
		<div class="contenaire-to-scroll">
			<div class="scroll-ctn">
				<!-- While start -->
				<?php
				$o = 0;
				foreach ($ListHome->use->ListClub as $key => $value) {
					$o++;
					if($o == 10) {
						break;
					}
				?>
				<!-- element start -->
				<article class="">
					<a href="?s=<?= $value->ID ?>">
						<div class="element-contenaire">
							<div class="background">
								<span class="__IMG" style="background-image: url(<?= $value->banner ?>)"></span>
							</div>
						</div>
					</a>
				</article>
				<!-- element end -->
				<?php
				}
				?>
				<!-- While end -->
			</div>
		</div>
		<span class="button-moove-scroll right"></span>
	</div>
	<!-- end ection -->
</section>
<section class="list-suggestion-film">
	<!-- start ection -->
	<div class="head">
		<span class="title">
			<h1>Vidéos </h1>
		</span>
		<div class="right-option">
			<div id="num_scroll"></div>
		</div>
	</div>
	<div class="use-moove-bar-list">
		<span class="button-moove-scroll left"></span>
		<div class="contenaire-to-scroll">
			<div class="scroll-ctn">
				<!-- While start -->
				<?php
				$o = 0;
				foreach ($ListHome->use->ListClub as $key => $value) {
					$o++;
					if($o == 10) {
						break;
					}
				?>
				<!-- element start -->
				<article class="">
					<a href="">
						<div class="element-contenaire">
							<div class="background">
								<span class="__IMG" style="background-image: url(<?= $value->banner ?>)"></span>
							</div>
						</div>
					</a>
				</article>
				<!-- element end -->
				<?php
				}
				?>
				<!-- While end -->
			</div>
		</div>
		<span class="button-moove-scroll right"></span>
	</div>
	<!-- end ection -->
</section>
<!--
	<section class="contenaire-use">
		<div class="use-list-club first">
			<span class="button-back btn-scroll"></span>
			<div class="top-list-3 contenaire-list-horizontal contenaire-use-scroll-cbtn">
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
		<section class="list-page-trending">
			<div class="use-list-club">
				<span class="button-back btn-scroll"></span>
				<div class="contenaire-list-horizontal contenaire-use-scroll-cbtn">
					<div class="ctn">
						<?php
						for($i=0;$i<count($ListHome->use->ListClub);$i++) {
							$value = $ListHome->use->ListClub[rand(1, count($ListHome->use->ListClub)-1)];
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
		</section>		<?php if($cookHist) { ?>
		<section class="list-page-trending">
			<div class="head use-margin-page">
				<h2>Continuer à regarder</h2>
			</div>
			<div class="use-list-club">
				<span class="button-back btn-scroll"></span>
				<div class="contenaire-list-horizontal contenaire-use-scroll-cbtn">
					<div class="ctn">
						<?php
						foreach ($data as $key => $value) {
							$video = new Open_API('get.php?item=player-video&video_id='.$key);
							$getVideo=$video->use;
						?>
						<div class="element-link">
							<a href="watch?w=<?= $getVideo->ID ?>">
								<div class="element-block" style="background-image: url(<?= $getVideo->poster ?>)">
									<div class="texte">
										<h2><?= $getVideo->full_name ?></h2>
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
		<?php } ?>
		<div class="use-margin-page">
			<div class="top-list-a">
				<?php
					if(count($ListHome->use->ListVideo) > 0) {
						foreach ($ListHome->use->ListVideo as $key => $value) {
						?>
						<div class="hist-element-link">
							<a href="watch?v=<?= $value->uniq_ID ?>">
								<div class="hist element-list-horz">
									<div class="left-jack">
										<span class="__IMG" style="background-image: url(<?= $value->banner ?>);"></span>
									</div>
									<div class="right">
										<div>
											<div class="title">
												<?= $value->video_name ?>
											</div>
											<div class="de">
												<p><?= $value->club_name ?></p>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
						<?php
						}
					}
				?>
			</div>
		</div>
	</section>
</main>
<script>
	let scrollWidthBTN = document.querySelector('.contenaire-use-scroll-cbtn .ctn').scrollWidth - document.querySelector('.contenaire-use-scroll-cbtn .ctn').offsetWidth
	document.querySelector('.button-next.btn-scroll').onclick = function () {
	  document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft += (document.querySelector('.contenaire-use-scroll-cbtn').offsetWidth / 4);
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
	  document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft -= (document.querySelector('.contenaire-use-scroll-cbtn').offsetWidth / 4);

	  if(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft < scrollWidthBTN) {
	  	document.querySelector('.button-next.btn-scroll').style.display = "block"
	  }

	  if(document.querySelector('.contenaire-use-scroll-cbtn').scrollLeft <= 4) {
	  	document.querySelector('.button-back.btn-scroll').style.display = "none"
	  }
	};
</script> -->