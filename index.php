<?php
    include "include/header.php";
    include "include/classes/User.php";
    include "include/classes/Post.php";

    if(isset($_POST['post_button']))
    {
        $post = new Post($con,$userLoggedIn);
        $post -> submitPost($_POST['post_text'],'none');
    }
?>
<div class="wrapper">
<div class="user_details column">
   <div class="user_details_left_right">
    <a href="<?php echo $userLoggedIn; ?>">
        <img src="<?php echo $array['profile_pic']?>" alt="profile_pic" >
    </a>
    <div class="likeAndPost">
    <a href="<?php echo $userLoggedIn; ?>">
        <?php
            echo $array['first_name'] . " " . $array['last_name'];
        ?>
    </a>
    <?php
        echo "Likes : " . $array['num_likes'] . "<br>";
        echo "Posts : " . $array['num_posts'];
    ?>
    </div>
</div>
</div>

    <div class="main_column column">
       <div class="form">
        <form class="post_form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        
        <textarea name="post_text" placeholder="Got Something to say? Write a post!"></textarea>
        <input type="submit" name="post_button" value="Post It!">
            
        </form>
         
         <?php
           $user = new User($con,'jared_james');
           echo $user -> getfistNameAndLastName();
           
           ?>
        
        
        </div>
    </div>
</div>
</body>
</html>