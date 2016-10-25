<?php
/**
 * Created by Lorge 
 *
 * User: Only Love.
 * Date: 12/15/13 - 9:33 AM
 */

class Constants{
    const
        LAYOUT_MAIN = "//layouts/main",
        LAYOUT_LOGIN = "//layouts/login",
        LAYOUT_ERROR = "//layouts/error",

        SUCCESS = 'SUCCESS',
        ERROR = 'ERROR';
    const
        TYPE_PRODUCT = 'products',
        TYPE_BANNER = 'banner',
        TYPE_NEWS = 'news',
        TYPE_ARTICLE = 'article',
        TYPE_LANGUAGE = 'language',
        TYPE_MENU = 'menu',
        //TYPE_PROMOTION = 'menu',
        TYPE_MEDIA = 'media',
        TYPE_PROMOTION = 'promotion',

        TYPE_ANDROID = 1,
        TYPE_IOS = 2,

        STATUS_ACTIVE = 'active',
        STATUS_INACTIVE = 'inactive',

        STATUS_CREATED = 0,
        STATUS_REJECT = 1,
        STATUS_IN_PROCESS = 2,
        STATUS_READY = 3,
        STATUS_PENDING = 6,
        STATUS_DELIVERED = 4,
        STATUS_FAIL = 5,
        STATUS_ALL = -1,

        ORDER_DAILY = 0,
        ORDER_DAY = 4,
        ORDER_WEEKLY = 1,
        ORDER_MONTHLY = 2,
        ORDER_YEARLY = 3,

        ROLE_DELIVERY = 1,
        ROLE_CHEF = 2,
        ROLE_ADMIN = 3,
        ROLE_USER = 0,
        ROLE_WAITER = 4,


        NO_IMAGE = 'noImage.jpg';

    const
        TYPE_DISH = 'menu',
        TYPE_TOPPING = 'topping';

    const
        SETTING_MAIL = 'SETTING_MAIL',
        SETTING_ADMIN_MAIL = 'SETTING_ADMIN_MAIL',
        SETTING_BANK_INFO = 'SETTING_BANK_INFO',
        SETTING_GENERAL = 'SETTING_GENERAL';
    const ROLE_CUSTOMER = 0;
    const ROLE_DELIVERY_MAN = 1;
    const USER_STATUS_ACTIVE = 1;

    public static $imageExtension = array('jpg', 'png', 'gif');

    public static function pushAndroid($registrationIDs,$msg)
    {
        $apiKey = json_decode(Settings::model()->findByPk(4)->setting_value)->google_api_key;
        $url = 'https://android.googleapis.com/gcm/send';

        $loop = ceil (count($registrationIDs)/1000);
        $msg = array
        (
            'message'=>$msg
        );

        for ($i = 1; $i<=$loop; $i++)
        {
            if (0 <count($registrationIDs) && count($registrationIDs) <1000)
                $registrationID = $registrationIDs;
            else
            {
                $registrationID = array_slice($registrationIDs,0,1000);
                $registrationIDs = array_slice($registrationIDs,1000,count($registrationIDs));
            }

            $fields = array
            (
                'registration_ids' => $registrationID,
                'data' => $msg
            );

            $headers = array(
                'Authorization: key=' . $apiKey,
                'Content-Type: application/json'
            );
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			try
			{
				curl_exec($ch);
				curl_close($ch);
			}
			catch (Exception $e)
			{
				curl_close($ch);
			}
        }
    }

    public static function pushIos($idevices,$message)
    {

        $badge = 1;
        $sound = 'default';
        $development = true;// make it false if it is not in development mode
        $passphrase='projectemplate';// put your private key's passphrase here:

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
		stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
		stream_context_set_option($stream_context, 'ssl', 'passphrase', $passphrase);

		$apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);
        foreach($idevices as $idevice)
        {			
            $token = $idevice;
            $device_tokens=  str_replace("<","",$token);
            $device_tokens1=  str_replace(">","",$device_tokens);
            $device_tokens2= str_replace(' ', '', $device_tokens1);

            $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $device_tokens2) . chr(0) . chr(strlen($payload)) . $payload;
			try
			{
				fwrite($apns, $apns_message);
			}
			catch (Exception $e)
			{}
        }
		@socket_close($apns);
		@fclose($apns);

    }
}