<?php

/**
 * Created by PhpStorm.
 * User: Hy
 * Date: 5/28/14
 * Time: 2:14 PM
 */
class PushNotificationAction extends CAction
{
    public function run()
    {
        $apiKey ='AIzaSyA4bzJXAX23vKPQWnu-od6YzcEHiAnk6ak';
        $url = 'https://android.googleapis.com/gcm/send';
        $registrationIDs = array();

            array_push($registrationIDs, 'APA91bGwXVD0BnWcSuAg3ikY0HolFMB-YK2P8-i1GikZLjB_i9WrVmToymhnJ_VeIz3PfqHlnKJOqbglo62kx_j0F-rDD8__N_ottUhi5MyVB6W0Z7i0KV4DbyeuvV8U2wBl2Opnmrsi');

        $msg = array
        (
            'message'=> 'Cuong trang',

        );

        $fields = array
        (
            'registration_ids' => $registrationIDs,
            'data'				=> $msg
        );


        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        echo $result;

        //push iphone

        //$token=$_REQUEST['token'];
        //$token = 'fe38184c26ad4348ce02e4ecff4c912c51b78cde82015d4fdc8ac1e31639391a';
        $message = 'Hieu!';
        //$message = $item['Hometeam'].' '.$scoreHome.' - '.$scoreAway.' '.$item['Awayteam'].'. Scorer: '.$dataList->player;
        //$message = $item['Hometeam'].' '.$scoreHome.' - '.$scoreAway.' '.$item['Awayteam'].'. Scorer: '.$dataList->player;
//        $message = $dataList->minute."' ".$item['Hometeam'].' '.$scoreHome.' - '.$scoreAway.' '.$item['Awayteam'];

        $badge = 1;
        $sound = 'default';
        $development = true; //make it false if it is not in development mode
        $passphrase = 'Ligue1'; //your passphrase

        $payload = array();
        $payload['aps'] = array('alert' => $message, 'badge' => intval($badge), 'sound' => $sound);
        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;
        $apns_port = 2195;

        if ($development) {
            $apns_url = 'gateway.sandbox.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile) . '/protected/controllers/api/pem/ck.pem';
            //$apns_cert = dirname(Yii::app()->request->scriptFile).'/ck.pem';
        } else {
            $apns_url = 'gateway.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile) . '/protected/controllers/api/pem/ck.pem';
            //$apns_cert = dirname(Yii::app()->request->scriptFile).'/ck.pem';
        }

        // = Device::model()->findAll("type =2 and status =1");

        //foreach ($idevices as $idevice) {

            $stream_context = stream_context_create();
            stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
            stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

            $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);


            $token = '28f8a2bba8df7f6dddbb12c4585f83d6d315af4db390184d851a93907df5830f';
            //$token = $idevice->gcm_id;
            $device_tokens = str_replace("<", "", $token);
            $device_tokens1 = str_replace(">", "", $device_tokens);
            $device_tokens2 = str_replace(' ', '', $device_tokens1);


            $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $device_tokens2) . chr(0) . chr(strlen($payload)) . $payload;

            $msgapns = fwrite($apns, $apns_message);
            if (!$msgapns) {
                echo 'Message not delivered:' . $error . '; error string:' . $error_string . PHP_EOL;
            } else {
                echo 'Message successfully delivered' . PHP_EOL;
            }

            @socket_close($apns);
            @fclose($apns);

       // }

    }


}