<?php
require_once('./env.php');

$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => TBK_HOST.TBK_ENDPOINT,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "buy_order": "ordenCompra12345678",
            "session_id": "sesion1234557545",
            "amount": 10000,
            "return_url": "http://127.0.0.1/transbank/webpay.php"
        }',
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

echo '<p>token: ' . $response['token'] . '</p>';
echo '<p>url: ' . $response['url'] . '</p>';

?>

<form action="<?= $response['url'] ?>" method="post">
    <input type="hidden" name="token_ws" value="<?= $response['token'] ?>" />
    <input type="submit" value="Pagar con WebPay" />
</form>