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
            case 'GET':
                $u = $_REQUEST['user_id'];
                $result = $conn->query("SELECT * FROM posts WHERE fk_user_id = \"$u\" ORDER BY date");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Error creating post");
                    break;
                }
                foreach ($result->fetch_all() as $key => $value) {
                    $temp_cat[] = array("post_id"=>$value[0],"text"=>$value[1],"images"=>$value[2],"date"=>$value[3]);
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