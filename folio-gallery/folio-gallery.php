<?php
// error_reporting (E_ALL ^ E_NOTICE);
// photo gallery settings
$mainFolder = 'folio-gallery/albums';
$albumsPerPage = '12';
$itemsPerPage = '12';
$thumb_width = '150';
//$thumb_height  = '85';
$extensions = array(".jpg", ".png", ".gif", ".JPG", ".PNG", ".GIF");


// create thumbnails from images
function make_thumb($folder, $src, $dest, $thumb_width)
{

	$source_image = imagecreatefromjpeg($folder . '/' . $src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);

	$thumb_height = floor($height * ($thumb_width / $width));

	$virtual_image = imagecreatetruecolor($thumb_width, $thumb_height);

	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);

	imagejpeg($virtual_image, $dest, 100);

}

// display pagination
function print_pagination($numPages, $urlVars, $currentPage)
{

	if ($numPages > 1) {

		echo 'Pagina ' . $currentPage . ' van de ' . $numPages;
		echo '&nbsp;&nbsp;&nbsp;';

		if ($currentPage > 1) {
			$prevPage = $currentPage - 1;
			echo '<a href="?' . $urlVars . 'p=' . $prevPage . '">&laquo;&laquo;</a> ';
		}

		for ($e = 0; $e < $numPages; $e++) {
			$p = $e + 1;

			if ($p == $currentPage) {
				$class = 'current-paginate';
			} else {
				$class = 'paginate';
			}


			echo '<a class="' . $class . '" href="?' . $urlVars . 'p=' . $p . '">' . $p . '</a>';

		}

		if ($currentPage != $numPages) {
			$nextPage = $currentPage + 1;
			echo ' <a href="?' . $urlVars . 'p=' . $nextPage . '">&raquo;&raquo;</a>';
		}

	}

}


if (!isset($_GET['album'])) {

	// display list of albums
	$folders = scandir($mainFolder, 0);
	$ignore = array('.', '..', 'thumbs');

	$albums = array();
	$captions = array();
	$random_pics = array();

	foreach ($folders as $album) {

		if (!in_array($album, $ignore)) {

			array_push($albums, $album);

			$caption = substr($album, 0, 20);
			array_push($captions, $caption);

			$rand_dirs = glob($mainFolder . '/' . $album . '/thumbs/*.*', GLOB_NOSORT);
			$rand_pic = $rand_dirs[array_rand($rand_dirs)];
			array_push($random_pics, $rand_pic);

		}

	}

	if (count($albums) == 0) {

		echo 'Op dit moment zijn er geen fotoalbums om weer te geven.';

	} else {

		$numPages = ceil(count($albums) / $albumsPerPage);

		if (isset($_GET['p'])) {

			$currentPage = $_GET['p'];
			if ($currentPage > $numPages) {
				$currentPage = $numPages;
			}

		} else {
			$currentPage = 1;
		}

		$start = ($currentPage * $albumsPerPage) - $albumsPerPage;

		echo '<div class="titlebar">
                 <div class="float-left"><span class="title">Photo Gallery</span> - Albums</div>
			     <div class="float-right">' . count($albums) . ' albums</div>
              </div>';

		echo '<div class="clear"></div>';

		for ($i = $start; $i < $start + $albumsPerPage; $i++) {

			if (isset($albums[$i])) {

				echo '<div class="thumb-album shadow">
				        
						<div class="thumb-wrapper">
						   <a href="' . $_SERVER['PHP_SELF'] . '?album=' . urlencode($albums[$i]) . '">
			                 <img src="' . $random_pics[$i] . '" width="' . $thumb_width . '" alt="" />
						   </a>	
					    </div>
						
						<div class="p5"></div>
					    
						<a href="' . $_SERVER['PHP_SELF'] . '?album=' . urlencode($albums[$i]) . '">
						<span class="caption">' . $captions[$i] . '</span>
						</a>
		            
					  </div>';

			}

		}

		echo '<div class="clear"></div>';

		echo '<div style="align= center" class="paginate-wrapper">';

		$urlVars = "";
		print_pagination($numPages, $urlVars, $currentPage);

		echo '</div>';

	}


} else {

	// display photos in album
	$src_folder = $mainFolder . '/' . $_GET['album'];
	$src_files = scandir($src_folder);

	$files = array();
	foreach ($src_files as $file) {

		$ext = strrchr($file, '.');
		if (in_array($ext, $extensions)) {

			array_push($files, $file);


			if (!is_dir($src_folder . '/thumbs')) {
				mkdir($src_folder . '/thumbs');
				chmod($src_folder . '/thumbs', 0777);
				//chown($src_folder.'/thumbs', 'apache');
			}

			$thumb = $src_folder . '/thumbs/' . $file;
			if (!file_exists($thumb)) {
				make_thumb($src_folder, $file, $thumb, $thumb_width);

			}

		}

	}


	if (count($files) == 0) {

		echo 'In dit album zitten geen foto\'s';

	} else {

		$numPages = ceil(count($files) / $itemsPerPage);

		if (isset($_GET['p'])) {

			$currentPage = $_GET['p'];
			if ($currentPage > $numPages) {
				$currentPage = $numPages;
			}

		} else {
			$currentPage = 1;
		}

		$start = ($currentPage * $itemsPerPage) - $itemsPerPage;

		echo '<div class="titlebar">
           <div class="float-left"><span class="title">' . $_GET['album'] . '</span> - <a href="' . $_SERVER['PHP_SELF'] . '">Bekijk alle albums</a></div>
           <div class="float-right">' . count($files) . ' images</div>
         </div>';
		echo '<div class="clear"></div>';


		for ($i = $start; $i < $start + $itemsPerPage; $i++) {

			if (isset($files[$i]) && is_file($src_folder . '/' . $files[$i])) {

				echo '<div class="thumb shadow">
	                <div class="thumb-wrapper">
					<a href="' . $src_folder . '/' . $files[$i] . '" class="albumpix" rel="albumpix">
				      <img src="' . $src_folder . '/thumbs/' . $files[$i] . '" width="' . $thumb_width . '" alt="" />
				    </a>
					</div>  
			      </div>';

			} else {

				if (isset($files[$i])) {
					echo $files[$i];
				}

			}

		}


		echo '<div class="clear"></div>';

		echo '<div class="paginate-wrapper text-align-center">';

		$urlVars = "album=" . urlencode($_GET['album']) . "&amp;";
		print_pagination($numPages, $urlVars, $currentPage);

		echo '</div>';


	}

}