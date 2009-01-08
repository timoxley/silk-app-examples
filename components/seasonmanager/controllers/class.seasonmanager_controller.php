<?php

class SeasonManagerController extends SilkControllerBase {

	function listSeasons($params) {
//		$season = new Season();
//		$seasons = $season->find_all(array('order' => 'name ASC'));
//		$this->set("seasons", $seasons);
//		echo $seasons[1]->stages;
//		
		$seasons = orm('season')->find_all(array("order" => "name ASC"));
		$this->set("seasons", $seasons);
//		echo $seasons[1]->stages;
		
	}

	function createSeason($params) {

	}
}
?>