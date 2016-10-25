<?php
/**
 * Created by JetBrains PhpStorm.
 * User: HUY
 * Date: 3/7/14
 * Time: 4:19 PM
 * To change this template use File | Settings | File Templates.
 */

class PushAction extends CAction
{

    public function run()
    {
        /*$message = array
        (
            'body'=> 'Push Test!',
        );*/
        $message = "Hieu nhan duoc pm skype nhe!!!";
        $badge = 1;
        $sound = 'default';
        $development = true;//make it false if it is not in development mode
        $passphrase='projectemplate';//your passphrase: if your p12 is created without passphrase, just set it empty

        $payload = array();
        $payload['aps'] = array('alert' => $message, 'badge' => intval($badge), 'sound' => $sound);
        $payload = json_encode($payload);

        $apns_url = NULL;
        $apns_cert = NULL;
        $apns_port = 2195;

        if($development)
        {
            $apns_url = 'gateway.sandbox.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile).'/backend/source/controllers/api/pem/ck.pem';
        }
        else
        {
            $apns_url = 'gateway.push.apple.com';
            $apns_cert = dirname(Yii::app()->request->scriptFile).'/backend/source/controllers/api/pem/ck.pem';
        }
        $stream_context = stream_context_create();
	    //echo $apns_cert; die;
        stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
	    //if (strlen($passphrase)>0)
        stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

        $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
        /*foreach($idevices as $idevice)
        {*/

            $token = '1bd00c829b306c8e4512328fc450c3d7de919cc0e44e3ad6596ecda4102fc830';
            $device_tokens=  str_replace("<","",$token);
            $device_tokens1=  str_replace(">","",$device_tokens);
            $device_tokens2= str_replace(' ', '', $device_tokens1);

            $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $device_tokens2) . chr(0) . chr(strlen($payload)) . $payload;

            $msgapns = fwrite($apns, $apns_message);
            if (!$msgapns) {
                echo 'Message not delivered:' . $error . '; error string:' . $error_string . PHP_EOL;
            } else {
                echo 'Message successfully delivered' . PHP_EOL;
            }
       // }
        @socket_close($apns);
        @fclose($apns);
        //Constants::pushAndroid($id,$msg);
    }

}