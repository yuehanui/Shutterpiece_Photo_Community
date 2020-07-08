<?php
	//start session
	session_start();
	// Define variables for common directory
	define("PRIVATE_PATH",dirname(__FILE__));
	define("PROJECT_PATH",dirname(PRIVATE_PATH));
	define("PUBLIC_PATH",PROJECT_PATH. '/public');
	define("SHARED_PATH", PRIVATE_PATH. '/shared');
	define("IMAGE_PATH", PROJECT_PATH. '/img');

	require_once(PRIVATE_PATH.'/function.php');
?>


<!-- Bootstrap CSS-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Vue.js -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>



<style>
@font-face{
  font-family: 'GothamLight';
  src: url("../private/shared/fonts/Gotham-Light.otf") format("opentype");
}
@font-face{
  font-family: Buffalo;
  src: url("../private/shared/fonts/BuffaloScript-Regular.otf") format("truetype")
}
@font-face{
  font-family: Cramaten;
  src: url("../private/shared/fonts/cramaten.ttf") format("truetype")
}
html {
  position: relative;
  min-height: 100%;
}

.footer {
  position: absolute;
  bottom: -20;
  width: 100%;
  /* Set the fixed height of the footer here */

}
a:hover{
    text-decoration: none;
}
#showImage {

  height: 70%;
  width: auto;
  display: block;

  margin-left: auto;
  margin-right: auto;

}
body{
	font-family: GothamLight;
}

#logoLink{
	z-index: 9;
}

#navbar{ font-family: GothamLight;}

/* overlay effect */
.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: 0.4s;
  background-color:#222222;
}

.overlay:hover{
  opacity: 0.7;
}

#addButton {
  background-color: #CBCBCB;
  transition: none;
  opacity: 0.1;
}
#addButton:hover {
  background-color: #000000;
  opacity: 0.1;
}

#imageViewer{

	font-family: GothamLight;
	z-index: 1026;
}

#imageViewer2{


}

#viewerBack{

	background-color: #AAAAAA;
	opacity:0.8;
	z-index: 1021;
}
#showImage{

 max-width:90%;
 height:auto;
 max-height:60vh;

}
#nextImage, #preImage{
  top: 50%;

}

.imgView{
	max-height:100%;
}

#imgContainer{
	height:80%;

}

#nextButton:hover,#preButton:hover {
  outline: none;
  box-shadow: none;
}
#nextButton:focus,#preButton:focus {
  outline: none;
  box-shadow: none;
}

.btn{
	outline: none;
	box-shadow: none;
}
#aa:focus{
	outline: none;
  box-shadow: none;
}
main {
	position:absolute;
	top:181px;
	z-index:1;
}
#navDropdown{
	top:181px;
}


#artistCol,#categoryCol{
	z-index:1030;
}

@media (max-width: 767px) {
    main {top:291px;}
}



#navbar .nav-item::after{content:'';display:block;width:0px;height:1px;background:#aaaaaa;transition: 0.2s;}
#navbar .nav-item:hover::after{width:100%;}
.navbar-dark .navbar-nav .active > .nav-link, .navbar-dark .navbar-nav .nav-link.active, .navbar-dark .navbar-nav .nav-link.show, .navbar-dark .navbar-nav .show > .nav-link,.navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav
.nav-link{padding:0px 0px;transition:0.2s;}

</style>
