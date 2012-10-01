<?php

/****************************************

	Authored By: Virendra Rajput
	Twitter : @bkvirendra
	Github : @bkvirendra

	Blog: http://virendra.me

	Authored on 1st Oct, 2012

	Its all yours under Creative Commons License

****************************************/


// for fetching the murali
class murali {

	public function get_data($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	public function GetMurali($lang) {
		$query = "select * from html where url='http://bkwsu.org/thoughtText?lang=$lang'";
		$url = "http://query.yahooapis.com/v1/public/yql?q=";
		$url .= rawurlencode($query);
		$url .= "&format=json&env=store://datatables.org/alltableswithkeys";
		$info = $this->get_data($url);
		$data = json_decode($info, true);
		$thought = $data["query"]["results"]["body"]["p"];
		return $thought;
	}

	public function enMurali() {
		$thought = $this->GetMurali('en');
		$find = "text";
		$pos = stripos($thought, $find);
		$pos = $pos + 7;
		$text = substr($thought, $pos);
		$newT = substr($text, 0, -23);
		$murali = str_replace('\r\n'," \n ", $newT);
		$getmurali = $murali; 
		return $getmurali;
	}

	public function hiMurali() {
		$thought = $this->GetMurali('hi');
		$find = "text";
		$pos = stripos($thought, $find);
		$pos = $pos + 7;
		$text = substr($thought, $pos);
		$newT = substr($text, 0, -23);
		$murali = str_replace('\r\n'," \n ", $newT);
		$muraliW = str_replace('\'',"  ", $murali);
		$strmurali = stripslashes($muraliW);
		$getm = $strmurali; 
		return $getm;
	}

	public function GetVideo() {
		$url = "http://gdata.youtube.com/feeds/api/users/brahmakumariz/uploads?max-results=1&orderby=published&alt=jsonc&v=2";
		$results = $this->get_data($url);
		$data = json_decode($results);
		foreach($data->data->items as $item) {
			$video['title'] = $item->title;
			$video['link'] = $item->player->default;
		}
		return $video;
		
	}
}
?>