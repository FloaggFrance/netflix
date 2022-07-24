<?php
$club = new Open_API('get.php?item=view-club&club_id='.$_GET['s']);
$getClub = $club->use;
?>
<section class="main-popup club">
	<style>
		body { overflow: hidden; }
	</style>
	<article class="main-popup">
		<header>
			<div class="banner-contenaire __IMG" style="background-image: url(<?= $getClub->banner ?>);">
				<a href="." onclick="document.querySelector('.main-popup.club').remove()" class="button btn-back btn-ico">
				</a>
				<div class="logo-club">					
					<img src="<?= $getClub->jacket ?>" width="100%">
				</div>
				<?php if($getClub->extrait != null) { ?>
				<video src="<?= $getClub->extrait ?>" id="video-extrait"></video>
				<script>
					let videoElement = document.getElementById('video-extrait')
					videoElement.addEventListener('click',()=>{
						if(videoElement.paused) {
							videoElement.play()
						}
						else {
							videoElement.pause()
						}
					})
				</script>
				<?php } ?>
			</div>
		</header>
		<main>
			<div class="top-contenaire-info">
				<div class="right-info">
					<div class="title">
						<h1><?= $getClub->title_club ?></h1>
					</div>
					<div class="desc">
						<p>
							.................... ..... ....... ... ...... ............... ....................... ............................... ................................ .................... ...... .................................... ....... .................................................................... ............................................................................. ........ .................................................................................. ..................................................................................................................
						</p>
					</div>
				</div>
			</div>
			<div class="top-list-3 list-video-view">
				<?php
				foreach ($getClub->data as $key => $value) {
				?>
				<div class="hist-element-link">
					<a href="watch?v=<?= $value->uniq_ID ?>">
						<div class="hist element-list-horz">
							<div class="left-jack">
								<span class="__IMG" style="background-image: url(<?= $getClub->banner ?>);"></span>
							</div>
							<div class="right">
								<div>
									<div class="title">
										<?= $value->video_name ?>
									</div>
									<div class="de">
										<p><?= $getClub->title_club ?></p>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<?php
				}
				?>
			</div>
		</main>
	</article>
</section>