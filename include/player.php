<script>let watchThis = 0</script>
<?php if($getVideo->security != null) { ?>
<section class="popup-security-entrance" id="popup-player-security">
	<div class="top">
		<span style="background-image: url(<?= $getVideo->security->banner ?>);" class="banner __IMG"></span>
	</div>
	<div class="contenaire">
		<p>
			Découvrez la serie original sur <?= $getVideo->security->name ?>, en HD, et toute la serie en entier.
		</p>
	</div>
	<div class="bottom-button">
		<ul>
			<li><a href="<?= $getVideo->security->url ?>" class="press-button">Watch Original</a></li>
			<li><a id="button-watch-this-timestamp" class="press-button blue not-active">Watch This</a></li>
		</ul>
	</div>
</section>
<script type="text/javascript">
	watchThis = 15;
	var timerId = setInterval(()=>{
		document.getElementById('button-watch-this-timestamp').textContent = watchThis
		watchThis--;
		if(watchThis === 0) {
			clearInterval(timerId);
			document.getElementById('button-watch-this-timestamp').classList.remove('not-active')
			document.getElementById('button-watch-this-timestamp').textContent = "Watch This"
		}
	}, 1000)

	document.getElementById('button-watch-this-timestamp').addEventListener('click', ()=>{
		if(document.getElementById('button-watch-this-timestamp').getElementsByClassName('not-active').length > 0) {
			watchThis = 5
		}else if(document.getElementById('button-watch-this-timestamp').getElementsByClassName('not-active').length == 0) {
			document.getElementById('popup-player-security').style.display = "none"
			playORpause()
		}
	})
</script>
<?php } ?>
<section class="player-video">
	<span class="loading-buble" id="loader"></span>
	<video poster='<?= $getVideo->poster ?>' src="<?= $getVideo->file_video ?>" id="videoElement"></video>
	<section class="contenaire-screen">
		<div class="top">
			<div class="button-list">
				<span  onclick="window.location.href = '/'" class="button btn-back">
					<a href="/" class="btn-ico"></a>
				</span>
			</div>
		</div>
		<div class="center">
			<div class="left">
				<div>
					<div class="player-play-pause-control">
						<span class="btn-player-control" id="player-controle-action">
							<a href="/" class="btn-ico"></a>
						</span>
						<div class="timestamp">
							<span class="left-time" id="time-ecoule">00:00</span>
							<span>/</span>
							<span class="right-time" id="time-duration">00:00</span>
						</div>
					</div>
					<section class="control-volume-item">
						<div class="volume-control ubtton">
							<div class="button">
								<span class="icone"></span>
							</div>
							<div class="control">
								<div class="volume"><span class="volumeBar"></span></div>
							</div>
						</div>
					</section>
				</div>
			</div>
			<div class="right">
				
			</div>
		</div>
		<div class="bottom-contenaire">
			<div class="top">
				<div class="title-video">
					<b><?= $getVideo->video_name ?></b>
					<?= $getVideo->full_name ?>
				</div>
				<div class="buttonscreen">
					<a id="fullscreen"></a>
				</div>
			</div>
			<div class="progress">
				<div class="progress-video" id="progress-contenaire">
					<div class="loading-color" id="buffered-amount"></div>
					<div class="progress-color" id="progress-amount">
						<div class="progress-head"></div>
					</div>
				</div>
			</div>
			<div class="bottom"></div>
		</div>
	</section>
</section>
<script src="include/player.min.js"></script>