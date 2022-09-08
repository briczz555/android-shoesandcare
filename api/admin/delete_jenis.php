<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iIdJenis'])){
        $sql = "DELETE FROM jenis WHERE id_jenis=:idJenis";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idJenis', $_POST['iIdJenis']);

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