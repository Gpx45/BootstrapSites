<?php
session_start();
 ?>

<!doctype html>
<html lang="en">

<?php

    $lastName = "";
    $firstName = "";
    $StudentID = "";
    $rgDate = "";
    $email = "";
    $selection = "";
    $messages = "";
    // current test
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    };


    $lastNameErr = "";
    $firstNameErr = "";
    $StudentIDErr = "";
    $dateErr = "";
    $emailErr = "";
    $selectionErr = "";
    $messagesErr = "";

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
            //$rgDate = isItReal($rgDate);

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
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
                <a class="nav-link" href="/victorMartinsFinal/home.php">Home</a>
                </li>
                <li role="presentation" class="nav-item">
                <a class="nav-link active" href="/victorMartinsFinal/tutor.php">Request Tutoring</a>
                </li>
                <li role="presentation"  class="nav-item">
                <a class="nav-link" href="/victorMartinsFinal/enrollment.php">Tutoring Enrollment</a>
                </li>
                <li role="presentation"  class="nav-item">
                <a class="nav-link" href="/victorMartinsFinal/search.php">Search</a>
                </li>
                </ul>
            </div>
        </div>

<div class="row no-gutters"> <!--wrapper for main home column-->

<div class="col-md-8 col-lg-8">
  <div class="homeMainDiv2">
  <div class="col-md-9 col-lg-9 ">
  <div>

  <br />




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
      unset($_POST);
      }
      else{
        echo "Error:" . $sentData."<br />".$DBconnect->error;
        $DBconnect->close();
        }
      }
    }
  ?>




  <?php
  $date = date('m/d/Y', time());
  ?>
  <p class="p-adjust"><b>Yes!</b> I am interested in receiving some
  tutoring. Today's Date: <b><?php echo $date;?></b>
  </p>

  <form method="post" action="<?php echo htmlspecialchars
      ($_SERVER["PHP_SELF"]);?>"
      target="_self" name="submit-form">

          <div class="form-group">

              <div class="col-10">
                  <input type="text" class="form-control" name="lname"
                  placeholder="Last Name" pattern="[A-Za-z]*\D*"
                  title="Please Enter a Alphanumric Name"
                  value="<?php if(isset($_POST['lname'])){echo $_POST['lname'];}?>">
              </div>
          </div>

          <div class="form-group">
              <div class="col-10">
                  <input type="text" class="form-control" name="fname"
                  placeholder="First Name" pattern="[A-Za-z]*\D*"
                  title="Please Enter a Alphanumric Name"
                  value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];}?>">
              </div>
          </div>

          <div class="form-group">
              <div class="col-10">
                  <input type="text" class="form-control" name="studentID"
                  placeholder="Student ID" pattern="[A-Z]{1}[0-9]{8}"
                  title="Please Enter a Capital Letter and 8 Numbers"
                  value="<?php if(isset($_POST['studentID'])){echo $_POST['studentID'];}?>">
              </div>
          </div>

          <div class="form-group">
          <label for="date">When(Enter a date after 2000-01-01): </label>
              <div class="col-10">
                  <input type="date" class="form-control" name="rdate"
                  value="<?php if(isset($_POST['rdate'])){echo $_POST['rdate'];}?>">
              </div>
          </div>

          <div class="form-group row side-a-bit">
              <div class="col-10 ">
                  <input class="form-control" type="email" placeholder="johndoe@example.com" name="email"
                  pattern="^([a-zA-Z0-9_\-\.]+)[@]([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]\.(com)(net)(edu)"
                  value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
              </div>
          </div>

          <label class="mr-sm-2" for="selection">Discipline</label>
          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="selection">
              <option disabled selected>Choose...</option>
              <option value="Algebra">Algebra</option>
              <option value="Biology">Biology</option>
              <option value="Calculus">Calculus</option>
              <option value="Programming">Programming</option>
          </select>

          <div class="form-group">
          <label for="comments">Comments:</label>
          <textarea class="form-control" rows="5"
           name="comments"> <?php if (isset($_POST['comments'])) {echo $_POST['comments'];} ?></textarea>
          </div>

          <hr>
          <div class="bttnFree">
          <button type="reset" class="btn btn-outline-danger">CLEAR</button>
          <button id="submitButton" type="submit" name="submitButton" class="btn btn-outline-primary">Submit</button>


      </div>

  </form>
  </div>
  </div>
  </div>
</div>

  <div class="col-md-4 col-lg-4">
    <div class="homeSideDiv2">

    <p class="lead weeklyT down-a-bit"><strong><b>Quote of the day</b></strong></p>
    <blockquote class="blockquote">
    <p class="small text-center weekly blockquote">
    "Often it isn't the mountains ahead that wear you out,
    its the little pebbie in your shoe." </p>
    <img src="images\ma.jpg" class="img-fluid headPadding">
    <footer class="blockquote-footer headPadding">Muhammad Ali <cite title="Source Title"></cite></footer>
    </blockquote>

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




  <div id=loginModal class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label>Username</label>
          <input type="text" name="username" id="username" class="form-control"/>
          <br/>
          <label>Password</label>
          <input type="text" name="password" id="password" class="form-control"/>
          <br />
            <button type="button" name="login_button" id="login_button" class="btn btn-warning">Login</button>
        </div>
      </div>
    </div>
  </div>



  <script>
   $(document).ready(function(){
        $('#login_button').click(function(){
             var username = $('#username').val();
             var password = $('#password').val();
             if(username != '' && password != '')
             {
                  $.ajax({
                       url:"action.php",
                       method:"POST",
                       data: {username:username, password:password},
                       success:function(data)
                       {
                            //alert(data);
                            if(data == 'No')
                            {
                                 alert("Wrong Data");
                            }
                            else
                            {
                                 $('#loginModal').hide();
                                 location.reload();
                            }
                       }
                  });
             }
             else
             {
                  alert("Both Fields are required");
             }
        });
        $('#logout').click(function(){
             var action = "logout";
             $.ajax({
                  url:"action.php",
                  method:"POST",
                  data:{action:action},
                  success:function()
                  {
                       location.reload();
                  }
             });
        });
   });
   </script>




</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>
