
<?php
// Include config file
require_once 'model/AbstractDB.php';

if (!isset($_SERVER["HTTPS"])) {
    $base_url = BASE_URL;
    header("location: https://" . $_SERVER["HTTP_HOST"] . $base_url . "/register");
}
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $typeOfUser = $streetAddress = $numberAddress = $postNumber = "";
$username_err = $password_err = $confirm_password_err = $typeOfUser_err= $streetAddress_err =  "";

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'ep');
define('DB_NAME', 'onlinestore');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    if(empty(trim($_POST["streetAddress"]))){
        $streetAddress_err = "Please enter your address";
    }
    else $streetAddress = trim($_POST["streetAddress"]);
    if(empty(trim($_POST["numberAddress"]))){
        $streetAddress_err = "Please enter your address";
    }
    else $numberAddress = trim($_POST["numberAddress"]);
    if(empty(trim($_POST["postNumber"]))){
        $streetAddress_err = "Please enter your address";
    }
    else $postNumber = trim($_POST["postNumber"]);
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($typeOfUser_err) && empty($streetAddress_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, typeOfUser, streetAddress, numberAddress, postNumber) VALUES (?, ?, ?, ?, ?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssdd", $param_username, $param_password, $param_typeOfUser, $param_streetAddress, $param_numberAddress, $param_postNumber);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_typeOfUser = 'B';
            $param_streetAddress = $streetAddress;
            $param_numberAddress = $numberAddress;
            $param_postNumber = $postNumber;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div
            <div class="form-group">
                <label>Address and post number</label>
                <input type="text" name="streetAddress" placeholder ="Street" class="form-control <?php echo (!empty($streetAdress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $streetAddress; ?>">
                <input type="text" name="numberAddress" placeholder ="House number" class="form-control <?php echo (!empty($streetAddress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $numberAddress; ?>">
                <input type="text" name="postNumber" placeholder = "Post number" class="form-control <?php echo (!empty($streetAddress_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $postNumber; ?>">
                <span class="invalid-feedback"><?php echo $streetAddress_err; ?></span>
                
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
