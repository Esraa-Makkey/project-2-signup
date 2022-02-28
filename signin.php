
<html>
    <head>
    <title>sign in </title>
    </head>
    <body>
        <div class = "container">
            <h2>Sign In</h2>
            <p>Please fill in your credintials to login . </p>
            <form method = "post">
                <div class = "form-group">
                    <label>user name</label>
                    </br>
                    <input type="text" name="username" class="form-control ">
                </div>
                <div class = "form-group">
                    <label>Password</label>
                    </br>
                    <input type="password" name="password" class="form-control">
                </div>
                </br>
                <div class="form-group">
                    <button name = "submit"  type= "submit" value= "submit" >login in </button> 
                   
                </div>
                <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
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
 
// Define variables and initialize with empty values
$username = $password = "";

// Processing form data when form is submitted
$username = $_SERVER [ "username"];
$password = $_SERVER["password"];
                            
 // Store data in session variables
$_SESSION["loggedin"] = true;
$_SESSION["id"] = $id;
$_SESSION["username"] = $username; 
if(!empty($username) && !empty($password)){
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM customers WHERE username = ?";
}
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
    }

    // Set parameters
    $param_username = $username;
            
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Store result
        mysqli_stmt_store_result($stmt);
        
        // Check if username exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){                    
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($password, $hashed_password)){
                    // Password is correct, so start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;                            
                    
                    // Redirect user to welcome page
                    header("location: welcome.php");
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}                         
    // Close connection
    mysqli_close($link);
}
?>
    </body>
</html>