<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iIdUser'])){

        $sql = "SELECT * FROM users WHERE id_user = :idUser";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':idUser', $_POST['iIdUser']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        if($count == 1){
            $response['error'] = false;
            $response['message'] = "Data ditemukan";
            
            $id_user = $result['id_user'];
            $nama = $result['name'];
            $telp = $result['no_telp'];
            $alamat = $result['alamat'];
            $role = $result['id_role'];

            $response['id_user'] = $id_user;
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