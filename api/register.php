<?php

    require 'koneksi.inc';

    $response = array();

    if(isset($_POST['iEmail']) && isset($_POST['iPass']) && isset($_POST['iNama']) && isset($_POST['iTelp']) && isset($_POST['iAlamat'])){

        $sql = "INSERT INTO users (email, password, name, no_telp, alamat, id_role) VALUES (:email, :pass, :nama, :telp, :alamat, :id_role)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $_POST['iEmail']);
        $stmt->bindValue(':pass', md5($_POST['iPass']));
        $stmt->bindValue(':nama', $_POST['iNama']);
        $stmt->bindValue(':telp', $_POST['iTelp']);
        $stmt->bindValue(':alamat', $_POST['iAlamat']);
        $stmt->bindValue(':id_role', 2);

        if($stmt->execute() == TRUE){
            $response['error'] = false;
            $response['message'] = "Berhasil";
        }else{
            $response['error'] = true;
            $response['message'] = "Gagal membuat akun baru";
        }

    }else{
        $response['error'] = true;
        $response['message'] = "Parameter tidak sesuai";
    }

    echo json_encode($response);

?>