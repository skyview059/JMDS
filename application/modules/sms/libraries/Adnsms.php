<?php

/**
 * Description of SMS Library 
 * This Library only for ADN SMS Service
 *
 * @author Khairul Azam
 * Date: 03th October 2019 02:00 am
 */

class Adnsms {
    
    static protected $API_URL       = 'https://portal.adnsms.com/api/v1/secure/send-sms';
    static protected $API_KEY       = 'KEY-vopgs3jyoe9tagdcmf2dvfqrmqrl3xrs';
    static protected $API_SECRET    = 'Q4k$OpsQswPLRAe1';
    
    
    
    static function send_single($message, $recipient){
             
        $data = [
            'api_key'       => self::$API_KEY,
            'api_secret'    => self::$API_SECRET,
            'request_type'  => 'SINGLE_SMS',
            'message_type'  => 'UNICODE', // TEXT or UNICODE
            'mobile'        => self::fix88($recipient),
            'message_body'  => $message
        ];
        self::save_log( $data );
        
        return self::callToApi($data);
    }
    
    static function send_bulk($message, $recipients){
             
        $data = [
            'api_key'       => self::$API_KEY,
            'api_secret'    => self::$API_SECRET,
            'campaign_title'  => 'Ramsara-Iscon-' . date('Ymd'),
            'request_type'  => 'GENERAL_CAMPAIGN',
            'message_type'  => 'TEXT | UNICODE', // TEXT or UNICODE
            'mobile'        => $recipients,
            'message_body'  => $message            
        ];
        //dd($data);
        
        self::save_log( $data );
        
        return self::callToApi($data);
    }
    
    static function getBalance(){
             
        $data = [
            'api_key'       => self::$API_KEY . 'https://portal.adnsms.com/api/v1/secure/check-balance',
            'api_secret'    => self::$API_SECRET,
            'campaign_title'  => 'Ramsara-Iscon-' . date('Ymd'),
            'request_type'  => 'GENERAL_CAMPAIGN',
            'message_type'  => 'TEXT | UNICODE', // TEXT or UNICODE
            'mobile'        => $recipients,
            'message_body'  => $message            
        ];
        
    }
    
    static public function callToApi($data){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_URL, self::$API_URL );
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
    
    static private function save_log( $data ){
        $string = implode(',', $data) . "\r\n";
        file_put_contents( __DIR__ . '/log.txt', $string, FILE_APPEND );
    }    
    
    static private function fix88($phone) {    
        if(substr($phone,0,2) == 88){
            return $phone;
        }
        return "88{$phone}";
    }
}