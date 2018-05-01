<?php

    if(isset($_POST['logInButton']))
    {
        $email = strip_tags($_POST['logInEmail']);
        $password = strip_tags($_POST['logInPassword']);
        //Remove all illegal character from the email such as {|}!#/=$%*[]+-?^_`~&'@.
        $email = filter_var($email,FILTER_SANITIZE_EMAIL);
        
        //Remember the value of email in case log in failed
        $_SESSION['logInEmail'] = $email;
        $_SESSION['logInPassword'] = $password;
        
        $password = md5($password);
        
        $check_database_query = mysqli_query($con,"SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        
        $check_login_query = mysqli_num_rows($check_database_query);
         if($check_login_query == 1)
         {
             $row = mysqli_fetch_array($check_database_query);
             $username = $row['username'];
             $user_closed = $row['user_closed'];
             if($user_closed == 'yes')
             {
                 $reopen_account = mysqli_query($con,"UPDATE users SET user_closed = 'no' WHERE email = '$email'");
             }
             $_SESSION['username'] = $username;
             header("Location:index.php");
             exit();
         }
        else
        {
            array_push($errorArray,"Email or password are incorrect.<br>");
        }
    }







?>