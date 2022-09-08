<?php

    require 'koneksi.inc';

    $response = array();

    if(isset($_POST['iIdUser']) && isset($_POST['iIdLayanan']) && isset($_POST['iIdJenis']) && isset($_POST['iHarga'])){

        $sql = "INSERT INTO cart (id_user, id_layanan, id_jenis, harga) VALUES (:iduser, :idlayanan, :idjenis, :harga)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':iduser', $_POST['iIdUser']);
        $stmt->bindValue(':idlayanan', $_POST['iIdLayanan']);
        $stmt->bindValue(':idjenis', $_POST['iIdJenis']);
        $stmt->bindValue(':harga', $_POST['iHarga']);

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