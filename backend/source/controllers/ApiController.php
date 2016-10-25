<?php
/**
 * Created by Only Love.
 * Date: 9/24/13
 * Time: 9:46 AM
 */

class ApiController extends Controller{
    const   API_KEY = 'voice_20131227';

    public function filters() {
        return array();
    }

    public function actions() {
        return array(
            // api/menu/list
            'listMenus' => 'backend.controllers.api.MenusAction',

            // api/dish/promotion/list
            'listDishPromotion' => 'backend.controllers.api.ListDishPromotionAction',

            // api/dish/menu/list
            'dish' => 'backend.controllers.api.MenuAction',

            // api/restaurant/list
            'listRestaurant' => 'backend.controllers.api.ListRestaurantAction',

            // api/order/create
            'order' => 'backend.controllers.api.OrderAction',

            // api/restaurant/contact
            'restaurantContact' => 'backend.controllers.api.ContactAction',

            // api/consulting/detail
            'listConsultingDetail' => 'backend.controllers.api.ListConsultingDetailAction',

            // api/media/list/video
            'listMediaVideo' => 'backend.controllers.api.ListMediaVideoAction',

            // api/media/list/consulating
            'listMediaConsulting' => 'backend.controllers.api.ListMediaConsultingAction',

            // api/media/list/news
            'listMediaNews' => 'backend.controllers.api.ListMediaNewsAction',

            // api/media/list/album
            'listMediaAlbum' => 'backend.controllers.api.ListMediaAlbumAction',

            //Coconut
            'register' => 'backend.controllers.api.RegisterAction',
            'deviceRegister' => 'backend.controllers.api.DeviceRegisterAction',
            'login' => 'backend.controllers.api.LoginAction',
            'forgetPassword' => 'backend.controllers.api.ForgetPasswordAction',
            'resetPassword' => 'backend.controllers.api.ResetPasswordAction',
            'changePassword' => 'backend.controllers.api.ChangePasswordAction',
            'updateProfile' => 'backend.controllers.api.UpdateProfileAction',
            'orderDeliveryMan' => 'backend.controllers.api.OrderForDeliveryManAction',
            'updateOrderStatus'=> 'backend.controllers.api.UpdateOrderStatusAction',
            'updateOrderStatusByChef'=> 'backend.controllers.api.UpdateOrderStatusByChefAction',
            'updateOrderStatusByDelivery'=> 'backend.controllers.api.UpdateOrderStatusByDeliveryAction',
            'pushTest'=> 'backend.controllers.api.PushAction',
            'pushNotification'=> 'backend.controllers.api.PushNotificationAction',
            'orderHistory'=> 'backend.controllers.api.OrderHistoryByUserAction',
			
			'showMenu' => 'backend.controllers.api.ShowMenuAction',
            'showFoodByMenu' => 'backend.controllers.api.ShowFoodByMenuAction',
			'notificationStatus'=>'backend.controllers.api.NotificationStatusAction',
            // Zahir Hussan
            'viewOrders'=> 'backend.controllers.api.ViewOrdersAction',
            'viewOrdersByRole'=> 'backend.controllers.api.ViewOrdersByRoleAction',
            'viewNewOrders'=> 'backend.controllers.api.ViewNewOrdersAction',
            'listDeliveryMan'=> 'backend.controllers.api.ListDeliveryManAction',
            'listChef'=> 'backend.controllers.api.ListChefAction',
            'updateOrderByAdmin'=> 'backend.controllers.api.UpdateOrderByAdminAction',
            'dashBoardOrders'=> 'backend.controllers.api.DashBoardOrdersAction',
            'account'=> 'backend.controllers.api.ListAccountAction',
            'updateOrder'=>'backend.controllers.api.UpdateOrderAction',
            'updateOrderStatusByAdmin'=>'backend.controllers.api.UpdateOrderStatusByAdminAction',
            'promotion'=>'backend.controllers.api.PromotionAction',

            'showTableList'=>'backend.controllers.api.ShowTableListAction',
			'showGuestTable'=>'backend.controllers.api.ShowGuestTableAction',
			'updateOrderStatusByWaiter'=>'backend.controllers.api.UpdateOrderStatusByWaiterAction',
			'test'=>'backend.controllers.api.TestAction',

        );
    }

    public static function getStatusCodeMessage($status) {
        $codes = array(
            200 => 'OK',
            400 => 'ERROR: Bad request. API doesn\'t exist OR request failed due to some reason.',
        );

        return (isset($codes[$status])) ? $codes[$status] : null;
    }

    public static function sendResponse($status = 200, $body = '', $content_type = 'application/json') {
        header('HTTP/1.1 ' . $status . ' ' . self::getStatusCodeMessage($status));
        header('Content-type: ' . $content_type);
        if(trim($body) != '') echo $body;
        Yii::app()->end();
    }
}