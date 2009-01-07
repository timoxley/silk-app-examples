<?php

class SeasonManagerController extends SilkControllerBase {

	function listSeasons($params) {
		$season = new Season();
		$seasons = $season->find_all(array('order' => 'name ASC'));
		$this->set("seasons", $seasons);
	}

	function createSeason($params) {

	}
}
?>