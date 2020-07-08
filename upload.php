<?php require_once('./private/initialize.php'); ?>

<?php //Define Title
	$page_title = 'Home'; ?>

	<?php
		// processing files
		if(request_is_post()) {
			$check = getimagesize($_FILES["file"]["tmp_name"]);

			if (($_FILES["file"]["type"] != "image/jpeg")
			&& ($_FILES["file"]["type"] != "image/jpg")
			&& ($_FILES["file"]["type"] != "image/png")
			|| ($check == false)){
				echo "file format error";
				//redirect_in_time('upload.php',1);
			}
			// Check file size
			if ($_FILES["file"]["size"] > 52428800 ) {
			  echo "Maximum file size 50MB";
			  redirect_in_time('upload.php',2);
				exit();
			}

			//connect to the databse
			$db = db_connect();

			$target_dir = IMAGE_PATH ."/artwork/";
			$username = $_COOKIE['username'];
			$artwork_name = $_POST['artwork_name'];
			$artwork_des = $_POST['artwork_des'];
			$category = $_POST['category'];
			$artwork_id = next_artwork_id($db);
			$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
			$target_file = $artwork_id . "." . $ext;
			$target_path = $target_dir . $target_file;

			//save the file
			if ($_FILES["file"]["size"] < 10000000 ) {
				move_uploaded_file($_FILES["file"]["tmp_name"],$target_path) or exit("error 1");

				save_thumbnail($target_path, $artwork_id, $ext);

				//insert file to the databse
				insert_artwork($db, $artwork_id, $artwork_name,$artwork_des, $target_file,$username,$category);
			} else {
				save_photo($_FILES["file"]["tmp_name"],$artwork_id, $ext);
				$target_file = $artwork_id . ".png";
				$target_path = $target_dir . $target_file;
				save_thumbnail($target_path, $artwork_id, "png");

				//insert file to the databse

				insert_artwork($db, $artwork_id, $artwork_name,$artwork_des, $target_file,$username,$category);
			}


			//close the connection
			db_disconnect($db);
			echo ("Successfully uploaded");
			redirect_in_time('upload.php',1);
		}
	?>

  <?php //Common header for all pages
  	include(SHARED_PATH . '/head.php');
  ?>
  <body>
<?php include(SHARED_PATH . '/heading.php'); ?>

<div class="text-center">

</div>
    <main class="page contact-page w-100 bg-white" id="upload">
        <section class="portfolio-block contact pt-0">
            <div class="container">

                <form @submit="onSubmit" method="POST" class="px-5 py-3" enctype="multipart/form-data">
                    <h2 class="text-center" style="margin-bottom: 30px;">Upload a photo</h2>
                    <div class="form-group"><label for="subject">Category</label><select class="form-control" id="category" name="category">
                      <option value="landscape">Landscape</option>
                      <option value="portrait">Portrait</option>
                      <option value="animal">Animal</option>
                      <option value="life">Life</option>
                      <option value="sports">Sports</option>
                      <option value="architectural">Architectural</option>
                      <option value="fashion">Fashion</option>
                      <option value="micro">Micro</option>
                      <option value="abstract">Abstract</option>
                      <option value="others">Others</option>
                    </select></div>
                    <div class="form-group"><label for="email">Title</label><input class="form-control" type="text" id="artwork_name" name="artwork_name" required=""></div>
				            <div class="form-group"><label for="message">Description</label><textarea class="form-control" id="message" name="artwork_des"></textarea></div>
				            <div class="form-group pt-1"><input type="file" name="file" required="" accept="image/*"></div>
				            <div class="form-group pt-1"><button class="btn btn-info btn-block" type="submit" style="margin-top: 0px;">Upload</button></div>
            		</form>
            </div>
        </section>
    </main>

<script>
var vmUpload = new Vue({
  el: '#upload',
  methods: {
    onSubmit(e) {
      const file = this.$refs.file.files[0];

      if (!file) {
        e.preventDefault();
        alert('No file chosen');
        return;
      }

      if (file.size > 52428800) {
        e.preventDefault();
        alert('File too big (> 50MB)');
        return;
      }
    },
  },
});
</script>

<?php //Common footer for all pages
	include(SHARED_PATH . '/footer.php') ?>
