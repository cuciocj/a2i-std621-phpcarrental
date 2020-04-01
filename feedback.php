<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include './includes/head.php'; ?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
		.videoLink {
			position: relative;
			top: 200px;
			;
			left: 48.7%;
			z-index: 1;
		}

		.videoLink img {
			height: 47px;
		}
	</style>
</head>
<?php

include('config.php');

if (isset($_POST["btnsubmit"])) {
	$sql = "insert into feedback(Subject,Message) values('" . $_POST["txtSubject"] . "','" . $_POST["txtFeedBack"] . "')";
	if ($mysqli->query($sql) === TRUE) {
		echo "<script>alert('Thanks for the Feed Back');</script>";
	}
}
?>
<body>
<?php include './includes/header.php'; ?>
<div class="container">
	<h2 style="margin-top: 3em">Send Your Feed Back </h2>
	<div class="row">
		<div class="col-md-6">

			<form action="FeedBack.php" method="POST" required="">
				<div class="form-group">
					<label for="text">Subject :</label>
					<input type="text" class="form-control" id="email" placeholder="Enter Subject " name="txtSubject" required="">
				</div>
				<div class="form-group">
					<label for="pwd">FeedBack Message :</label>
					<textarea class="form-control" rows="10" id="feedback" name="txtFeedBack" required="" placeholder="Enter Feed Back "></textarea>

				</div>
				<input type="submit" class="btn btn-primary" value="Submit" name="btnsubmit" />
			</form>

		</div>
		<div class="col-md-6">
			<div class="h3-title">
				<h3>contact us</h3>
			</div>
			<ul>
				<li>
					<span class="fa fa-home" aria-hidden="true"></span>
					<p>206 Victoria Street West <br /> Auckland CBD 1010 <br /> Auckland </p>
				</li>
				<li>
					<span class="fa fa-envelope-o" aria-hidden="true"></span>
					<a href="mailto:info@example.com">admin@rentalcars.com</a>
				</li>
				<li>
					<span class="fa fa-phone" aria-hidden="true"></span>
					<p>+64 9 256 9017</p>
				</li>
			</ul>
		</div>

	</div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<a href="https://www.youtube.com/watch?v=hNYDGaaZ3ic" class="videoLink"><img src="mark.jpg" /> </a>



			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102063.63430199993!2d174.6684069074659!3d-36.92649063963234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d0d47fd91bac3e7%3A0xbbd54c7ef51725cf!2sApex%20Car%20Rentals%20Auckland%20City!5e0!3m2!1sen!2sin!4v1584262661974!5m2!1sen!2sin" frameborder="0" style="border:0;width:100%;height:400px;" allowfullscreen="">
			</iframe>
		</div>
	</div>
</div>
<?php include './includes/footer.php'; ?>
</body>
</html>