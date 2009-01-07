<?php

class TeamManagerController extends SilkControllerBase {

	function listTeams($params) {
		$team = new Team();
		$teams = $team->find_all();
		$this->set("teams", $teams);

//		foreach( $teams as $t ) {
//			echo "team: $t->name<br />";
//		}
	}
}
?>