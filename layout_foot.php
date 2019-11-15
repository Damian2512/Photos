</div>
<!-- /container -->

<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $home_url . "folio-gallery/js/jquery-1.9.1.min.js" ?>"></script>

<script type="text/javascript" src="<?php echo $home_url . "folio-gallery/colorbox/jquery.colorbox-min.js" ?>"></script>
<!--<script type="text/javascript" src="folio-gallery/fancybox/jquery.fancybox-1.3.1.min.js"></script>-->
<script type="text/javascript">
	$(document).ready(function() {

		// colorbox settings
		$(".albumpix").colorbox({rel:'albumpix'});

		// fancy box settings
		/*
		$("a.albumpix").fancybox({
			'autoScale	'		: true,
			'hideOnOverlayClick': true,
			'hideOnContentClick': true
		});
		*/
	});
</script>
<!-- end HTML page -->
</body>
</html>