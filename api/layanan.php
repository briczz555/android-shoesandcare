<?php

    require 'koneksi.inc';

    $response = array();

    $sql = "SELECT * FROM layanan";
    $stmt = $conn->query($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($stmt -> rowCount() > 0){
        foreach($result as $fetchData){
            $response['response'] = "Success";
            $response['data'][] = $fetchData;
        }
        echo json_encode($response);

    }else{
        $response[] = "There is no Data";
        echo json_encode($response);
    }



?>