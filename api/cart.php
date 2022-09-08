<?php

    require 'koneksi.inc';

    $response = array();

    $getIdUser = $_GET['iIdUser'];

    $sql = "SELECT c.id_cart as id_cart, c.id_user as id_user, c.id_layanan as id_layanan, l.nama as nama_layanan, c.id_jenis as id_jenis, j.nama as nama_jenis, c.harga as harga
            FROM cart as c
            INNER JOIN layanan as l
            ON c.id_layanan = l.id_layanan
            INNER JOIN jenis as j
            ON c.id_jenis = j.id_jenis
            WHERE c.id_user = $getIdUser";
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
        $response['response'] = "Success 2";
            $response['data'][] = "Tidak ada data";
        echo json_encode($response);
    }



?>