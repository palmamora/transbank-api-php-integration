<?php
require_once('./env.php');

$token = $_GET['token_ws'];

$curl = curl_init();
curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => TBK_HOST . TBK_ENDPOINT . '/' .$token,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_HTTPHEADER => array(
            "Tbk-Api-Key-Id: " . TBK_API_KEY_ID,
            "Tbk-Api-Key-Secret: " . TBK_API_KEY_SECRET,
            'Content-Type: application/json'
        ),
    )
);

$response = curl_exec($curl);
$response = json_decode($response, true);
curl_close($curl);

var_dump($response);

if ($response['status'] == 'AUTHORIZED') {
    echo '<div class="container card">';
    echo '<p>status ' . $response['status'] . '✔</p>';
    echo '</div>';
}

if ($response['status'] == 'FAILED') {
    echo '<div class="container card">';
    echo '<p>status ' . $response['status'] . '❌</p>';
    echo '</div>';
}