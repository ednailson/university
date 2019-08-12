<?php

try{
    include '../database/connection.php';
    $method_name=$_SERVER["REQUEST_METHOD"];
    if($_SERVER["REQUEST_METHOD"])
    {
        switch ($method_name)
        {
            case 'POST':
                $c = $_REQUEST['comment'];
                $p = $_REQUEST['post_id'];
                $result = $conn->query("INSERT INTO comments (comment, fk_post_id_comment) VALUES (\"$c\", \"$p\")");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error adding friend");
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