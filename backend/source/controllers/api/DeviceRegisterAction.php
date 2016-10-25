<?php

/**
 * Created by Fruity Solution Co.Ltd.
 * User: Only Love
 * Date: 10/18/13 - 12:20 AM
 *
 * Please keep copyright headers of source code files when use it.
 * Thank you!
 */
class DeviceRegisterAction extends CAction
{
    public function run()
    {
        $gcm = isset($_REQUEST['gcm_id']) ? $_REQUEST['gcm_id'] : '';
        $ime = isset($_REQUEST['ime']) ? $_REQUEST['ime'] : ''; //token : IOS
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : '';
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		if ($action == 'resetUserId')
		{
			$old_device = Device::model()->find(array('condition' => 'ime like :ime', 'params' => array(':ime' => $ime)));
			if (count($old_device) > 0) {
				$old_device->user_id= 0;
				$old_device->save();
				ApiController::sendResponse(200, CJSON::encode(array(
					'status' => 'SUCCESS',
					'message' => 'OK',
				)));
			}
			exit;
		} elseif ($action == 'checkDeviceStatus'){
			$old_device = Device::model()->find(array('condition' => 'ime like :ime', 'params' => array(':ime' => $ime)));
			
			if (count($old_device) > 0) {
				ApiController::sendResponse(200, CJSON::encode(array(
					'status' => 'SUCCESS',
					'data' => $old_device->status,
					'message' => 'OK',
				)));
				exit;
			}
		}

        if (strlen($gcm) == 0) {
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'ERROR',
                'data' => '',
                'message' => 'GCM fields are missing',
            )));
            exit;
        }

        $old_device = Device::model()->find(array('condition' => 'ime like :ime', 'params' => array(':ime' => $ime)));
        if (count($old_device) > 0) {
            $old_device->gcm_id = $gcm;
            $old_device->type = $type;
			if ($status != '-1') // -1 if the app do not want to update status
				$old_device->status = $status;
            $old_device->user_id= isset($userId) ? $userId : '';
            $old_device->save();
            ApiController::sendResponse(200, CJSON::encode(array(
                'status' => 'SUCCESS',
                'message' => 'OK',
            )));
        } 
		else 
		{
            $device = new Device();
            $device->gcm_id = $gcm;
            $device->ime = $ime;
            $device->type = $type;
            $device->status = 1; // default is 1 when create new
            $device->user_id = isset($userId) ? $userId : '';

            if ($device->save()) {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'SUCCESS',
                    'message' => 'OK',
                )));
            } else {
                ApiController::sendResponse(200, CJSON::encode(array(
                    'status' => 'ERROR',
                    'data' => '',
                    'message' => 'GCM id is invalid',
                )));
            }
        }

    }
}