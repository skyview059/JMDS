<?php 

/**
 * Description of SMS Library 
 * This Library only for Bulk SMS BD Service
 *
 * @author Khairul Azam
 * Date: 26th May 2023, 12:30 am
 */

class Bulksms {
    
    static protected $API_URL       = 'http://bulksmsbd.net/api/smsapi';
    static protected $API_KEY       = 'KaG9GfLW7iAy7SVDZLU6';    
    static protected $SenderID      = '8809617611008';    
    
    static function send_single($message, $number ){

        $data = [
            "api_key"   => self::$API_KEY,
            "senderid"  => self::$SenderID,
            "number"    => self::fix88( $number ),
            "message"   => ($message)
        ];
        self::save_log( $data );
        
        return self::callToApi($data);
    }
    
    static function send_bulk( $message, $recipients ){
        $data = [
            "api_key"   => self::$API_KEY,
            "senderid"  => self::$SenderID,
            "number"    => $recipients,
            "message"   => ($message)
        ];        
        self::save_log( $data );        
        return self::callToApi($data);
    }

    static public function callToApi($data){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$API_URL );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    static public function get_balance(){                        
        $data["api_key"] = self::$API_KEY;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://bulksmsbd.net/api/getBalanceApi' );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    static private function save_log( $data ){
        $string = implode(',', $data) . "\r\n";
        file_put_contents( __DIR__ . '/bulksms_log.txt', $string, FILE_APPEND );
    }    
    
    static private function fix88($phone) {    
        if(substr($phone,0,2) == 88){
            return $phone;
        }
        return "88{$phone}";
    }
}