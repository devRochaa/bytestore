<?php
ob_start();
session_start();
error_reporting(0);

require_once('./vendor/autoload.php');
require_once('./Model/header.php');
require_once('./DAO/database.php');

MercadoPago\SDK::setAccessToken($mercado_pago_key);



function mp_create_link($titulo, $preco, $descricao,$costumer_id, $seller_id, $product_id){
    $payment = new MercadoPago\Preference();
  
    $item = new MercadoPago\Item();
    $item->title = $titulo;
    $item->quantity = 1;
    $item->unit_price = $preco;
    $item->description = $descricao;
    $payment->items = array($item);

    $payment->auto_return = "approved";

    $payment->back_urls = array(
        "success"=> 'https://n3rdydesigner.xyz/payment?costumer_id='.$costumer_id.'&seller_id='.$seller_id.'&product_id='.$product_id,
        "pending"=> 'https://n3rdydesigner.xyz/payment?costumer_id='.$costumer_id.'&seller_id='.$seller_id.'&product_id='.$product_id,
        "failure"=> 'https://n3rdydesigner.xyz/payment?costumer_id='.$costumer_id.'&seller_id='.$seller_id.'&product_id='.$product_id
    );


    $payment->notification_url = 'https://n3rdydesigner.xyz/payment';

    $payment->external_reference = "";
    
    $payment->save();
    $payment_id = ($payment->id);
    $payment_link = ($payment->init_point);
    return $payment_link;
}

function mp_get_info_payment($payment_id, $mp_key){


    $url = 'https://api.mercadopago.com/v1/payments/'. $payment_id;
    $authorization_header = 'Authorization: Bearer '. $mp_key;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array($authorization_header));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Desabilita a verificação SSL
    $response = curl_exec($curl);
    
    if(curl_errno($curl)) {
        echo 'Erro ao enviar a solicitação: ' . curl_error($curl);
    }
    
    curl_close($curl);
    
    
    $result = json_decode($response, true);

    $dateTime = new DateTime($result['date_approved']);
    

    $cpf = $result['card']['cardholder']['identification']['number'];
    $cpf = substr_replace($cpf, '***', 0, 3);
    $cpf = substr_replace($cpf, '***', 3, 2);
    $cpf = substr_replace($cpf, '**', 9, 2);


    $data = $dateTime->format('d/m/Y');
    $hora = $dateTime->format('H:i');
    $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    $anuncio_title = $result['additional_info']['items']['0']['title'];
    $anuncio_description = $result['additional_info']['items']['0']['description'];
    $payment_unit_price = $result['additional_info']['items']['0']['unit_price'];
    $payment_method = $result['payment_method']['id'];
    $payment_status = $result['status'];

    $card_user_name = $result['card']['cardholder']['name'];
    $card_month_exp = $result['card']['expiration_month'];
    $card_year_exp = $result['card']['expiration_year'];
    $card_last_4_digits = $result['card']['last_four_digits'];

 
    $payment_info = array($anuncio_title, $anuncio_description, $payment_unit_price, $payment_method, $payment_status, $card_user_name, $card_month_exp, $card_year_exp, $card_last_4_digits, $cpf, $data, $hora);
    return $payment_info;



}



?>


