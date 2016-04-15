<?php
class SMS
{
    public static function send($number, $message='')
    {
    // this line loads the library 
        require_once( __DIR__.'/../vendor/twilio/sdk/Services/Twilio.php'); 
        try { 
            $account_sid = '#INSERT YOUR TWILIO ACCOUNT SID HERE#'; 
            $auth_token = '#INSERT YOUR AUTH TOKEN HERE#'; 
            $client = new Services_Twilio($account_sid, $auth_token); 

            $r = $client->account->messages->create(array( 
                'To' => $number, 
                'From' => "+12017541342", 
                'Body' => $message
                ));
            return $r;
        }
        catch (Services_Twilio_RestException $e) {
            return array('Caught exception: ',  $e->getStatus(), $e->getInfo());
        }
    }

    public static function batch_send($numbers, $message='')
    {
        $numbers=array_unique($numbers);
        $response = array();
        foreach ($numbers as $key => $value) {
            $response[]= self::send($value, $message);
        }
        return $response;
    }
}


class SMSHanlder
{
    function post()
    {
        $this->post_xhr();
    }

    function post_xhr()
    {
        $params = _set_default('message','number');
        _response(SMS::send($number=$params['number'], $message=$params['message']));
    }
}