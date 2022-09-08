<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iIdTransaksi'])){

        $sql = "UPDATE transaksi SET status=:status WHERE id_transaksi=:idTransaksi";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':idTransaksi', $_POST['iIdTransaksi']);
        $stmt->bindValue(':status', "Pesanan Selesai");

        if($stmt->execute() == TRUE){
            $response['error'] = false;
            $response['message'] = "Berhasil";
        }else{
            $response['error'] = true;
            $response['message'] = "Gagal update status";
        }

    }else{
        $response['error'] = true;
        $response['message'] = "Parameter tidak sesuai";
    }

    echo json_encode($response);

?>