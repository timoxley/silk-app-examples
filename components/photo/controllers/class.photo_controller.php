<?php // -*- mode:php; tab-width:4; indent-tabs-mode:t; c-basic-offset:4; -*-

/**
 * @author Greg Froese
 *
 */
add_component_dependent("stub");

class PhotoController extends SilkControllerBase {

	function test($params) {
		$stub = new Stub();
		$photo = new Photo();
		$findme = new FindMeController();
		$findme->loveme();
		$photo2 = new Photo2();
		var_dump($photo2);
	}
	/**
	 *
	 * @author Greg Froese
	 */
	function run_default($params) {

		if( $params["start"])
			$start = $params["start"];
		else
			$start = 1;

		if( $params["max"] )
			$max = $params["max"];
		else
			$max = 9;

		$dir = join_path(ROOT_DIR, $params["dir"]);
		//probably a prettier way to do this :)
		$abs_path = dirname(dirname(dirname(dirname(dirname(__FILE__)))));

//		echo "Processing ($dir)<br />";
		$opt = $this->validate_options($dir);
		$this->check_for_image_libraries;
		$this->setup_dir($dir);

		$fileTypes = array("jpg", "jpeg");
		$files = scandir("$dir");

		$count = 0;
		$count_used = 0;
		foreach($files as $file) {
			if(in_array(substr($file, strlen($file)-3), $fileTypes)) {
				$count++;

				if( $count_used >= $max ) continue;

				if( $count < $start) {
					if( $start - $count == 1 ) {
						$start = 1;
						$count = 0;
					}
					continue;
				}

				$count_used++;
				$th_file = join_path($dir, ".cache", $file);
				$file_fullname = join_path($dir, $file);

				//check for existing thumbnail
				if( file_exists($th_file )) {
					//strip off the abs_path
					// TODO: where do i find the actual path?
					$th_file = "/silk/". substr( $th_file, strlen($abs_path) );
					echo "<img src='$th_file' alt='$th_file'/>";
					if( $count % 3 == 0 ) echo "<br />";
					continue;
				}

				//got some of this code from http://www.online-resizer.com/
				//---------
				$fileInfo = getimagesize($file_fullname); // had to put this here instead of thumbnail_size
				$width = $fileInfo[0];						// just got black thumbnails otherwise
				$height = $fileInfo[1];
				//---------

				$th_size = $this->thumbnail_size($width, $height);
				if( file_exists( $file_fullname ) ) {
					$img = imagecreatefromjpeg($file_fullname);
				} else {
					die("($file_fullname does not exist!");
				}
				$img_th = imagecreatetruecolor($th_size[0], $th_size[1]);

				//copy and resize original into thumbnail
				imagecopyresampled($img_th, $img, 0, 0, 0, 0, $th_size[0], $th_size[1], $width, $height);
				//save the thumbnail to a file
				imagejpeg($img_th, $th_file);

				//strip off the abs_path
				// TODO: where do i find the actual path?
				$th_file = "/silk/". substr( $th_file, strlen($abs_path) );
				echo "<img src='$th_file' alt='$th_file'/>";
				if( $count % 3 == 0 ) echo "<br />";

			}
		}
	}

	/**
	 * Calculate the dimensions for the thumbnail
	 * @author Greg Froese
	 */
	function thumbnail_size($width, $height){
		//got some of this code from http://www.online-resizer.com/
		$th_size = array();
		if( $width > $height ) {
			$th_size[0] = $this->maxThumbWidth;
			$th_size[1] = intval(ceil( $height / $width * $th_size[0] ));
		} else {
			$th_size[1] = $this->maxThumbHeight;
			$th_size[0] = intval(ceil( $width / $height * $th_size[1] ));
		}
		return($th_size);
	}
	/**
	 * Check for imagemagick or GD libraries
	 * @author Greg Froese
	 */
	function check_for_image_libraries() {
		if (!function_exists(imagecopyresampled)) {
			die("Fatal error: GD2 library is not presented");
		}
		return;
	}
	/**
	 * Setup dir with needed files
	 * @author Greg Froese
	 */
	function setup_dir($dir) {
		if(!file_exists(join_path($dir, ".cache"))) {
			if(!mkdir(join_path($dir, ".cache")))
				die("Error creating .cache directory in ($dir)");
		}
	}

	/**
	 * Validate options are correct
	 * @author Greg Froese
	 *
	 */
	function validate_options($dir) {
//		echo "dir: ($dir)<br />ROOTDIR: (".ROOT_DIR.")<br />";
		//why doesn't this work?
		if( $dir == ROOT_DIR ) {
			die("No directory supplied");
		}

		if(!is_dir($dir)) {
			die("($dir) is not a valid directory");
		}

		if(!is_writable($dir))
			die("($dir) is not writeable");

		$this->maxThumbHeight = 200;
		$this->maxThumbWidth = 200;
	}
	/**
	 * Just here for an example
	 */
	function test_ajax($params)  {
	    $this->show_layout = false;
	    $resp = new SilkAjax();
	    $resp->replace_html("#some_content", "New content says 'Hi!'");
	    $resp->replace("#some_content", "style", "color: red;");
	    $resp->insert("#some_content", " Append me, baby!");
	    $resp->insert("#some_content", "Prepend me, too. ", "prepend");
	    $resp->insert("#some_content", "<div id='after'>After</div>", "after");
	    $resp->insert("#some_content", "Before ", "before");
	    $resp->remove("#after");
	    return $resp->get_result();
	}

	/**
	 * Show the form to get user options to start a resize operation
	 *
	 * @param unknown_type $params
	 * @author Greg Froese
	 */
	function resize($params) {
//		$this->show_layout = false;
	}

	/**
	 * Run the resize command and put results on the page
	 *
	 * @param unknown_type $params
	 * @author Greg Froese
	 */
	function resize_ajax($params) {
		$this->show_layout = false;
		$resp = new SilkAjax();
		$validate_errors = $this->validate_inputs($params);
		if($validate_errors) {
			$resp->replace_html("#some_content", "$validate_errors");
			return $resp->get_result();
		}

		// Initialize some variables
		$output = "";
		$fileTypes = array("jpg", "peg");
		$files = scandir($params["sourceDir"]);
		$count = 0;

		foreach($files as $file) {
			if(in_array(strtolower(substr($file,strlen($file)-3)), $fileTypes)) {
				$count++;
				$command = "convert -resize $params[maxWidth]x$params[maxHeight] $params[sourceDir]/$file $params[destDir]/$file";
//				$output .= "$command<br />";
			}
		}

		if($count)
			$output .= "Adding $count file to the queue<br />";
		else
			$output .= "No matching files found<br />";

		$resp->replace_html("#some_content", "$output");
		return $resp->get_result();
	}

	/**
	 * Make sure your inputs are good.
	 *
	 * @param unknown_type $params
	 */
	function validate_inputs($params) {
		if($params["sourceDir"] == $params["destDir"])
			return "Source directory cannot be the same as the destination directory<br />";

		if(!is_writeable($params["destDir"]))
			return "Destination directory [$params[destDir]] is not writable<br />";

		if(!is_readable($params["sourceDir"]))
			return "Source directory [$params[sourceDir]] is not readable<br />";

		if(!is_dir($params["sourceDir"]))
			return "Source directory [$params[sourceDir]] is not a valid directory<br />";



		return;
	}
}

?>