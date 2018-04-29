<?php
    //Using session to remember the value of input 
    session_start();

    $con = mysqli_connect("localhost","root","Shunzhivoon112893332030","swirlfeed");
    if(mysqli_connect_errno())
    {
        //mysqli_connect_errno() - returns the error code if the connection to the database failed
        echo "Connection has failed".mysqli_connect_errno();
    }

    //Declaring variable to prevent errors
    $fname= " ";
    $lname= " ";
    $em= " ";
    $em2= " ";
    $pw= " ";
    $pw2= " ";
    $date = " ";
    $errorArray = [];

    if(isset($_POST['register_button']))
    {
        //Data Sanitization
        //Firstname
        $fname = strip_tags($_POST['reg_fname']);//Remove html tags
        $fname = str_replace(" ","",$fname);//Remove spaces
        $fname = ucwords(strtolower($fname));//Uppercase first letter
        $_SESSION['reg_fname'] = $fname;
        
        //Lastname
        $lname = strip_tags($_POST['reg_lname']);//Remove html tags
        $lname = str_replace(" ","",$lname);//Remove spaces
        $lname = ucwords(strtolower($lname));//Uppercase first letter
        $_SESSION['reg_lname'] = $lname;
        
        //Email
        $em = strip_tags($_POST['reg_email']);//Remove html tags
        $em = str_replace(" ","",$em);//Remove spaces
        $em = ucwords(strtolower($em));//Uppercase first letter
        $_SESSION['reg_email'] = $em;
        
        //Confirm email
        $em2 = strip_tags($_POST['reg_email2']);//Remove html tags
        $em2 = str_replace(" ","",$em2);//Remove spaces
        $em2 = ucwords(strtolower($em2));//Uppercase first letter
        $_SESSION['reg_email2'] = $em2;
        
        //Password 
        $pw = strip_tags($_POST['reg_password']);//Remove html tags
        $_SESSION['reg_password'] = $pw;
        
        //Confirm Password
        $pw2 = strip_tags($_POST['reg_password2']);//Remove html tags
        $_SESSION['reg_password2'] = $pw2;
        
        $date = date("Y-m-d");
        
        if($em == $em2)
        {
            if(filter_var($em,FILTER_VALIDATE_EMAIL))
            {
                $em = filter_var($em,FILTER_VALIDATE_EMAIL);
                
                //Check if email already exists
                $e_check = mysqli_query($con,"SELECT email FROM users WHERE email = '$em'");
                if(mysqli_num_rows($e_check) != 0)
                {
                    array_push($errorArray,"Email is already in use.<br>");
                }
                
            }
            else
            {
                array_push($errorArray,"Email is not valid.<br>");
            }
        }
        else
        {
            array_push($errorArray,"Email doesn't match.<br>");
        }
        
        if(strlen($fname) > 25 || strlen($fname) < 2)
        {
             array_push($errorArray,"Your firstname must be between 2 and 25 characters.<br>");
        }
        
        if(strlen($lname) > 25 || strlen($lname) < 2)
        {
             array_push($errorArray,"Your lastname must be between 2 and 25 characters.<br>");
        }
        
        if($pw != $pw2)
        {
            array_push($errorArray,"Your password doesn't match.<br>");
        }
        else
        {
            if(preg_match('/[^A-Za-z0-9]/',$pw))
            {
                array_push($errorArray, "Your password can only contain english character and letter.<br>");
            }
        }
        
        if(strlen($pw) > 30 || strlen($pw) < 5)
        {
            array_push($errorArray,"Your password must be between 5 and 30 characters.<br>"); 
        }
        
        if(empty($errorArray))
        {
            $pw = md5($pw);//Encrypt the password
            
            //Generate username by concatenating firstname and lastname
            $username = strtolower($fname . "_" . $lname);
            $check_username_query = mysqli_query($con,"SELECR FROM users WHERE username = '$username'");
            
            $i=0;
            //If username exists already, add number to the username
            while(mysqli_num_rows($check_username_query) != 0)
            {
                $i++;
                $username = $username . "_" . $i;
                $check_username_query = mysqli_query($con,"SELECR FROM users WHERE username = '$username'");
            }
            
            //Profile picture assignment
            $random = rand(1,2);//Generate a random integer between 1 and 2
            if($random == 1)
            {
                $profile_pic = "assets/images/profile_pics/defaults/green_profile_pic.png";
            }
            else if($random ==2)
            {
                $profile_pic = "assets/images/profile_pics/defaults/red_profile_pic.png";
            }
            
            $query = mysqli_query($con,"INSERT INTO users VALUES('','$fname','$lname','$username','$em','$pw','$date','$profile_pic',0,0,'no',',')");
            
            array_push($errorArray,"<span style='color:#282828'>You're all set! Go ahead!</span><br>");
            
            //Clear session variable by unsetting all the session:
            session_unset();
        }
        
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Swirlfeed!</title>
</head>
<body>
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
        
    </form>
</body>
</html>