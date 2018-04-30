<?php
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