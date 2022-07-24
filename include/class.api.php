<?php
class Open_API {
	private $file;
	public $use, $reponse, $message;

	public function __construct(string $str) {
		if($this->file = file_get_contents(API.$str)) {
			if($this->use = json_decode($this->file)) {
				$this->reponse = $this->use->x_JSON_REPONSE;
				$this->message = $this->use->x_JSON_MESSAGE;
				unset($this->use->x_JSON_REPONSE);
				unset($this->use->x_JSON_MESSAGE);
			}
			//echo $this->file;
			// die();
		}
	}
}