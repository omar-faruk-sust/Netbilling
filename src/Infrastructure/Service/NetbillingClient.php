<?php

declare(strict_types = 1);

namespace App\Infrastructure\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Description of NetbillingClient
 *
 * @author omarfaru
 */
class NetbillingClient {

    const NETBILLING_URL = 'http://secure.netbilling.com:1401/gw/sas/direct3.2';
    
    /**
     * @return type
     */
    public function serviceCall() {
        
        try {
            /*$client = new Client(
                [
                    'headers' => [
                        'User-Agent'=> 'MyDM3Client/Version:2010.Aug.20',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Content-Length' => 104
                    ]
                ]
            );

        $response = $client->request(
                'POST', self::NETBILLING_URL, 
                ['form_params' => $this->getValues()]
        );

        return $response;*/
            
        $client = new Client(['base_uri' => 'http://secure.netbilling.com:1401']);
        $response = $client->post('/gw/sas/direct3.2',[
            'debug' => TRUE,
            'form_params' => $this->getValues(),
            [
                'headers' => [
                    'User-Agent'=> 'MyDM3Client/Version:2010.Aug.20',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Content-Length' => 104
                ]
            ]
        ]);

        return $response;
        
        } catch (ClientException $e) {
            echo Psr7\str($e->getResponse());
        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
        }
        
    }
    
    /**
     * @return type
     */
    public function getValues() {
        return [
            // the API Login ID and Transaction Key must be replaced with valid values
            "pay_type" => "C",
            "tran_type" => "A",
            "account_id" => "110006559149",
            "card_number" => "4444333322221186",
            "card_expire" => "0909",
            "cvv2_code" => "111",
            "amount" => "5.00"
        ];
    }
    
    
    /**
     * @param type $postValues
     * @return string
     */
    public function prepareUrlValues($postValues) {

        // for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
        $postString = "";

        foreach ($postValues as $key => $value) {

            if (!empty($postString)) {
                $postString .= "&";
            }

            $postString .= $key . "=" . urlencode($value);
        }
        return $postString;
    }

}
