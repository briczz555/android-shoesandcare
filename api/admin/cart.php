<?php

    require '../koneksi.inc';

    $response = array();

    $getIdTransaksi = $_GET['iIdTransaksi'];

    $sql = "SELECT td.id_transaksi_detail as id_transaksi_detail, td.id_layanan as id_layanan, l.nama as nama_layanan, td.id_jenis as id_jenis, j.nama as nama_jenis, td.harga as harga
            FROM transaksi_detail as td
            INNER JOIN layanan as l
            ON td.id_layanan = l.id_layanan
            INNER JOIN jenis as j
            ON td.id_jenis = j.id_jenis
            WHERE td.id_transaksi = $getIdTransaksi";
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