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
                $result = $conn->query("SELECT users.username, users.name, users.user_id, users.photo FROM friendship AS f INNER JOIN users WHERE fk_user_1 = \"$u\" AND f.fk_user_2 = user_id");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
                }
                $result2 = $conn->query("SELECT users.username, users.name, users.user_id, users.photo FROM friendship AS f INNER JOIN users WHERE fk_user_2 = \"$u\" AND f.fk_user_1 = user_id");
                if (!$result2) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    $temp_cat[] = array("user_id"=>$value[2],"username"=>$value[0],"name"=>$value[1],"photo"=>$value[3]);
                }
                foreach ($result2->fetch_all() as $key => $value) {
                    $temp_cat[] = array("user_id"=>$value[2],"username"=>$value[0],"name"=>$value[1],"photo"=>$value[3]);;
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