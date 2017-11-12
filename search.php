<!doctype html>
<html lang="en">



<head>
<title>Welcome to Tutoring</title>
<!-- Required meta tags -->
<meta charset="UTF-8" />
<meta name="description" content="Free Tutoring Online, come sign in and get help right away!" />
<meta name="keywords" content="tutor, tutoring, service, math, reading, science" />
<meta name="author" content="Victor Martins" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="styles\styles.css"/>
</head>
<body>

<div class="container">
  <div class="row">
      <div class="col-md-12 botHead">
          <div class="head botMZ">
              <div class="headPadding">
                  <h1 class="text-white"><u>Tutoring Services</u></h1>
                  <p class="lead text-capitalize text-white">face to face online</p>
              </div>
          </div>

      </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-lg-12 navPad clearfix">
        <ul class="nav nav-tabs">
        <li role="presentation"  class="nav-item">
        <a class="nav-link" href="/bootWeb/home.php">Home</a>
        </li>
        <li role="presentation" class="nav-item">
        <a class="nav-link" href="/bootWeb/tutor.php">Request Tutoring</a>
        </li>
        <li role="presentation"  class="nav-item">
        <a class="nav-link" href="/bootWeb/enrollment.php">Tutoring Enrollment</a>
        </li>
        <li role="presentation"  class="nav-item">
        <a class="nav-link  active" href="/bootWeb/search.php">Search</a>
        </li>
        </ul>
    </div>
  </div>

<div class="row no-gutters"> <!--wrapper for main home column-->
    <div class="col-xs-6 col-md-8 col-md-12 col-lg-12">
        <div class="homeMainDiv2">
            <div class="row">

                <div class="col-xs-6 col-md-12">


                  <form method="post" action="<?php echo htmlspecialchars
                  ($_SERVER["PHP_SELF"]);?>"
                    target="_self" name="submit-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Anything" name="search"/>
                        <div class="input-group-btn">
                            <button type="submit" name="submitButton" class="btn btn-primary">Find</button>
                        </div>
                        </form>

                    </div>
                </div>

                <div class="col-xs-6 col-md-12">
                  <?php
                  if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if ($_POST['search']) {
                      $raw_input = $_POST['search'];

                    }
                    else{
                      echo "Unabled to reach search function.";
                    }

                    $location = "localhost";
                    $user = "root";
                    $pass = "";
                    $dataBase = "tutoringsite";
                    $connected = @new mysqli("$location",$user,$pass,$dataBase);

                    $ErrorMsg = array();
                    $searchResult = @$connected->select_db($dataBase);
                    if($connected->connect_errno){
                        $ErrorMsg[] = "The Database Server is not available.";
                        foreach($ErrorMsg as $msg){
                            echo "<p>" . $msg . "</p>\n";

                        };
                    }
                    else{
                      if (isset($_POST["submitButton"])) {
                        $sqlSearch = "SELECT * FROM students_t WHERE lastName LIKE '%$raw_input%' OR firstName LIKE '%$raw_input%'
                        OR studentID LIKE '%$raw_input%' OR regDate LIKE '%$raw_input%' OR email LIKE '%$raw_input%' OR
                        selection LIKE '%$raw_input%' OR message LIKE '%$raw_input%'";

                        $sendData = $connected->query($sqlSearch);

                        echo "<table class='table table-inverse'>
                            <thead>
                            <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Student ID</th>
                            <th>Date</th>
                            <th>E-mail</th>
                            <th>Selection</th>
                            <th>Message</th>
                            </tr>
                            </thead>";

                            while($row = mysqli_fetch_array($sendData)) {
                              echo "<tr>";
                              echo "<td>".$row['lastName'] . "</td>";
                              echo "<td>".$row['firstName']."</td>";
                              echo "<td>".$row['studentID'] . "</td>";
                              echo "<td>".$row['regDate'] . "</td>";
                              echo "<td>".$row['email'] . "</td>";
                              echo "<td>".$row['selection']."</td>";
                              echo "<td>".$row['message'] . "</td>";
                              echo "</tr>";
                            }
                            echo "$row";
                            echo "</table>";
                      }

                    }

                  };
                   ?>
               </div>
            </div>
        </div>
    </div>
</div> <!-- row-no-gutters-div-->
<div class="col-md-12 botHead"><br><br><br><br><br><br><br><br>
<br><br><br><br><br><h1 class="text-center">Search for anything!</h1><br><br><br><br></div>
  <div class="row"> <!--Footer-->
    <div class="col-md-12 botHead">
      <div class="head botMZ">
        <div class="headPadding">
          <p class="text-white lead footerTab">&copy;Tutoring Services LLC</p>
        </div>
      </div>
    </div>
  </div><!--End of Footer-->
</div> <!-- End of Container-->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
