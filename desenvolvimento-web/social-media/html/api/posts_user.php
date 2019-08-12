<?php

try{
    include '../database/connection.php';
    $method_name=$_SERVER["REQUEST_METHOD"];
    if($_SERVER["REQUEST_METHOD"])
    {
        switch ($method_name)
        {
            case 'GET':
                $u = $_REQUEST['user_id'];
                $result = $conn->query("SELECT posts.post_id, posts.text, posts.images, posts.date, posts.fk_user_id, users.username, users.name FROM posts INNER JOIN users WHERE posts.fk_user_id = \"$u\" AND posts.fk_user_id = users.user_id ORDER BY posts.date");
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