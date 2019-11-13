<?php

function images() {

	$directory = 'images/thumbnails/';
	if(!is_dir($directory)) {
		echo 'Directory path is incorrect';
		return;
	}

	$images = glob($directory . "*.{jpg,jpeg,png}", GLOB_BRACE);

	if (count($images)) {
		foreach ($images as $image) {
			echo '<li><img src="' . $image . '" alt=""/></li>' . "\n";
		}
	} else {
		echo '<p>no images available</p>';
	}
}
?>

<section class="container">
 <div class="row">
   <ul class="gallery-images">
			<?php images();	?>
  </ul>
 </div>
</section>
