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
    var username = $('#password').val();
    if(username != '' && password != ''){
      $.ajax({
        url:"action.php",
        method:"POST",
        data:{username:username, password:password},
        success:function(data){
          if(data == 'No'){
            alert("Wrong Login");
          }
          else{
            $('#loginModal').hide();
            location.replace("http://localhost/bootWeb/enrollment.php")

          }
        }
      });
    }
    else{
      alert("Both fields are required");
    }
  });
});


</script>


<?php
session_start();

$location = "localhost";
$user = "root";
$pass = "";
$dataBase = "tutoringsite";

$DBconnect = @new mysqli("$location",$user,$pass,$database);
if(isset($_POST["username"])){
  $sql = "SELECT * FROM admin_login
  WHERE admin_name = '".$_POST["username"]."'
  AND admin_password = '".$_POST["password"]."'
  ";
  $result = $DBconnect->query($sql);
  if(mysqli_num_rows($result) > 0){
    $_SESSION["username"] = $_POST["username"];
    echo yes;
  }
  else{
    echo "No";
  }
}
?>
