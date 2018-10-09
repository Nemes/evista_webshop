<?php
namespace rest\versions\v1\controllers;

use common\models\User;
use rest\versions\v1\models\LoginForm;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actions()
    {
        return [
            'details', 'login',
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'except' => ['login']
        ];

        return $behaviors;
    }

    public function actionLogin(){
        $result['status'] = 422;

        $model = new LoginForm();
        
        if(!\Yii::$app->request->post('email')){
            $result['error']['email'] = "A email nem lehet üres/hiányzik.";
        }

        if(!\Yii::$app->request->post('password')){
            $result['error']['password'] = "A password nem lehet üres/hiányzik.";
        }

        if ($model->load(\Yii::$app->request->post(), '') && ($token = $model->login()) !== NULL) {
            $result['token'] = $token;
            $result['status'] = 200;
        } else {
            $result['error'] = $model->getErrors();
        }

        return $result;
    }

    public function actionDetails(){
        $result['status'] = 422;
        $id = \Yii::$app->user->id;

        if (($model = User::find()->select('id, username, email')->where(['id' => $id])->one()) === null) {
            return ['name'=>'Not Found','message'=>'A felhasználó nem található.','code'=>0,'status'=>404,'type'=>'yii\\web\\NotFoundHttpException'];
        } else{
            $result['user'] = $model;
            $result['status'] = 200;

            return $result;
        }

    }

}