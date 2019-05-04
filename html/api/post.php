<?php

try{
    include '../database/connection.php';
    $method_name=$_SERVER["REQUEST_METHOD"];
    if($_SERVER["REQUEST_METHOD"])
    {
        switch ($method_name)
        {
            case 'POST':
                $u = $_REQUEST['user_id'];
                $p = $_REQUEST['post'];
                $i = $_REQUEST['image'];
                $result = $conn->query("INSERT INTO posts (fk_user_id, text, images) VALUES (\"$u\", \"$p\", \"$i\")");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error creating post");
                    break;
                }
                $result = $conn->query("SELECT post_id FROM posts WHERE fk_user_id = \"$u\" AND text = \"$p\" AND images = \"$i\" ");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error creating post");
                    break;
                }
                $post_id = $result->fetch_all()[0][0];
                $result2 = $conn->query("SELECT users.user_id FROM friendship AS f INNER JOIN users WHERE fk_user_1 = \"$u\" AND f.fk_user_2 = users.user_id OR fk_user_2 = \"$u\" AND f.fk_user_1 = users.user_id");
                if (!$result2) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
                }
                foreach ($result2->fetch_all() as $key => $value) {
                    $result3 = $conn->query("INSERT INTO friendship_posts (fk_post_id, fk_user_id) VALUES (\"$post_id\", \"$value[0]\")");
                    if (!$result3) {
                        $data=array("status"=>"400","message"=>"Error relation post and user");
                        break;
                    }
                }
                $data=array("status"=>"200","data"=>$post_id);
                break;
            case 'GET':
                $u = $_REQUEST['user_id'];
                $result = $conn->query("SELECT posts.post_id, posts.text, posts.images, posts.date, posts.fk_user_id, users.username, users.name FROM friendship_posts AS fp INNER JOIN posts INNER JOIN users WHERE fp.fk_user_id = \"$u\" AND fp.fk_post_id = posts.post_id AND posts.fk_user_id = users.user_id ORDER BY posts.date");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error creating post");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    $temp_cat[] = array("post_id"=>$value[0],"text"=>$value[1],"images"=>$value[2],"date"=>$value[3],"fk_user_id"=>$value[4],"username"=>$value[5],"user"=>$value[6]);
                }
                $data=array("status"=>"200","data"=>$temp_cat);
                break;
        }
        echo json_encode($data);
    }
    else{
        $data=array("status"=>"400","message"=>"Please enter proper request method !! ");
        echo json_encode($data);
    }

}
catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}