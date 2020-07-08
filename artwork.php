<?php require_once('../private/initialize.php'); ?>

<?php //Define Title
	$page_title = 'affdff'; ?>

<?php //Common header for all pages
	include(SHARED_PATH . '/head.php'); ?>
	<?php //Common heading for all pages
		include(SHARED_PATH . '/heading.php');
		?>

<body>
    <main>
        <section class = "bg-light ">
					<div class="p-5">
						<p>Author<p>
						
					<div class="row">
					<div class="col-md-2 col-lg-2">
					</div>
					<div  class="col-md-8 col-lg-8 item ">
						<img class="img-fluid " src="../img/artwork/1000001.JPG">

					</div>
					<div class="col-md-2 col-lg-2 item "></div>
				</div>


			</div>
        </section>

    <script>

    	var vmPic = new Vue({
    		el: '#pictures',
    		data: {
          artworkInfo : <?php echo get_imgs_path() ?>,
    			loggedin:<?php echo check_cookie() ? 'true' : 'false'; ?>
    		},
    		mounted() {

    		},
    		methods: {
    			genPic: function(pics){
            var arr=[];
    				for (var pic in pics) {
    					arr.push(pics[pic]);

    				}
    				return arr;
    			},
    		}
    	});
    </script>

<?php //Common footer for all pages
    include(SHARED_PATH . '/footer.php');
?>
