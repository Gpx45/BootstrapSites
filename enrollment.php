<!doctype html>
<html lang="en">




<?php

    $lastName = $firstName = $StudentID = $rgDate =
    $email = $selection = $messages = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    };

    $lastNameErr = $firstNameErr = $StudentIDErr = $dateErr =
    $emailErr = $selectionErr = $messagesErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["lname"])) {
            $lastNameErr = "Last Name is required";
        } else {
            $raw_input = test_input($_POST["lname"]);
            $lastName = ucwords($raw_input);
        }

        if (empty($_POST["fname"])) {
            $firstNameErr = "First Name is required";
        } else {
            $raw_input = test_input($_POST["fname"]);
            $firstName = ucwords($raw_input);
        }

        if (empty($_POST["studentID"])) {
            $StudentIDErr = "Student ID Required";
        } else {
            $StudentID = test_input($_POST["studentID"]);
        }

        if (empty($_POST["rdate"])) {
            $dateErr = "Date Required";
        } else {
            $rgDate = test_input($_POST["rdate"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST["selection"])) {
            $selectionErr = "Select Your  Course";
        } else {
            $selection = test_input($_POST["selection"]);
        }

        if (empty($_POST["comments"])) {
            $messagesErr = "Please Enter a Message";
        } else {
            $messages = test_input($_POST["comments"]);
        }
    }
    ?>


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
        <a class="nav-link active" href="/bootWeb/enrollment.php">Tutoring Enrollment</a>
        </li>
        <li role="presentation"  class="nav-item">
        <a class="nav-link" href="/bootWeb/search.php">Search</a>
        </li>
        </ul>

      </div>

    </div>


<div class"col-xs-6 col-md-8 col-md-12 col-lg-12">
  <div class="homeMainDiv2">
    <div class="row">
      <div class="col-xs-6 col-md-12">
      <?php
        $ErrorMsg = array();
        $DBConnect = @new mysqli("localhost","root","","tutoringsite");
        $DBstudents_t = "tutoringsite";
        if($DBConnect->connect_errno){
            $ErrorMsg[] = "The Database Server is not available.";
            foreach($ErrorMsg as $msg){
                echo "<p>" . $msg . "</p>\n";
            };
        }
        else{

            $Result = @$DBConnect->select_db($DBstudents_t);
            if($Result === FALSE){
                echo "<p>Unable to select the database.</p>"
                . $DBConnect->errno.": " . $DBConnect->error."\n";
            }
            else{

            };

            $result = mysqli_query($DBConnect,"SELECT * FROM students_t");

            echo "<table class='table table-inverse'>
              <thead>
              <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Student ID</th>
              <th>Date</th>
              <th>E-mail</th>
              <th>Discipline</th>
              <th>Comments</th>
              </tr>
              </thead>";

              while($row = mysqli_fetch_array($result)) {
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

            $DBConnect->close();
          }
      ?>
      </div>
    </div>
  </div>
</div>


    <div class="row">
        <div class="col-md-12 botHead">
            <div class="head botMZ">
                <div class="headPadding">
                <p class="text-white lead footerTab">&copy;Tutoring Services LLC</p>
                </div>
            </div>
        </div>
    </div>



            <?php
            include 'db.php';

            $Result = @$DBconnect->select_db($dataBase);
            if($Result === FALSE){
                echo "<p>Unable to select the database.</p>",
                $DBconnect->errno.": " . $DBconnect->error."\n";
            }

            if(isset($_POST['submitButton'])){

            if(empty($_POST["lname"]) ||
            empty($_POST["fname"]) ||
            empty($_POST["studentID"]) ||
            empty($_POST["rdate"]) ||
            empty($_POST["email"]) ||
            empty($_POST["selection"]) ||
            empty($_POST["comments"])){
                echo error_msg();
            }
                else{
                    $sentData = "INSERT INTO students_t(lastName,
                firstName, studentID, regDate, email, selection, message)
                VALUES (\"".$lastName."\",\"".$firstName."\",\"".$StudentID."\"
                ,\"".$rgDate."\",\"".$email."\",\"".$selection."\",\"".$messages."\")";

                    if($DBconnect->query($sentData) === TRUE){
                        $alert_success = '<div class="alert alert-success" role="alert">Success!! You have submitted your registration</div>';
                        echo success_msg();

                    }

                    else{
                        echo "Error:" . $sentData."<br />".$DBconnect->error;
                        $DBconnect->close();
                        }
                    }
            }
            ?>


    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>
