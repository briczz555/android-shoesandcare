<?php

    require 'koneksi.inc';

    $response = array();

    $getRowID;

    if(isset($_POST['iIdUser']) && isset($_POST['dataOrder']) && isset($_POST['iTotalHarga'])){
        //get last id transaksi
        $sql = "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($count > 0){
            $getRowID = $result['id_transaksi'] + 1;
        }else{
            $getRowID = 1;
        }

        //insert transaksi
        $sqlJual = "INSERT INTO transaksi (tgl_masuk, tgl_selesai, status, id_user, total_harga) VALUES(NOW(), NOW() + INTERVAL 1 DAY, :status, :idUser, :totHarga)";
        $stmtJual = $conn->prepare($sqlJual);
        $stmtJual->bindValue(':idUser', $_POST['iIdUser']);
        $stmtJual->bindValue(':status', "Dalam Proses");
        $stmtJual->bindValue(':totHarga', $_POST['iTotalHarga']);
        $stmtJual->execute();

        $getData = $_POST['dataOrder'];
        $decode = json_decode($getData, false);
        $length = count($decode);

        for($i=0;$i<$length;$i++){
            $idLayanan =  $decode[$i]->idLayanan;
            $idJenis = $decode[$i]->idJenis;
            $harga = $decode[$i]->harga;
            $sqlJualDesc = "INSERT INTO transaksi_detail (id_transaksi, id_layanan, id_jenis, harga) VALUES(:idTransaksi, :idLayanan, :idJenis, :harga)";
            $stmtJualDesc = $conn->prepare($sqlJualDesc);
            $stmtJualDesc->bindValue(':idTransaksi', $getRowID);
            $stmtJualDesc->bindValue(':idLayanan', $idLayanan);
            $stmtJualDesc->bindValue(':idJenis', $idJenis);
            $stmtJualDesc->bindValue(':harga', $harga);

            if($stmtJualDesc->execute() == TRUE){
                $sqlDelCart = "DELETE FROM cart WHERE id_user=:cart";
                $stmtDelCart = $conn->prepare($sqlDelCart);
                $stmtDelCart->bindValue(':cart', $_POST['iIdUser']);
                $stmtDelCart->execute();
                $response['error'] = false;
                $response['message'] = "Berhasil";

            }else{
                 $response['error'] = true;
                 $response['message'] = "Gagal menambah ke keranjang";
            }
        }

    }else{
        $response['error'] = true;
        $response['message'] = "Parameter tidak sesuai";
    }

    echo json_encode($response);

?>