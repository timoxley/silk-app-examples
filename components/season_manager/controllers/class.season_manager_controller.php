<?php

class SeasonManagerController extends SilkControllerBase {

	function listSeasons($params) {
//		$seasons = orm('season')->find_all(array("order" => "name ASC"));
//		echo "<pre>"; var_dump($seasons); echo "</pre>"; die;
		$this->set("seasons", orm('season')->find_all(array("order" => "name ASC")));
	}

	function createSeason($params) {

	}

	function createSeasonStore($params) {
		//echo "<pre>"; var_dump($params); echo "</pre>";
		$season = new Season();
		$season->name = $params["seasonName"];
		$season->start_year = $params["startYear"];
		$season->end_year = $params["endYear"];
		$season->status_id = $params["status"];
		$season->save();
	}

	function showSeasonORM($params) {
		$seasons = orm('season')->find_all(array("order" => "name ASC"));
		echo "<pre>"; var_dump($seasons); echo "</pre>";
	}
}
?>
