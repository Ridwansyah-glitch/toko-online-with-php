<?php 
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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

        //dapatnya dalam bentuk json
        //kita konversi ke array
        $array_response = json_decode($response,TRUE);
        $dataProvinsi = $array_response['rajaongkir']['results'];

        
        echo "<option value=''><-- Pilih Provinsi --></option>";
        foreach ($dataProvinsi as $key => $tiapProvinsi) {
            echo "<option value='".$tiapProvinsi['province_id']."' id_provinsi='".$tiapProvinsi['province_id']."'>";
            echo $tiapProvinsi["province"];
            echo "</option>";
        }
    }
?>