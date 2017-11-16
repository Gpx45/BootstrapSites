
<?php
session_start();

?>

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
            <div class="col-md-12 col-lg-12 navPad">

                <ul class="nav nav-tabs">
                <li role="presentation"  class="nav-item">
                <a class="nav-link active" href="/bootWeb/home.php">Home</a>
                </li>
                <li role="presentation" class="nav-item">
                <a class="nav-link" href="/bootWeb/tutor.php">Request Tutoring</a>
                </li>
                <li role="presentation"  class="nav-item">
                <a class="nav-link" href="/bootWeb/enrollment.php">Tutoring Enrollment</a>
                </li>
                <li role="presentation"  class="nav-item">
                <a class="nav-link" href="/bootWeb/search.php">Search</a>
                </li>
                </ul>

            </div>




            </div>
                <div class="row no-gutters"> <!--wrapper for main home column-->

                    <div class="col-md-7 col-lg-7">

                        <div class="homeMainDiv">
                            <img class="ajustImg img-fluid img-conf" src="images\students.jpg">
                        </div>

                    </div>

                    <div class="col-md-5 col-lg-5">
                        <div class="homeSideDiv">

                            <p class="lead weeklyT"><strong>Weekly News:</strong></p>

                            <p class="small text-center weekly">The Coding in Academics program is sponsored by the Crockett Foundation.
                                The program takes tales place at Broward College's North Campus.
                                The program serves students from local middle schools and provives coding classes.
                                The coding classes are taughtand monitored by a team consisting of Education Specialist,
                                and Coding Professors from Broward College. Students benefit from being exposed to a college campus
                                which will serve to inspire their future opportunities, increase their motivation to pursue post-secondary
                                education and training, and prompt them to start setting goals for their future early, at an age when these
                                decisions are critical to their success in life.
                                If you see news happening - Send us a Text and we will post it here.</p>

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


                      <div id="loginModal" class="modal fade" role="dialog">

              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control"/>
                    <br/>
                    <label>Password</label>
                    <input type="text" name="password" id="password" class="form-control"/>
                    <br />
                      <button type="button" name="login_button" id="login_button" class="btn btn-warning">Login</button>
                      </form>
                  </div>
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
                                   header("Location: http://localhost/bootWeb/enrollment.php");
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



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>
