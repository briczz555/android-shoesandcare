<?php

    require '../koneksi.inc';

    $response = array();

    if(isset($_POST['iIdLayanan']) && isset($_POST['iNamaLayanan']) && isset($_POST['iHarga'])){
        $sql = "UPDATE layanan SET nama=:namaLayanan, harga=:hargaLayanan WHERE id_layanan=:idLayanan";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idLayanan', $_POST['iIdLayanan']);
            $stmt->bindValue(':namaLayanan', $_POST['iNamaLayanan']);
            $stmt->bindValue(':hargaLayanan', $_POST['iHarga']);

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