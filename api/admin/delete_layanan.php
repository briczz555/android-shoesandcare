<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iIdLayanan'])){
        $sql = "DELETE FROM layanan WHERE id_layanan=:idLayanan";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idLayanan', $_POST['iIdLayanan']);

            if($stmt->execute() == TRUE){
                $response['error'] = false;
                $response['message'] = "Berhasil";
            }else{
                $response['error'] = true;
                $response['message'] = "Gagal menghapus data";
            }

        echo json_encode($response);
    }

?>