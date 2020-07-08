<?php require_once('./private/initialize.php'); ?>

<?php //Define Title
	$page_title = 'Home';
	//check if user has already loged in
	if (check_cookie()){
		redirect_to('index.php');
	}
?>

<?php //Common header for all pages
	include(SHARED_PATH . '/head.php');
?>
<body>
  <?php include(SHARED_PATH . '/heading.php'); ?>

    <main class="page contact-page w-100 bg-white" id="login" >
        <section class="portfolio-block contact pt-0">
            <div class="container">
                <form action="verifying.php" method="post" >
										<div class="btn-group btn-group-toggle w-100 pb-4" data-toggle="buttons" role="group" aria-label="Basic example">
											<label class="btn btn-light active text-monospace" style="box-shadow: none;">
										    <input v-on:click="clickLogin()" type="radio" name="action" id="action" value="L"autocomplete="off" checked>Login
										  </label>
										  <label class="btn btn-light text-monospace" style="box-shadow: none;">
										    <input v-on:click="clickRegister()" type="radio" name="action" id="action" value="R" autocomplete="off"> Register
										  </label>
										</div>
                    <div class="form-group"><label for="name">Username</label><input class="form-control item" type="text" id="name" name="username" required="" minlength="4" maxlength="20" required pattern="[a-zA-Z0-9]{5,20}"></div>
                    <div class="form-group"><label for="subject">Password</label><input class="form-control" type="password" name="pswd" required="" maxlength="20" minlength="8"></div>
										<span v-if="registerBool">
											<div class="form-group"><label for="name">Name/Nickname</label><input class="form-control item" type="text" id="artist_name" name="artist_name" required="" minlength="4" maxlength="20" required pattern="[a-zA-Z0-9]{5,20}"></div>
											<div class="form-group"><label for="name">Register Invitation Code</label><input class="form-control item" type="text" id="rcode" name="rcode" required=""></div>
										</span>
                    <div class="form-group d-flex justify-content-center pt-3"><button name="action" class="btn btn-info btn-block btn-lg text-monospace text-center" type="submit" style="width: 200px;margin-left: 30px;margin-right: 30px;">Submit</button></div>

                </form>
            </div>
        </section>
    </main>


		<script>


			var vmPic = new Vue({
				el: '#login',
				data: {
					registerBool: false,
				},

				methods: {
					clickRegister:function(){
						this.registerBool = true;
					},
					clickLogin:function(){
						this.registerBool = false;
					}



				}
			});
		</script>

	<?php //Common footer for all pages
		include(SHARED_PATH . '/footer.php') ?>
