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
//                $f = $_REQUEST['user_friend'];
                $result = $conn->query("SELECT * FROM friendship WHERE fk_user_1 = \"$u\" OR fk_user_2 = \"$u\"");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    if ($value[1] == $u) {
                        $r = $conn->query("SELECT users.username, users.name, users.user_id, users.photo FROM users WHERE user_id = \"$value[2]\";");
                        if (!$r) {
                            $data=array("status"=>"400","message"=>"Error getting friendship");
                            break;
                        }
                        foreach ($r->fetch_all() as $key2 => $value2) {
                        $temp_cat[] = array("friendship_pending"=>($value[3] == 0) ? false : true, "user_logged_asked"=>true,"username"=>$value2[0],"name"=>$value2[1],"user_id"=>$value2[2],"photo"=>$value2[3]);
                        }
                    }
                    if ($value[2] == $u) {
                        $r = $conn->query("SELECT users.username, users.name, users.user_id, users.photo FROM users WHERE user_id = \"$value[1]\";");
                        if (!$r) {
                            $data=array("status"=>"400","message"=>"Error getting friendship");
                            break;
                        }
                        foreach ($r->fetch_all() as $key2 => $value2) {
                            $temp_cat[] = array("friendship_pending"=>($value[3] == 0) ? false : true, "user_logged_asked"=>false,"username"=>$value2[0],"name"=>$value2[1],"user_id"=>$value2[2],"photo"=>$value2[3]);
                        }
                    }
                }
                $data=array("status"=>"200","data"=>$temp_cat);
                break;
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