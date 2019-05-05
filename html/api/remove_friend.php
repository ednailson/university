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
                $f = $_REQUEST['user_friend'];
                $result = $conn->query("DELETE FROM friendship WHERE fk_user_1 = \"$u\" AND fk_user_2 = \"$f\" OR fk_user_1 = \"$f\" AND fk_user_2 = \"$u\";");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error removing friendship");
                    break;
                }
                $result = $conn->query("SELECT post_id FROM posts WHERE fk_user_id = \"$u\"");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error adding friend");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    echo "v", $value[0];
                    $r = $conn->query("DELETE FROM friendship_posts WHERE fk_post_id = \"$value[0]\" AND fk_user_id = \"$f\"");
                }
                $result = $conn->query("SELECT post_id FROM posts WHERE fk_user_id = \"$f\"");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error adding friend");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    $r = $conn->query("DELETE FROM friendship_posts WHERE fk_post_id = \"$value[0]\" AND fk_user_id = \"$u\"");
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