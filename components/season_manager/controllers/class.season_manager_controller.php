<?php

class SeasonManagerController extends SilkControllerBase {

	function listSeasons($params) {
//		$seasons = orm('season')->find_all(array("order" => "name ASC"));
		$this->set("seasons", orm('season')->find_all(array("order" => "name ASC")));
	}

	function createSeason($params) {

	}
}
?>