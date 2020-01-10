<?php
function json_output($json = []) {
    header('Content-Type:application/json');
    echo json_encode($json);
    die;
}

function json_build($status = 200, $msg = 'OK', $data = []){
    return[
        'status' => $status,
        'msg' => $msg,
        'data' => $data 
    ];
}


function load_conceptos(){
    if(!isset($_SESSION['conceptos'])){
        return [];
    }
   return $_SESSION['conceptos'];
}


function load_concepto($id) {
    $conceptos = load_conceptos();
    if(empty($conceptos)) return false;

    foreach($conceptos as $i => $v) {
        if($v['id'] == $id) {
            return $v;
        }
    }
    return false; 
}



