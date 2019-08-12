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
                $result = $conn->query("SELECT friendship.pending FROM friendship WHERE fk_user_1 = \"$u\" AND fk_user_2 = \"$f\"");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    $temp_cat = array("friendship_pending"=>($value[0] == 0) ? false : true, "user_logged_asked"=>true);
                    $data=array("status"=>"200","data"=>$temp_cat);
                    break;
                }
                $r = $conn->query("SELECT friendship.pending FROM friendship WHERE fk_user_1 = \"$f\" AND fk_user_2 = \"$u\"");
                if (!$r) {
                    $data=array("status"=>"400","message"=>"Error getting friendship");
                    break;
                }
                foreach ($r->fetch_all() as $key => $value) {
                    $temp_cat = array("friendship_pending"=>($value[0] == 0) ? false : true, "user_logged_asked"=>false);
                    $data=array("status"=>"200","data"=>$temp_cat);
                    break;
                }
//                if ($r->num_rows && $result->num_rows == 0) {
//                    $data=array("status"=>"404","data"=>"they are not friends");
//                    break;
//                }
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