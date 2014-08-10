<?php
require_once 'login.php';

if (!$loggedin) {
	$redirect = <<<_REDIRECT
You must <a href="./Editor/editorLogin.php">Login</a>
_REDIRECT;
die($redirect);
}

echo <<<_PAGE

<!doctype html>
<html>
<head>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">
  <script language="javascript" src="js/modernizr.dexterfoundation.js"></script>

<style>

</style>

</head>
<body>


<div id="allcontent" style="height: 700px;">
<div class="title" id="titleAdminPanel">Admin Panel</div>
<div id="adminPanel">

<a class="editLink" id="doggies" href="Editor/editDoggies.php">
	<div>
	<p class="title">Rescued<br>Doggies</p>
	</div></a>

<a class="editLink" id="success" href="Editor/editSuccess.php">
	<div>
	<p class="title">Adopted<br>Doggies</p>
	</div></a>

<a class="editLink" id="articles" href="Editor/editArticles.php">
	<div>
	<p class="title">Article<br>Updates</p>
	</div></a>

<a class="editLink" id="contact" href="Editor/editContact.php">
	<div>
	<p class="title">Contact<br>Info</p>
	</div></a>

<a class="editLink" title="Not Yet Active" id="contact" href="#">
	<div>
	<p class="title">Sponsors</p>
	</div></a>

<a class="editLink" id="contact"href="Editor/editAdmin.php">
	<div>
	<p class="title">Admin<br>Info</p>
	</div></a>
</div>


</div>
</body>


</html>
_PAGE;
?>