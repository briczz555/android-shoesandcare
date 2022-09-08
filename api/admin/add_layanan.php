<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iNamaLayanan']) && isset($_POST['iHarga'])){

        $sql = "INSERT INTO layanan (nama, harga, image) VALUES (:namaLayanan, :harga, :img)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':namaLayanan', $_POST['iNamaLayanan']);
        $stmt->bindValue(':harga', $_POST['iHarga']);
        $stmt->bindValue(':img', "cuc");

        if($stmt->execute() == TRUE){
            $response['error'] = false;
            $response['message'] = "Berhasil";
        }else{
            $response['error'] = true;
            $response['message'] = "Gagal menambah ke keranjang";
        }

    }else{
        $response['error'] = true;
        $response['message'] = "Parameter tidak sesuai";
    }

    echo json_encode($response);

?>