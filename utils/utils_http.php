<?php
session_start();

class Utils_http {

    public function http_request($endpoint, $http_request ,$data_send){
        $URL = "192.168.8.104:8080/";
        $token = $_SESSION["token"];
        $headers = array('Content-Type: application/json');
        if ($token != "") {
            $headers = array('Content-Type: ≠application/json', 'Authorization: '.$token);
        }

        $fullurl = $URL . $endpoint;
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $fullurl);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_request);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_send);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch); 
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $data = json_decode($output, TRUE);

        if ($httpcode == 401) {
            $response = $this->request_token();
            if ($response != 200) {
                session_destroy();
                header("location: ../index.php?session=no ", true, 301);
                exit();
            }else {
                $data = $this->http_request($endpoint, $http_request ,$data);
            }
        }
        // echo $data_send;
        // var_dump($data);
        curl_close($ch);      
        return $data; 
    }
    
    function request_token(){
        $URL = "192.168.8.104:8080/api/auth/refresh-token";
        $token = $_SESSION["token"];
        $refresh_token = $_SESSION["refresh_token"];
        $headers = array('Content-Type: application/json', 'Authorization: '.$token, 'Authorization_Refresh: '.$refresh_token);
    
        // persiapkan curl
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $URL);
        // set user agent    
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        // return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch); 
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 200) {
            $data = json_decode($output, TRUE);
            $_SESSION["token"] = $data["data"]["token"];
            $_SESSION["refresh_token"] = $data["data"]["refresh_token"];
        }

        return $httpcode;
    }
}