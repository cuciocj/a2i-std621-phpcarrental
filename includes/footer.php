<footer>
  <div class="container-fluid footercontainer">
    <div class="row">
      <div class="col-md-4 footercol1">
        <img src="images/logo.png" width="120px" height="120px"><br>
        <h4>
          <p> Contact Us</p>
        </h4>
        <p>
          <h6>Address: Auckland Central</h6>
          <h6>Phone no: +64 123123123</h6>
          <h6>Remember us to book any car</h6>
        </p>

      </div>
      <div class="col-md-2 footercol2">
        <h3>LINKS 1</h3>
        <ul>
          <!-- 
            <li> <a class="footercol2content" href="index.html">Home</a> <br> </li> <br>
            <li> <a class="footercol2content" href="our-services.html">Services</a><br> </li> <br>
            <li> <a class="footercol2content" href="our-services.html">About Us</a><br> </li> <br>
            <li> <a class="footercol2content" href="our-services.html">Contact</a><br> </li> <br>
            -->

          <?php
          if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo '<footer>'
              . '<li><a href="our_location.php">Our Location</a></li>'
              . '<li><a href="about_us.php">About Us</a></li>'
              . '<li><a href="feedback.php">Give Feedback</a></li>'
              . '</footer>';
          } else {

            echo '<footer>'
              . '<li><a href="our_location.php">Our Location</a></li>'
              . '<li><a href="about_us.php">About Us</a></li>'
              . '</footer>';
          }
          ?>

        </ul>
      </div>
      <div class="col-md-2 footercol2">
        <h3>LINKS 2</h3>
        <ul>
          <!-- 
            <li> <a class="footercol2content" href="index.html">Home</a> <br> </li> <br>
            <li> <a class="footercol2content" href="our-services.html">Services</a><br> </li> <br>
            <li> <a class="footercol2content" href="our-services.html">About Us</a><br> </li> <br>
            <li> <a class="footercol2content" href="our-services.html">Contact</a><br> </li> <br>
        -->
          <?php
          if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo '<footer>'
              . '<li><a href="our_location.php">Our Location</a></li>'
              . '<li><a href="about_us.php">About Us</a></li>'
              . '<li><a href="feedback.php">Give Feedback</a></li>'
              . '</footer>';
          } else {

            echo '<footer>'
              . '<li><a href="our_location.php">Our Location</a></li>'
              . '<li><a href="about_us.php">About Us</a></li>'
              . '</footer>';
          }
          ?>


        </ul>
      </div>

      <!-- https://developers.google.com/maps/documentation/javascript/get-api-key -->
      <div class="col-md-4 footercol3">
        <h3>Find Us on Map</h3> <br>
        <div id="googleMap" style="width:100%;height:200px;"></div>

      </div>
    </div>
  </div>
  <div>
    <h6 class="footercopyright mb-0">Copyright 2020, <a href="#" class="footercopyright">Car Rental Services</a></h6>
  </div>
</footer>