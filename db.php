
  <?php
    $location = "localhost";
    $user = "root";
    $pass = "";
    $dataBase = "tutoringsite";
    $ErrorMsg = array();
    $DBconnect = @new mysqli("$location",$user,$pass,$dataBase);

    if($DBconnect->connect_errno){
        $ErrorMsg[] = "The Database Server is not available.";
        foreach($ErrorMsg as $msg){
            echo "<p>" . $msg . "</p>\n";

        };

        $DBconnect = @new mysqli("$location",$user,$pass);

        $sql = "CREATE DATABASE "."$dataBase";
        $DBconnect->query($sql);

        $DBconnect = @new mysqli("$location",$user,$pass,$dataBase);
        $sql = "
        CREATE TABLE students_t
        ( sID INT AUTO_INCREMENT,
        lastName VARCHAR(255) NOT NULL,
        firstName VARCHAR(255) NOT NULL,
        studentID VARCHAR(9) NOT NULL,
        regDate date NOT NULL,
        email VARCHAR(255) NOT NULL,
        selection VARCHAR(255) NOT NULL,
        message VARCHAR(255) NOT NULL,
        PRIMARY KEY(sID, studentID) )";
        $DBconnect->query($sql);

        $sql = "CREATE TABLE admin_login (
	         admin_id INT PRIMARY KEY,
	          admin_name VARCHAR(10),
	           admin_password VARCHAR(10));";
        $DBconnect->query($sql);
        $sql = "INSERT INTO `admin_login`(admin_name, admin_password)
        VALUES ('admin','pass')";
        $DBconnect->query($sql);
        echo success_db();

    }
    else{
        $Result = @$DBconnect->select_db($dataBase);
        if($Result === FALSE){
            echo "<p>Unable to select the database.</p>"
            . $DBconnect->errno.": " . $DBconnect->error."\n";
        }

    };


    function success_msg(){
        $alert_success = '<div class="container">
        <div class="alert alert-success alert" id="myAlert">

          <strong>Great!</strong> You have successfully registered!
        </div>
      </div>';
        return $alert_success;
    };

    function error_msg(){
        $alert_error = '<div class="container">
        <div class="alert alert-danger alert" id="myAlert">

          <strong>I\'m sorry</strong> Please Enter All fields.
        </div>
      </div>';
        return $alert_error;
    };

    function success_db(){
        $alert_success = '<div class="container">
        <div class="alert alert-success alert" id="myAlert">

          <strong>Great!</strong> You have successfully created a database!
        </div>
      </div>';
        return $alert_success;
    };
?>
