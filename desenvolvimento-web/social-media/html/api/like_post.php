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
                $p = $_REQUEST['post_id'];
                $l = $_REQUEST['liked'];
                $result = $conn->query("UPDATE friendship_posts SET liked = $l WHERE fk_user_id = \"$u\" AND fk_post_id = \"$p\"");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
                };
                if ($l == 1) {
                    $result = $conn->query("UPDATE posts SET likes = likes + 1 WHERE post_id = \"$p\"");
                    if (!$result) {
                        $data=array("status"=>"400","message"=>"Error getting friendship");
                        break;
                    };
                }
                if ($l == 0) {
                    $result = $conn->query("UPDATE posts SET likes = likes - 1 WHERE post_id = \"$p\"");
                    if (!$result) {
                        $data=array("status"=>"400","message"=>"Error getting friendship");
                        break;
                    };
                }
                $data=array("status"=>"200","data"=>"Success updating friendship");
        }
        if ($data == null) {
            $data=array("status"=>"404","data"=>"they are not friends");
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