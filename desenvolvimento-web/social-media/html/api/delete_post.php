<?php

try{
    include '../database/connection.php';
    $method_name=$_SERVER["REQUEST_METHOD"];
    if($_SERVER["REQUEST_METHOD"])
    {
        switch ($method_name)
        {
            case 'POST':
                $p = $_REQUEST['post_id'];
                $result = $conn->query("DELETE FROM friendship_posts WHERE fk_post_id = \"$p\";");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error removing post");
                    break;
                }
                $result = $conn->query("DELETE FROM comments WHERE fk_post_id_comment = \"$p\";");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error removing post");
                    break;
                }
                $result = $conn->query("DELETE FROM posts WHERE post_id = \"$p\";");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error removing post");
                    break;
                }
                $data=array("status"=>"200","data"=>"Success removing friendship");
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