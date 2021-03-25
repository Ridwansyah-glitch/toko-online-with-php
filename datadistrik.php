<?php

$id_provinsi_terpilih = $_POST["id_provinsi"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi_terpilih,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: edfdbaffca08827634eceeae9249c235"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;

  $array_response = json_decode($response,TRUE);
  $dataDistrik=$array_response["rajaongkir"]["results"];

  // echo "<pre>";
  // print_r($dataDistrik);
  // echo "</pre>";

  echo "<option value=''><-- Pilih Distrik --></option>";
  foreach($dataDistrik as $key => $tiapDistrik){
    echo "<option value=''
      id_distrik='".$tiapDistrik["city_id"]."'
      nama_provinsi='".$tiapDistrik["province"]."'
      nama_distrik='".$tiapDistrik["city_name"]."'
      tipe_distrik='".$tiapDistrik["type"]."'
      kodepos='".$tiapDistrik["postal_code"]."'     
    >";
    echo $tiapDistrik["type"]." ";
    echo $tiapDistrik["city_name"];
    echo "</option>";

  }

}

?>