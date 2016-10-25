<?php
/**
 * Created by Fruity Solution Co.Ltd.
 * User: Only Love
 * Date: 10/18/13 - 12:20 AM
 *
 * Please keep copyright headers of source code files when use it.
 * Thank you!
 */

class NotificationStatusAction extends CAction
{
    public function run()
    {

        $ime = isset($_REQUEST['ime']) ? $_REQUEST['ime'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';


        if (strlen($status) == 0 or strlen($ime) == 0) {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => 'ime or status fields are missing',
            )));
        }

        $old_device = Device::model()->find(array('condition'=>'ime like :ime','params'=>array(':ime'=>$ime )));
        if(count($old_device)>0)
        {
            $old_device->status = $status;
            $old_device->save();
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::SUCCESS,
                'data' => '',
                'message' => 'OK',
            )));
        }
		else
		{
			ApiController::sendResponse(200, CJSON::encode(array(
                'status' => Constants::ERROR,
                'data' => '',
                'message' => 'ime mismatch',
            )));
		}
    }
}