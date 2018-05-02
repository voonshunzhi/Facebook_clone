<?php
class User
{
    private $user;
    private $con;
    
    public function __construct($connection,$username)
    {
        $this -> con = $connection;
        $user_details_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
        $this -> user = mysqli_fetch_array($user_details_query);
        
    }
    
    public function getfistNameAndLastName()
    {
        return $this -> user['first_name'] . " " . $this -> user['last_name'];
    }
    
    public function getUsername()
    {
        return $this -> user['username'];
    }
    
    public function getPostCount()
    {
        return $this -> user['num_posts'];
    }
}
?>