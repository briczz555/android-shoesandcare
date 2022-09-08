<?php

    require 'koneksi.inc';

    $response = array();

    if(isset($_POST['iIdCart'])){
        $sql = "DELETE FROM cart WHERE id_cart=:cart";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':cart', $_POST['iIdCart']);

            if($stmt->execute() == TRUE){
                $response['error'] = false;
                $response['message'] = "Berhasil";
            }else{
                $response['error'] = true;
                $response['message'] = "Gagal membuat akun baru";
            }

        echo json_encode($response);
    }

?>