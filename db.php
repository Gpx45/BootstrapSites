


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
        echo "<p>CREATING NEW DATABASE!</p>";
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
?>