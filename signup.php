
<html>
    <head>
    <title> sign up</title>
    </head>
    <body>
        <div class = "container" >
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>
            <form  method="post">
                <div class = "form-group">
                    <label>user name</label>
                    </br>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class = "form-group">
                    <label>Password</label>
                    </br>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class = "form-group">
                    <label> confirm Password</label>
                    </br>
                    <input type="password" name="password" class="form-control">
                </div>
                </br>
                <div class="form-group">
                    <button name= "submit" type= "submit" value= "submit">submit </button>
                    <a href = "#"><input type="reset" class="btn btn-secondary ml-2" value="Reset"></a>
                </div>
                <p>Already have an account? <a href="signin.php" target ="_blank">Login here</a>.</p>
            </form>
        </div> 
<?php
// Initialize the session
session_start();

                if(isset($_POST['submit']))
                {
                    //connect on database
                        $dbhost = 'localhost';
                        $dbuser = 'root';
                        $dbpass = '';
                        $dbname ='try';
                    $link = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
                
                    // Check connection
                    if(!$link)
                    {
                        die("ERROR: Could not connect. " . mysqli_connect_error());
                    }
                    $name = $_POST ['username'];
                    $password = $_POST ['password'];
                    $confirm_password = $_POST['password'];
                    $sql = "insert into customers (u_id , u_name , u_password ) VALUES ('0', '$name', '$password')";
                    $rs = mysqli_query($link, $sql);
                                if($rs)
                                {
                                    echo "Successfully saved";
                                
                                }
                                // Define variables and initialize with empty values
$username = $password = "";

 
// Processing form data when form is submitted
$username = $_SERVER [ "username"];
$password = $_SERVER["password"];
                            
 // Store data in session variables
$_SESSION["loggedin"] = true;
$_SESSION["id"] = $id;
$_SESSION["username"] = $username;   
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: signin.php");
    exit;
}    
                                 //connection closed.
                                mysqli_close($link);
                }
                
                 
                
?>
    </body>
</html>