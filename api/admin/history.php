<?php

    require '../koneksi.inc';

    $response = array();

    $sql = "SELECT id_transaksi, date_format(tgl_masuk,'%d-%m-%Y') as tgl_masuk, date_format(tgl_selesai,'%d-%m-%Y') as tgl_selesai, status, id_user, total_harga FROM transaksi";
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