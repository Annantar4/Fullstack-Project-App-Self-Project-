<?php
function curl_api($url, $method, $data = NULL, $authorization = NULL) {
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    
    // Jika authorization diberikan, tambahkan ke header
    $headers = [];
    if ($authorization) {
        $headers[] = 'Authorization: Bearer ' . $authorization;
    }

    if ($method == 'POST' || $method == 'PUT') {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $headers[] = 'Content-Type: application/json';
    }
    
    if (!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    
    $obj = new stdClass(); $obj->httpcode = $httpcode; $obj->error = $error; $obj->data = json_decode($result); return $obj;
}

