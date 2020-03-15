<!DOCTYPE html>
<html>
<head>
	<title>Password Reset</title>
	<?php include './includes/head.php'; ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="~/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    
	
</head>
<body>
	<?php include './includes/header.php'; ?>
    <br><br><br><br>
    <div class="PopUpBG">
             <div class="PopUp">
                <h3 class="modal-title">
              <span>Reset Password</span>
                </h3>
                <div class="container">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">

              <form id="form">
                <p>Please enter your old password</p>

              <input type="password" name="oldPw" id="oldPw" required="required" />
              <br><br>

              <p>Please enter your email address to reset your password</p>
              <input type="email" name="ResetEmail" id="ResetEmail" placeholder="Email Address" required="required" />
              <br><br>

              <input type="button" class="btn btn-success" value="Send" onclick="ResetPassword(this);"/>
              <br><br>

            </form>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            
          </div>

    </div>
    <br><br>

<script type="text/javascript">
   function ResetPassword(e) {
    if (!$("#form").validate())
        return false;

    $.ajax({
        type: "POST",
        url: "/Account/loginRequestResetPassword",
        dataType: "json",
        data: {
            Email: $("#ResetEmail").val().trim(),
        },
        success: function () {
            console.log("send");
            $(".PopUp").html("We have sent mail to you");
            setTimeout(function () {
                $(".PopUpBG").fadeOut();
            }, 10000); // fadeout the message after a few seconds
        },
        error: function () {
            console.log('something went wrong - debug it!');
        }
    })
} 

</script> 

	 <?php include './includes/footer.php'; ?>
	 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/datepicker.js"></script>
    <script src="js/nav.js"> </script>
    <script src="js/popper.min.js"></script>

</body>
</html>