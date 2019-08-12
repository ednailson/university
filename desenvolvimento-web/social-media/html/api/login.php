<?php

try{
    include '../database/connection.php';
    $method_name=$_SERVER["REQUEST_METHOD"];
    if($_SERVER["REQUEST_METHOD"])
    {
        switch ($method_name)
        {
            case 'POST':
                $u = $_REQUEST['username'];
                $p = $_REQUEST['password'];
                $result = $conn->query("SELECT * FROM users WHERE username = \"$u\" AND password = \"$p\"");
                if (!$result) {
                    $data=array("status"=>"404","message"=>"not found!");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    $temp_cat = array("user_id"=>$value[0],"username"=>$value[1],"photo"=>$value[4],"email"=>$value[3]);
                }
                $data=array("status"=>"200","data"=>$temp_cat);
                break;
        }
        echo json_encode($data);
    }
    else{
        $data=array("status"=>"0","message"=>"Please enter proper request method !! ");
        echo json_encode($data);
    }

}
catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}