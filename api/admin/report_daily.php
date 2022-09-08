<?php

    require '../koneksi.inc';

    $response = array();

    $sql = "SELECT DATE_FORMAT(t.tgl_selesai,'%d-%m-%Y') as 'tanggal',  COUNT(td.id_transaksi) as 'jumlah_item', SUM(td.harga) as 'total_pendapatan'
            FROM transaksi as t
            INNER JOIN transaksi_detail as td
            ON t.id_transaksi = td.id_transaksi
            WHERE t.status = 'Pesanan Selesai'
            GROUP BY DATE_FORMAT(t.tgl_selesai,'%d-%m-%Y')";
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