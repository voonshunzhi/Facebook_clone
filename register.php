<?php
    
    require "config/config.php";
    require "include/register_handler.php";
    require "include/login_handler.php";

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Swirlfeed!</title>
    <link rel="stylesheet" href="assets/css/register_style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
 <?php
    if(isset($_POST['register_button']))
    {
        echo 
        '<script>
            $("document").ready(function(){
            $(".first").hide();
            $(".second").show();
        });
        </script>';
    }
    else
    {
        echo 
        '<script>$("document").ready(function(){
            $(".second").hide();
            $(".first").show();
        });
        </script>';
    }
    ?>
  <div id="background">
      <div class="logIn_box">
          <div class="logIn_header">
              <h1>Swirlfeed!</h1>
              <p>Log in or Sign up below!</p>
          </div>
        <div class="first">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
           <input type="email" name="logInEmail" placeholder="Email Address" value="<?php if(isset($_SESSION['logInEmail'])){echo $_SESSION['logInEmail'];}?>" required>
           <br>
           <input type="password" name="logInPassword" placeholder="Password" required>
           <br>
           <!--Displaying the error statement      -->
            <?php if(in_array("Email or password are incorrect.<br>",$errorArray)){echo "Email or password are incorrect.<br>";}?>
           <input type="submit" value="LOG IN" name="logInButton">
           <br>
           <br>
           <a href="#" id="register">Need an account?Register here</a>
       </form>
          </div>
       <div class="second" style="display:none">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <input type="text" name="reg_fname" placeholder="First name" value="<?php if(isset($_SESSION['reg_fname']))
            {
                echo $_SESSION['reg_fname'];
            }?>" required>
            <br>
            <!--Displaying the error statement      -->
            <?php if(in_array("Your firstname must be between 2 and 25 characters.<br>",$errorArray)){echo "Your firstname must be between 2 and 25 characters.<br>";}?>

            <input type="text" name="reg_lname" placeholder="Last name" value="<?php if(isset($_SESSION['reg_lname']))
            {
                echo $_SESSION['reg_lname'];
            }?>" required>
            <br>
            <!--Displaying the error statement      -->
            <?php if(in_array("Your lastname must be between 2 and 25 characters.<br>",$errorArray)){echo "Your firstname must be between 2 and 25 characters.<br>";}?>

            <input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email']))
            {
                echo $_SESSION['reg_email'];
            }?>" required>
            <br>
            <!--Displaying the error statement      -->
            <?php if(in_array("Email is already in use.<br>",$errorArray)){echo "Email is already in use.<br>" ;}?>
            <?php if(in_array("Email is not valid.<br>",$errorArray)){echo "Email is not valid.<br>";}?>
            <?php if(in_array("Email doesn't match.<br>",$errorArray)){echo "Email doesn't match.<br>" ;}?>

            <input type="email" name="reg_email2" placeholder="Confirm email" value="<?php if(isset($_SESSION['reg_email2']))
            {
                echo $_SESSION['reg_email2'];
            }?>" required>
            <br>

            <input type="password" name="reg_password" placeholder="Password" value="<?php if(isset($_SESSION['reg_password']))
            {
                echo $_SESSION['reg_password'];
            }?>" required>
            <br>
            <!--Displaying the error statement      -->
            <?php if(in_array("Your password doesn't match.<br>",$errorArray)){echo "Your password doesn't match.<br>";}?>
            <?php if(in_array("Your password can only contain english character and letter.<br>",$errorArray)){echo "Your password can only contain english character and letter.<br>";}?>
            <?php if(in_array("Your password must be between 5 and 30 characters.<br>",$errorArray)){echo "Your password must be between 5 and 30 characters.<br>";}?>

            <input type="password" name="reg_password2" placeholder="Confirm Password" value="<?php if(isset($_SESSION['reg_password2']))
            {
                echo $_SESSION['reg_password2'];
            }?>" required>
            <br>

            <input type="submit" name="register_button" value="REGISTER NOW!">
            <br>
            <?php if(in_array("<span style='color:#282828'>You're all set! Go ahead!</span><br>",$errorArray)){echo "<span style='color:#282828'>You're all set! Go ahead!</span><br>" ;}?>
            <br>
           <a href="#" id="login">Have an account already?Log In here!</a>

        </form>
          </div>
          </div>
    </div>
</body>
</html>