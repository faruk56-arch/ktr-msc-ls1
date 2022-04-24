<?php
// Include config file
require_once "functions.php";
 
// Define variables and initialize with empty values
$name = $email = $company = $telephone =  $password = $cpassword = "";
$name_err = $password_err = $cpassword_err = "";


 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))){
        $name_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM tests WHERE name = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $name, $email,$company, $telephone, $password, $cpassword);
            
            // Set parameters
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $company = trim($_POST["company"]);
            $telephone =trim($_POST["telephone"]);
            $password = trim($_POST["password"]);
            $cpassword = trim($_POST["cpassword"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $name_err = "This name is already taken.";
                } else{
                    $name = trim($_POST["name"]);
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
    if(empty(trim($_POST["cpassword"]))){
        $cpassword_err = "Please confirm password.";     
    } else{
        $cpassword = trim($_POST["cpassword"]);
        if(empty($password_err) && ($password != $cpassword)){
            $cpassword_err = "Password did not match.";
        }
    }
    


    // Check input errors before inserting in database
    if(empty($name_err) && empty($password_err) && empty($cpassword_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO tests (name, email, company, telephone, password, cpassword) VALUES ($name, $email, $company, $telephone, $password, $cpassword)";
         


        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $name, $email, $company, $telephone, $password, $cpassword);
            
            // Set parameters
            $name = $name;
            $email = $email;
            $company = $company;
            $telephone = $telephone;
            $password = $password;
            $cpassword = $cpassword;
            // $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: Connection.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connectionS
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Se Connécter</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class='box'>
        <div class='box-form'>
            <div class='box-login-tab'></div>
            <div class='box-login-title'>
                <div class='i i-login'></div>
                <h2>Create Profile</h2>
            </div>
            <div class='box-login'>
                <div class='fieldset-body' id='login_form'>
                    <button onclick="openLoginInfo();" class='b b-form i i-more' title='Mais Informações'></button>
                    <form method="POST">
                        <p class='field'>
                            <label for='name'>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"></span>
                        </p>
                        <p class='field'>
                            <label for='email'>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"></span>
                        </p>
                        <p class='field'>
                            <label for='company'>Company</label>
                            <input type="text" name="company" class="form-control" value="<?php echo $company; ?>">
                            <span class="invalid-feedback"></span>
                        </p>
                        <p class='field'>
                            <label for='telephone'>Telephone</label>
                            <input type="text" name="telephone" class="form-control" value="<?php echo $telephone; ?>">
                            <span class="invalid-feedback"></span>
                        </p>

                        <p class='field'>
                            <label for='password'>Password</label>
                            <input type="password" name="password" class="form-control"
                                value="<?php echo $password; ?>">
                            <span class="invalid-feedback"></span>
                        </p>

                        <p class='field'>
                            <label for='cpassword'>Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control"
                                value="<?php echo $cpassword; ?>">
                            <span class="invalid-feedback"></span>
                        </p>

                        <input type='submit' id='do_login' value='Inscription' title='Login' />
                    </form>
                </div>
            </div>
        </div>
        <div class='box-info'>
            <p><button onclick="closeLoginInfo();" class='b b-info i i-left' title='Back to Sign In'></button>
            <h3>Bienvenue sur notre app?</h3>
            </p>
            <div class='line-wh'></div>
            <button onclick="" class='b-support' title='Contact Support'> Support</button>
            <div class='line-wh'></div>
            <button onclick="" class='b-cta' title='Sign up now!'><a href="Connection.php">Se Connécter</a></button>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $("#do_login").click(function () {
                closeLoginInfo();
                $(this).parent().find('span').css("display", "none");
                $(this).parent().find('span').removeClass("i-save");
                $(this).parent().find('span').removeClass("i-warning");
                $(this).parent().find('span').removeClass("i-close");

                var proceed = true;
                $("#login_form input").each(function () {

                    if (!$.trim($(this).val())) {
                        $(this).parent().find('span').addClass("i-warning");
                        $(this).parent().find('span').css("display", "block");
                        proceed = false;
                    }
                });

                if (proceed) //everything looks good! proceed...
                {
                    $(this).parent().find('span').addClass("i-save");
                    $(this).parent().find('span').css("display", "block");
                }
            });

            //reset previously results and hide all message on .keyup()
            $("#login_form input").keyup(function () {
                $(this).parent().find('span').css("display", "none");
            });

            openLoginInfo();
            setTimeout(closeLoginInfo, 1000);
        });

        function openLoginInfo() {
            $(document).ready(function () {
                $('.b-form').css("opacity", "0.01");
                $('.box-form').css("left", "-37%");
                $('.box-info').css("right", "-37%");
            });
        }

        function closeLoginInfo() {
            $(document).ready(function () {
                $('.b-form').css("opacity", "1");
                $('.box-form').css("left", "0px");
                $('.box-info').css("right", "-5px");
            });
        }

        $(window).on('resize', function () {
            closeLoginInfo();
        });

    </script>


</body>

</html>