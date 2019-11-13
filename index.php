<?php include 'header.php '; ?>

<?php

function images()
{
	$directory = 'images/thumbnails/';
	if (!is_dir($directory)) {
		echo 'Directory path is incorrect';
		return;
	}
	$images = glob($directory . "*.{jpg,jpeg,png}", GLOB_BRACE);

	if (count($images)) {
		foreach ($images as $image) {
			echo '<li><img src="' . $image . '" alt=""/></li>' . "\n";
		}
	} else {
		echo '<p>0 images</p>';
	}
}

?>

<div class="main-container main-container_width">
    <div class="blog-page">
        <h1 class="page-title">PhotoAlbum</h1>
        <ul class="gallery-images">
			<?php
			images();
			?>
        </ul>

        <div class="clear"></div>

    </div> <!-- end blog page -->
</div>
<!-- end main container -->

<?php include 'footer.php'; ?>
