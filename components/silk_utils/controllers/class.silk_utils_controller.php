<?php

class SilkUtilsController extends SilkControllerBase {
	
	function show_vars() {
		$this->mydump("Class Dirs", $GLOBALS["class_dirs"]);
	}
	
	function mydump($myname, $var) {
		echo "Name: $myname<pre>";
		var_dump($var);
		echo "</pre>";
	}
}
?>