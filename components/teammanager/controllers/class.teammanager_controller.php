<?php

class TeamManagerController extends SilkControllerBase {
	
	function listTeams($params) {
		echo "Creating team object<br />";
		$team = new Team();
		$teams = $team->find_all();
		
		foreach( $teams as $t ) {
			echo "team: $t->name<br />";
		}
	}
}
?>