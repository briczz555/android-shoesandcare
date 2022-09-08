<?php

    require '../koneksi.inc';
    
    $response = array();
    
    if(isset($_POST['iStatus'])){
        $status = $_POST['iStatus'];
    
        $sql = "SELECT SUM(total_harga) as 'total_pendapatan' FROM transaksi WHERE status = :status";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
    
        if($count == 1){
    
            $response['error'] = false;
            $response['message'] = "Success";
    
            $total = $result['total_pendapatan'];
    
            if(is_null($total)){
    
            $response['total_pendapatan'] = 0;
    
        }else{
    
            $response['total_pendapatan'] = $total;
    
        }
    
        }else{
            $response['error'] = true;
            $response['message'] = "Belum ada transaksi";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Parameter tidak sesuai";
    }
    
    echo json_encode($response);

?>