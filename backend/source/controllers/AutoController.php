<?php

class AutoController extends Controller
{
    public function actionComplete() {
        $criteria = new CDbCriteria;
        $criteria->select = array('id', 'full_name');
        $criteria->condition = "role = 1 ";
        $criteria->addSearchCondition('full_name',  strtoupper( $_GET['term']) ) ;
        $criteria->limit = 15;
        $data = Account::model()->findAll($criteria);

        $arr = array();

        foreach ($data as $item) {

            $arr[] = array(
                'id' => $item->id,
                'value' => $item->full_name,
                'label' => $item->full_name,
            );
        }

        echo CJSON::encode($arr);

    }
    public function actionComplete1() {
        $criteria = new CDbCriteria;
        $criteria->select = array('id', 'full_name');
        $criteria->condition = "role = 1 ";
        $criteria->addSearchCondition('full_name',  strtoupper( $_GET['term']) ) ;
        $criteria->limit = 15;
        $data = Account::model()->findAll($criteria);

        $arr = array();

        foreach ($data as $item) {

            $arr[] = array(
                'id' => $item->id,
                'value' => $item->full_name,
                'label' => $item->full_name,
            );
        }

        echo CJSON::encode($arr);

    }

}