<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iIdJenis']) && isset($_POST['iNamaJenis'])){
        $sql = "UPDATE jenis SET nama=:namaJenis WHERE id_jenis=:idJenis";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idJenis', $_POST['iIdJenis']);
            $stmt->bindValue(':namaJenis', $_POST['iNamaJenis']);

            if($stmt->execute() == TRUE){
                $response['error'] = false;
                $response['message'] = "Berhasil";
            }else{
                $response['error'] = true;
                $response['message'] = "Gagal update data";
            }

        echo json_encode($response);
    }

?>