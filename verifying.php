<?php require_once('./private/initialize.php'); ?>

<?php //Define Title
	$page_title = 'verifying...'; ?>

<?php //request must be POST, preventing direct access via url
	$msg="";
	if(!request_is_post()) {
		redirect_to("index.php");
		exit();
	}


	// Login
	if (!isset($_POST['artist_name'])){
		$db = db_connect();
		$username = db_escape($db,$_POST['username']);
		$pswd_query = "SELECT PASSWORD_HASH FROM artist WHERE USERNAME='".$username. "'";
		$pswd_result = mysqli_query($db, $pswd_query);
		db_disconnect($db);

		if (mysqli_num_rows($pswd_result)>0){
			$pswdhash = mysqli_fetch_row($pswd_result)[0];
			if (password_verify($_POST['pswd'], $pswdhash)){
				$token = randomString(60);
				set_cookie($username, $token);
				set_session($username,$token);
				$msg = "Loging in...";
				redirect_in_time_no_exit("index.php", 1);
			} else {
				$msg =  "Username not found or password doesn't match";
				redirect_in_time_no_exit("login.php", 1);
			}
		} else {
			$msg = "Username not found or password doesn't match";
			redirect_in_time_no_exit("login.php", 1);
		}

	// Register
	} else {
		if ($_POST["rcode"] != "reservedForRegisCode"){
			$msg = "Public registration is not yet open";
			redirect_in_time_no_exit("index.php", 1);
		} else {

			if (username_taken($_POST['username'])){
				$msg = "Username was taken";
				redirect_in_time_no_exit("login.php", 1);
			} else {
				$db = db_connect();
				$pswdhash = "'" . password_hash($_POST['pswd'], PASSWORD_DEFAULT) . "'";
			  $artist_name = "'" . db_escape($db, $_POST['artist_name']) . "'";
			  $username = "'" . db_escape($db, $_POST['username']) . "'";
				$next_id = next_artist_id($db);
				$query = "INSERT INTO artist(artist_id, artist_name,username,password_hash) VALUES ($next_id, $artist_name, $username, $pswdhash )";
				mysqli_query($db, $query);
				$msg = "Register Successfully";
			}
		}

	}
?>

<?php //Common header for all pages
	include(SHARED_PATH . '/head.php');

?>
<body>
<?php
	include(SHARED_PATH . '/heading.php');
?>
    <main class="page contact-page w-100">
        <section class="portfolio-block contact pt-0  bg-white">
						<div class="container text-center h-75">
							<?php
								echo $msg;
								redirect_in_time("index.php", 1);
								exit();
							?>
							
						</div>

					</section>
	</main>

<?php //Common footer for all pages
	include(SHARED_PATH . '/footer.php') ?>
