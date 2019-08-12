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
                $e = $_REQUEST['email'];
                $n = $_REQUEST['name'];
                $i = $_REQUEST['image'];
                $result = $conn->query("INSERT INTO users (username, password, email, name, photo) VALUES (\"$u\", \"$p\", \"$e\", \"$n\", \"$i\")");
                if (!$result) {
                    $data=array("status"=>"400","message"=>"Username or email already exists.");
                    break;
                }
                $data=array("status"=>"200","data"=>"Successful registration");
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