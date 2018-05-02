<?php
class Post
{
    private $user_obj;
    private $con;
    
    public function __construct($connection,$username)
    {
        $this -> con = $connection;
        $this -> user_obj = new User ($connection,$username);
        
    }
    
    public function submitPost($body,$user_to)
    {
        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this -> con,$body);
        $check_empty = preg_replace('/\s+/','',$body);//Delete all spaces and return the $body string
        
        if($check_empty != " ")
        {
            //Current date and time
            $date_added = date("Y-m-d H:i:s");
            
            //Get username
            $added_by = $this -> user_obj -> getUsername();
            
            //If user is on own profile, the user_to is none
            if($user_to == $added_by)
            {
                $user_to = "none";
            }
            
            //Insert post
            $query = mysqli_query($this -> con,"INSERT INTO posts VALUES('','$body','$added_by','$user_to','$date_added','no','no',0)");
            
            //Get the id of the inserted post
            $returned_id = mysqli_insert_id($this -> con);
            
            //Insert notification
            
            //Update post count for user
            $num_posts = $this -> user_obj -> getPostCount();
            $num_posts++;
            $update_query = mysqli_query($this -> con, "UPDATE users SET num_posts = $num_posts WHERE username = '$added_by'");
        }
    }
}
?>