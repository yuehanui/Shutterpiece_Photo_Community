<?php require_once('./private/initialize.php') ?>

<?php if (check_cookie()){ //if logged in
				$userLink='account.php';
				$userTitle = 'My Account';
				$showSubmit = "";
			} else {
				$userLink='login.php';
				$userTitle = 'Register / Login';
				$showSubmit = "none";
			}
?>

<nav class="navbar navbar-expand navbar-light  justify-content-end py-0 pr-3">
    <ul class="navbar-nav text-center">
			<li class="nav-item" style="display:<?php echo $showSubmit?>">
        <a class="nav-link" href="upload.php">
					<img class=" material-tooltip" data-toggle="tooltip"
				  data-placement="bottom" title="Upload a photo"src="../img/upload.png" height="18">
				</a>
      </li>
			&nbsp;
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $userLink;?>">
					<img class=" material-tooltip" data-toggle="tooltip"
				  data-placement="bottom" title="<?php echo $userTitle;?>"src="../img/user.png" height="18">
				</a>
      </li>
			&nbsp;
      <li class="nav-item">
        <a class="nav-link" href="https://github.com/yuehanui/">
					<img class=" material-tooltip" data-toggle="tooltip"
				  data-placement="bottom" title="View Source Code" src="../img/code.png" height="18">
				</a>
      </li>


    </ul>

</nav>

<script>
$(function () {
  $('.material-tooltip').tooltip({
    template: '<div class="tooltip md-tooltip"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner"></div></div>'
  });
})
</script>
