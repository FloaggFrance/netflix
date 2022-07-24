<?php
require "init.php";

// header('Content-type: application/json');
$item = "";
if(isset($_GET['item'])) {
	$item = htmlentities($_GET['item']);
}

function imgBan(string $ban, string $type) {
	if($video = explode(',', $ban)) {
		if(isset($video[1])) {
			if($type  =='banner')
				return $video[1];

			else
				return $video[0];
		}
	}
	return $ban;
}
function imgEx($img, $ex) {
	$video = explode('.', $img);
	$e = count($video);
	$exrait = $img;
	if(@file_get_contents($video[0].'.'.$video[1].'.'.$video[2]."_{$ex}.".$video[3]) == true)
		$exrait = $video[0].'.'.$video[1].'.'.$video[2]."_{$ex}.".$video[3];

	return $exrait;
}

switch($item) {
	case 'news':
		$reqVideo = new sql_prep(
			'query',
			'SELECT * FROM video WHERE ID = 24 ORDER BY ID DESC'
		);
		$reqVideo = $reqVideo->return_data;

		if($reqVideo->num_rows > 0) {
			$get = $reqVideo->fetch_assoc();

			extract($get);
			$video = explode('.', $video_file);
			$exrait = null;
			if(@file_get_contents(explodeFile($video[0].'_EXTRAIT.mp4')) == true)
				$exrait = explodeFile($video[0].'_EXTRAIT.mp4');

			$data = [
				'text_new'=> $video_desc,
				'text_title'=> null,
				'text_button'=>'Regarder',
				'link_redirection'=> $uniq_ID,
				'logo' => null,
				'banner_img' => null,
				'banner_video'=> $exrait
			];
			if($video_type == "video") { // video => SERIE
				$reqSaison = new sql_prep(
					'prepare',
					'SELECT * FROM saison WHERE ID = ?',
					'i',
					[$club_id]
				);
				$reqSaison = $reqSaison->return_data;
				if($reqSaison->num_rows > 0) {
					$getSaison = $reqSaison->fetch_assoc();

					$club_id = $getSaison['club_id'];
				}
			}

			$reqClub = new sql_prep(
				'prepare',
				'SELECT * FROM club WHERE ID = ?',
				'i',
				[$club_id]
			);
			$reqClub = $reqClub->return_data;
			if($reqClub->num_rows == 1) {
				$getClub = $reqClub->fetch_assoc();
				/* if(isset($getSaison)) {
					$data['text_new'] .= ' - ';
				} */
				$data['text_title'] .= $getClub['club_name'];

				$data['banner_img'] = imgBan($getClub['banner'], 'banner');
				$data['logo'] = imgEx($getClub['jacket'], 'HD');

				$_JSON+=$data;
			}
		}
		break;

	case 'useTrend':
		$ListClub = new sql_prep(
			'query',
			"SELECT * FROM club ORDER BY ID DESC"
		);

		$data = [
			'ListClub' => null,
			'ListVideo' => null,
		];

		if($ListClub->return_data->num_rows > 0) {
			// $get_ListClub = $ListClub->return_data->fetch_assoc();

			$data['ListClub'] = $ListClub->return_data->fetch_all(MYSQLI_ASSOC);
			foreach ($data['ListClub'] as $key => $value) {
				//echo 'ok';
				$data['ListClub'][$key]['banner']=imgBan($value['banner'], 'list');
			}
			//var_dump($data);
			//die();
		}

		$ListVideo = new sql_prep(
			'query',
			"SELECT * FROM video ORDER BY ID DESC LIMIT 5"
		);

		if($ListVideo->return_data->num_rows > 0) {
			// $get_ListVideo = $ListVideo->return_data->fetch_assoc();

			$data['ListVideo'] = $ListVideo->return_data->fetch_all(MYSQLI_ASSOC);

			// var_dump($data['ListVideo']);

			foreach ($data['ListVideo'] as $key => $value) {
				// var_dump($value['club_id']);
				if($value['video_type'] == "film") {
					$film = new sql_prep(
						'prepare',
						"SELECT * FROM club WHERE ID = ?",
						"i",
						[$value['club_id']]
					);
					// var_dump($film);
					if($film->return_data->num_rows > 0) {
						//echo "dddd";
						$ddddd = $film->return_data->fetch_assoc();
						// var_dump($ddddd);
						// echo "<br><br>";
						$data['ListVideo'][$key]['banner'] = imgBan($ddddd['banner'], 'list');
						$data['ListVideo'][$key]['club_name'] = $ddddd['club_name'];
						//echo $ddddd['banner'];
						//echo "\n";
					}
				} else if($value['video_type'] == "video") {
					$Saison = new sql_prep(
						'prepare',
						"SELECT * FROM saison WHERE ID = ?",
						"i",
						[$value['club_id']]
					);
					if($Saison->return_data->num_rows == 1) {
						$getSaison = $Saison->return_data->fetch_assoc();
						// var_dump($getSaison);
						$aaaa = new sql_prep(
							'prepare',
							"SELECT * FROM club WHERE club_type = 'serie' AND ID = ?",
							"i",
							[$getSaison['club_id']]
						);
						if($aaaa->return_data->num_rows == 1) {
							$ddddd = $aaaa->return_data->fetch_assoc();
							// var_dump($ddddd);
							$data['ListVideo'][$key]['banner'] = imgBan($ddddd['banner'], 'list');
							$data['ListVideo'][$key]['club_name'] = $ddddd['club_name'];
						}

					}
				}
			}
		}
		$_JSON += $data;
		break;

	case 'player-video':
		if(isset($_GET['video_id'])) {
			$video_id = htmlentities($_GET['video_id']);

			$reqVideo = new sql_prep(
				'prepare',
				'SELECT * FROM video WHERE uniq_ID = ?',
				's',
				[$video_id]
			);
			$reqVideo = $reqVideo->return_data;
			if($reqVideo->num_rows == 1) {
				$getVideo = $reqVideo->fetch_assoc();

				// explodeFile($getVideo['video_file']);

				$data = [
					'ID' => $getVideo['uniq_ID'],
					'file_video' => null,
					'video_desc'=>$getVideo['video_desc'],
					'full_name' => null,
					'saison'=> null,
					'saison_name'=> null,
					'episode'=> null,
					'episode_name'=> $getVideo['video_name'],
					'video_name' => null,
					'poster'=>null,
					'security'=>null
				];

				$club_id = $getVideo['club_id'];


				if($getVideo['video_type'] == "video") { // video => SERIE
					$reqSaison = new sql_prep(
						'prepare',
						'SELECT * FROM saison WHERE ID = ?',
						'i',
						[$club_id]
					);
					$reqSaison = $reqSaison->return_data;
					if($reqSaison->num_rows > 0) {
						$getSaison = $reqSaison->fetch_assoc();

						$club_id = $getSaison['club_id'];

						$data['saison_name'] = $getSaison['name'];
						$data['full_name'] = $data['saison_name'];
					}
				}

				$reqClub = new sql_prep(
					'prepare',
					'SELECT * FROM club WHERE ID = ?',
					'i',
					[$club_id]
				);
				$reqClub = $reqClub->return_data;
				if($reqClub->num_rows == 1) {
					$getClub = $reqClub->fetch_assoc();
					if(isset($getSaison)) {
						$data['full_name'] .= ' - ';
					}
					$data['video_name'] = $getClub['club_name'];
					$data['full_name'] .= $data['episode_name'];

					$data['poster'] = imgEx($getClub['banner'], 'list');

					$reqSecurity = new sql_prep(
						'prepare',
						'SELECT * FROM security_player WHERE club_id = ?',
						'i',
						[$club_id]
					);
					$reqSecurity = $reqSecurity->return_data;
					if($reqSecurity->num_rows == 1) {
						$getSecurity = $reqSecurity->fetch_assoc();
						$data['security'] = [
							'banner'=>$getSecurity['banner'],
							'name'=>$getSecurity['name_studio'],
							'url'=>$getSecurity['url_original']
						];
					}

					$data['file_video'] = explodeVideo($getClub['ID'], $getVideo['video_file'], $getClub['club_type'], $getClub['club_name']);
				}


				$_JSON += $data;
			}
		}
		break;

	case 'view-club':
		if(isset($_GET['club_id'])) {
			$club_id = htmlentities($_GET['club_id']);

			$club = new sql_prep(
				'prepare',
				'SELECT * FROM club WHERE ID = ?',
				'i',
				[$club_id]
			);
			$reqClub = $club->return_data;

			if($reqClub->num_rows == 1) {
				$getClub = $reqClub->fetch_assoc();

				$data = [
					'title_club' => $getClub['club_name'],
					'banner' => imgBan($getClub['banner'], 'banner'),
					'jacket' => $getClub['jacket'],
					'data' => null,
					'extrait'=> null
				];

				if($getClub['club_type'] == 'serie') {
					$saison = new sql_prep(
						'prepare',
						'SELECT * FROM saison WHERE club_id = ?',
						'i',
						[$getClub['ID']]
					);
					$reqSaison = $saison->return_data;
					if($reqSaison->num_rows > 0) {
						$getSaison = $reqSaison->fetch_assoc();

						$listVideo = new sql_prep(
							'prepare',
							'SELECT * FROM video WHERE club_id = ? AND video_type = "video"',
							'i',
							[$getSaison['ID']]
						);

						$reqListVideo=$listVideo->return_data;
						if($reqListVideo->num_rows > 0) {
							$data['data'] = $reqListVideo->fetch_all(MYSQLI_ASSOC);

							$video = explode('.', $data['data'][0]['video_file']);
							$exrait = null;
							if(@file_get_contents(explodeFile($video[0].'_EXTRAIT.mp4')) == true)
								$exrait = explodeFile($video[0].'_EXTRAIT.mp4');

							$data['extrait'] = $exrait;
						}

					}
				} else if($getClub['club_type'] == 'film') {
					$listVideo = new sql_prep(
						'prepare',
						'SELECT * FROM video WHERE club_id = ? AND video_type = "film"',
						'i',
						[$getClub['ID']]
					);

					$reqListVideo=$listVideo->return_data;
					if($reqListVideo->num_rows > 0) {
						$data['data'] = $reqListVideo->fetch_all(MYSQLI_ASSOC);
					}
				}
				//var_dump($data['data']);
				$_JSON += $data;
				$_JSON['data'] = $data['data'];
			}
		}
		break;

	case 'list':
		if(isset($_GET['type'])) {
			$ListClub = new sql_prep(
				'prepare',
				"SELECT * FROM club WHERE club_type = ? ORDER BY ID DESC",
				"s",
				[$_GET['type']]
			);
		}
		else {
			$ListClub = new sql_prep(
				'query',
				"SELECT * FROM club ORDER BY ID DESC"
			);
		}

		$data = [
			'nam_type'=> null,
			'ListClub' => null,
			'ListVideo' => null,
		];

		if($ListClub->return_data->num_rows > 0) {
			// $get_ListClub = $ListClub->return_data->fetch_assoc();

			$data['ListClub'] = $ListClub->return_data->fetch_all(MYSQLI_ASSOC);
		}
		$_JSON += $data;
		break;

	case 'use-data':
		// if(isset($_GET['tok'])) {
			$tok = '{"62d1c6db86386":"9","62cd45d19fbfd":"12"}'; //htmlentities($_GET['tok']);

			if(!$tok = json_decode(html_entity_decode($tok), true));

			$i=0;
			$data = array();
			foreach ($tok as $key => $values) {
				$videoI = new Video($key);
				$data[] = [
					'name'=>$videoI->name,
					'sub_name'=>$videoI->sub_name,
					'banner'=>$videoI->banner,
					'logo'=>$videoI->logo
				];
				$_JSON['data'] += $data;
			}
		// }
		break;
}

echo json_encode($_JSON);

function explodeVideo(int $id, string $strsss, string $type, string $name) {
	$str = "https://cdn.qwilfiapp.com/arch/medias/";
	switch($type) {
		case 'serie':
			$str.='series/';
			break;

		case 'film':
			$str.='films/';
			break;
	}
	$str .= "{$id}_-_".slugify($name)."/";
	$str.=$strsss;

	return $str;
}

function explodeFile(string $file) {
	if($d = explode('/', $file)) {
		//var_dump($d);
		if($d[0] == "film") {
			return "https://cdn.qwilfiapp.com/".$file;
		}
		if($d[0] == "serie") {
			return "https://cdn.qwilfiapp.com/".$file;
		}
	}
	return "https://cdn.lifefordream.com/".$file;
}

function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

class Video {
	private $id;
	public $file, $poster, $logo, $banner, $name, $sub_name;
	function __construct(string $video_id) {
		$reqVideo = new sql_prep(
			'prepare',
			'SELECT * FROM video WHERE uniq_ID = ?',
			's',
			[$video_id]
		);
		$reqVideo = $reqVideo->return_data;
		if($reqVideo->num_rows == 1) {
			$getVideo = $reqVideo->fetch_assoc();

			$this->id = $getVideo['club_id'];

			if($getVideo['video_type'] == "serie");

			$club = new Club($this->id);
			$this->logo = $club->logo;
			$this->banner = $club->banner;
			$this->name = $club->name;
			$this->sub_name = $getVideo['video_name'];
		}
	}
}

class Club {
	private $id;
	public $logo, $poster, $name;
	function __construct(string $video_id) {
		$reqVideo = new sql_prep(
			'prepare',
			'SELECT * FROM club WHERE ID = ?',
			's',
			[$video_id]
		);
		$reqVideo = $reqVideo->return_data;
		if($reqVideo->num_rows == 1) {
			$getVideo = $reqVideo->fetch_assoc();

			$this->banner = imgBan($getVideo['banner'], 'title');
			$this->logo = $getVideo['jacket'];
			$this->name = $getVideo['club_name'];
		}
	}
}