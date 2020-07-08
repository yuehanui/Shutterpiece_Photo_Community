<?php require_once('./private/initialize.php');
			if (isset($_GET["category"])){
				$artworkInfo=get_imgs("C",$_GET["category"]);
			} else if (isset($_GET["artist"])){
				$artworkInfo=get_imgs("A",$_GET["artist"]);
			} else {
				$artworkInfo=get_imgs("","");
			}
 ?>

<?php //Define Title
	$page_title = 'Home'; ?>

<?php //Common header for all pages
	include(SHARED_PATH . '/head.php'); ?>

<body>
	<?php //Common heading for all pages
		include(SHARED_PATH . '/heading.php');
		?>
    <main class="page projets-page w-100">
			<div id="pictures" class="bg-light ">
        <section class="portfolio-block projects compact-grid pt-0" :style="gridSeen">
            <div class="row no-gutters" >
                <div v-for="pic in genPic(artworkInfo)" class="col-md-6 col-lg-4 item zoom-on-hover">
									<a href="#" v-on:click="openViewer(pic[8])">
										<img class="img-fluid image" :src="pic[4] ">
											<span class="description">
												<span class="description-heading">{{pic[1]}}</span>
												<span class="description-body">By {{pic[7]}}, {{pic[3]}}</span>
											</span>
									</a>
								</div>

            </div>
        </section>

				<!-- Image Viewer-->
				<section  class = "clean-block slider " id="imageViewer":style="viewerSeen" style="display:none;">
					<div class="container-fluid">
						<div class="row">
							<div class="col">
								<button v-on:click="closeViewer()" class="btn btn-light m-0 mt-3">
									<svg class="_3p8U1" version="1.1" viewBox="0 0 32 32" width="50" height="50" aria-hidden="false">
										<path d="M25.33 8.55l-1.88-1.88-7.45 7.45-7.45-7.45-1.88 1.88 7.45 7.45-7.45 7.45 1.88 1.88 7.45-7.45 7.45 7.45 1.88-1.88-7.45-7.45z"></path>
									</svg>
								</button>
							</div>
							<div class="col-8">
								<div class="block-heading pt-4">
										<h1 class="text-info mb-1">{{pic[1]}}</h1>
										<p class="mb-1">By {{pic[7]}}, {{pic[3]}}</p>
										<p>{{pic[2]}}</p>
								</div>
							</div>
							<div class="col"></div>
						</div>

						<div class="row">
							<div class="col-md"></div>
							<div class="col-md-10">
								<div class="carousel" data-ride="carousel"  data-interval="false" data-keyboard="false" id="carousel-1" >
										<div class="carousel-inner text-center" role="listbox">

												<div id="imgContainer carousel-item"><img class="img-fluid imgView " :src="pic[5]" alt="Slide Image"></div>
										</div>
										<div>
											<a  v-if="this.index > 0" v-on:click="preImage()" class="carousel-control-prev" role="button" >
												<button id="preButton" class="btn btn-light active"><svg class="_2tKOW" version="1.1" viewBox="0 0 32 32" width="50" height="50" aria-hidden="false">
													<path d="M20.6667 24.6666l-2 2L8 16 18.6667 5.3333l2 2L12 16l8.6667 8.6666z"></path>
												</svg>
													</button>
											</a>
											<a v-if="this.index < this.artworkInfo.length-1" v-on:click="nextImage()" class="carousel-control-next"  role="button"
														>
														<button id="nextButton" class="btn btn-light active"><svg class="_2tKOW" version="1.1" viewBox="0 0 32 32" width="50" height="50" aria-hidden="false">
															<path d="M11.3333 7.3333l2-2L24 16 13.3333 26.6666l-2-2L20 16l-8.6667-8.6667z"></path>
														</svg></button>
											</a>
										</div>
								</div>
							</div>
							<div class="col-md"></div>
						</div>
				</div>
        </section>
			</div>
		</main>

    <script>

    	var vmPic = new Vue({
    		el: '#pictures',
    		data: {
          artworkInfo : <?php echo $artworkInfo ?>,
    			loggedin:<?php echo check_cookie() ? 'true' : 'false'; ?>,

					pic : "",
					index:"",
					currentWindow:1,
					viewerSeen:"display:none;",
					gridSeen:"",
					imgHide: "",


    		},
    		mounted() {
					this.viewerSeen="display:none;";
    		},

				updated:function() {
					this.$nextTick(function(){

						})
				},
    		methods: {
    			genPic: function(pics){

            var arr=[];
    				for (var pic in pics) {
    					arr.push(pics[pic]);
    				}
    				return arr;
    			},
					openViewer: function(index){
						this.index = parseInt(index);
						this.pic = this.artworkInfo[this.index];
						this.gridSeen="display:none;";
						this.viewerSeen="display:block;";
					},
					closeViewer: function(){
						this.gridSeen="";
						this.viewerSeen="display:none;";
						this.index="";
					},

					preImage:function(){
						this.index -= 1;
						this.pic = this.artworkInfo[this.index];

					},
					nextImage:function(){

						this.index += 1;
						this.pic = this.artworkInfo[this.index];
					}




    		}
    	});
    </script>

<?php //Common footer for all pages
    include(SHARED_PATH . '/footer.php');
?>
