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
                $result = $conn->query("INSERT INTO posts (fk_user_id, text) VALUES (\"$u\", \"$p\")");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error creating post");
                    break;
                }
                $data=array("status"=>"200","data"=>"Successful post registration");
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