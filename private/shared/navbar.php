<?php require_once('./private/initialize.php') ?>

<div id="navbar">
	<nav class="navbar navbar-expand-md navbar-light pb-0 pt-2 px-3">
  		<ul class="navbar-nav nav-fill w-100">
	  		<li class="nav-item mb-3">
      			<a class="text-dark py-3 px-5" style="text-decoration:none" href="index.php">FEATURE</a>
	    	</li>
				<li class="nav-item mb-3 ">
      			<a class="text-dark py-3 px-5" style="text-decoration:none" href="#" v-on:click="clickCate()">CATEGORY</a>
	    	</li>
				<li class="nav-item mb-3">
      			<a class="text-dark py-3 px-5" style="text-decoration:none" href="#" v-on:click="clickArtist()">ARTISTS</a>
	    	</li>
				<li class="nav-item mb-3">
      			<a class="text-dark py-3 px-5" style="text-decoration:none" href="about.php">ABOUT</a>
	    	</li>
  		</ul>
	</nav>

	<!-- Nav Dropdown-->
	<section  class ="clean-block slider px-3" id="navDropdown" >
		<div class="row">
				<div class="col-md px-0"></div>
				<div class="col-md-3 px-0" id="categoryCol">
					<nav class="navbar navbar-light bg-light animated flash" :style="cateSeen" style="display:none;">
							<ul class="navbar-nav">
									<li v-for="item in category"  class="nav-item">
										<a class="nav-link"   :href="getCategoryLink(item)">{{item}}</a>
									</li>
							</ul>
					</nav>
				</div>
				<div class="col-md-3 px-0" id="artistCol">
					<nav class="navbar navbar-light bg-light":style="artistSeen" style="display:none;">
							<ul class="navbar-nav">
								<li v-for="item in artist"  class="nav-item">
									<a class="nav-link"  :href="getArtistLink(item)">{{item}}</a>
								</li>
							</ul>
					</nav>
				</div>
				<div class="col-md px-0"></div>
		</div>
	</section>

</div>
<script>
	var vmBar = new Vue({
		el: '#navbar',
		data: {
			category: ['Landscape','Portrait','Animal','Life', 'sports','architectural','fashion','micro', 'abstract','others'],
			artist: ['Johnny'],
			cateSeen:"display:none;",
			artistSeen:"display:none;",
		},
		methods: {
			clickCate: function(){
				if (this.cateSeen == "display:none;"){
					this.artistSeen ="display:none;";
					this.cateSeen="display:block;";
				} else {
					this.cateSeen ="display:none;";
				}
			},
			closeCate: function(){
				this.cateSeen="display:none;";
			},
			clickArtist:function(){
				if (this.artistSeen == "display:none;"){
					this.cateSeen ="display:none;";
					this.artistSeen="display:block;";
				} else {
					this.artistSeen ="display:none;";
				}
			},
			getCategoryLink:function(name){
				return "index.php?category="+ name.toLowerCase();
			},
			getArtistLink:function(name){
				return "index.php?artist="+ name;
			},
		}
	});
</script>
