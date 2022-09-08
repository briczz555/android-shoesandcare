<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iNamaJenis'])){

        $sql = "INSERT INTO jenis (nama) VALUES (:namaJenis)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':namaJenis', $_POST['iNamaJenis']);

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