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
                $result = $conn->query("UPDATE friendship SET pending = \"0\"  WHERE fk_user_1 = \"$u\" AND fk_user_2 = \"$f\" OR fk_user_1 = \"$f\" AND fk_user_2 = \"$u\"");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
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