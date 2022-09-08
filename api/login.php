<?php

    require 'koneksi.inc';

    $response = array();

    if(isset($_POST['iEmail']) && isset($_POST['iPass'])){
        $email = $_POST['iEmail'];
        $password = $_POST['iPass'];

        $sql = "SELECT * FROM users WHERE email = :email AND password = :pass";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':pass', md5($password));
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($count == 1){
            $response['error'] = false;
            $response['message'] = "Login Berhasil";
            
            $id_user = $result['id_user'];
            $email = $result['email'];
            $nama = $result['name'];
            $telp = $result['no_telp'];
            $alamat = $result['alamat'];
            $role = $result['id_role'];

            $response['id_user'] = $id_user;
            $response['email'] = $email;
            $response['name'] = $nama;
            $response['no_telp'] = $telp;
            $response['alamat'] = $alamat;
            $response['id_role'] = $role;
        }else{
            $response['error'] = true;
            $response['message'] = "User tidak ditemukan";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Parameter tidak sesuai";
    }

    echo json_encode($response);

?>