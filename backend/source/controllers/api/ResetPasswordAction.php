<?php
//http://localhost/matching/index.php/api/register?name=tony&email=tony@gmail.com&dob=1992-12-11&gender=2&password=123456
class ResetPasswordAction extends CAction
{
    public function run()
    {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $code = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';

        $check = Account::model()->find('email ="'.$email.'"');


        if(!isset($check)) {            
			echo 'Email is not registered!';
            exit;
        }
        else
        {
            $name = (isset($check->full_name) AND $check->full_name != NULL AND $check->full_name != '' )? $check->full_name : $check->username  ;
            $string = $check->token;

            if ($code != $string)
            {
                echo 'Invalid or expired token!';
                exit;
            }


            $length = 8;
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $count = mb_strlen($chars);

            for ($i = 0, $result = ''; $i < $length; $i++) {
                $index = rand(0, $count - 1);
                $result .= mb_substr($chars, $index, 1);
            }
			$check->password = md5($result);
			
			$token = md5(strtotime('Now')); // renew token
            $check->token = $token;
            
			$check->save();


            $adminMail = Settings::model()->findByPk(2)->setting_value;

            $message = new YiiMailMessage;
            $message->view = 'newPassword';
            $params = array('password' => $result, 'name'=>$name);
            $message->setBody($params, 'text/html');
            $message->subject = Yii::app()->name.' - Your password has been reset';
            $message->addTo($email);
            $message->from = $adminMail;
            Yii::app()->mail->send($message);

			echo 'A message contain new password has been sent to your email';            
        }
    }
}