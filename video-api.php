<?php

include_once 'config.php';

$conn = new mysqli($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name);

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $data = [];
    $data['data'] = [];

    if ($conn->connect_error) {
        $data['error'] = "Connection failed: " . $conn->connect_error;
        $data['status'] = 500;
        die("Connection failed: " . $conn->connect_error);
    } else {

        $query = "SELECT * FROM videos WHERE video_id = '$id'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($data['data'], $row);
            }
            $data['status'] = 200;
        } else {
            $data['error'] = "No videos found";
        }
    }

    echo json_encode($data);
}else{
    $data = [];
    $data['data'] = [];

    if ($conn->connect_error) {
        $data['error'] = "Connection failed: " . $conn->connect_error;
        $data['status'] = 500;
        die("Connection failed: " . $conn->connect_error);
    } else {

        $query = "SELECT * FROM videos";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($data['data'], $row);
            }
            $data['status'] = 200;
        } else {
            $data['error'] = "No videos found";
        }
    }

    echo json_encode($data);
}