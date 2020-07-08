<?php require_once('./private/initialize.php'); ?>

<?php //Define Title
	$page_title = 'Logging out'; ?>

	<?php //Common header for all pages
		include(SHARED_PATH . '/head.php');

			unset_session_cookie();
			redirect_in_time('index.php',1);
?>




<!-- Common footer for all pages -->
<?php include(SHARED_PATH . '/footer.php') ?>
