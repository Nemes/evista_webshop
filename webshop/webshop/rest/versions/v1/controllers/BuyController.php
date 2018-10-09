<?php
namespace rest\versions\v1\controllers;


use common\models\Item;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use common\models\Basket;

class BuyController extends ActiveController
{
    public $modelClass = 'common\models\Item';

    public function actions()
    {
        return [
            'all-items', 'put-in-basket', 'get-basket'
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];

        return $behaviors;
    }
    
    public function actionAllItems() {
        $result = [];

        if(($model = Item::find()->select('id, name')->orderBy(['id' =>SORT_DESC])->all()) !== NULL){
            $data = [];
            foreach ($model as $key => $value) {
                $tmpData = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'url' => \yii\helpers\Url::to(['buy/put-in-basket','id'=> $value->id], true),
                ];
                array_push($data, $tmpData);
            }
            $result['status'] = 200;
            $result['items'] = $data;
        } else {
            $result['status'] = 400;
            $result['error'] = 'HIBA!'; 
        }

        return $result;
    }
    
    public function actionPutInBasket($id) {
        $result = [];
        $item = Basket::findOne(['user_id' => \Yii::$app->user->id, 'item_id' => $id]);
        
        if($item) {

            $model = Basket::updateAll(['item_quantity' => ($item->item_quantity + 1)],['user_id' => \Yii::$app->user->id, 'item_id' => $id]);
            $model = Basket::findOne(['user_id' => \Yii::$app->user->id, 'item_id' => $id]);
            $result['status'] = 200;
            $result['items'] = $model;
        } else {
            $model = new Basket();
            $model->user_id = \Yii::$app->user->id;
            $model->item_id = $id;
            $model->item_quantity = 1;
            
            if($model->save()) {
                $result['status'] = 200;
                $result['items'] = $model;
            } else {
                $result['status'] = 400;
                $result['error'] = 'HIBA!';  
            }
        }
        
        return $result;
    }
    
    public function actionGetBasket() {
        $result = [];

        if(($model = Basket::findAll(['user_id' => \Yii::$app->user->id]))){
            $data = [];
            foreach ($model as $key => $value) {
                $tmpData = [
                    'user_id' => $value->user_id,
                    'item_id' => $value->item_id,
                    'item_quantity' => $value->item_quantity,
                    'url' => \yii\helpers\Url::to(['buy/delete-item','itemId'=> $value->item_id], true),
                ];
                array_push($data, $tmpData);
            }
            $result['status'] = 200;
            $result['items'] = $data;
        } else {
            $result['status'] = 400;
            $result['error'] = 'HIBA!'; 
        }

        return $result;
    }
}