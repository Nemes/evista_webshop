<?php
namespace common\components;

/**
 * @property boolean $isAdmin
 */
class User extends \yii\web\User {

    public function getIsUser() {
        return (bool)\Yii::$app->session->get('is_user', false);
    }

    public function setIsUser($value) {
        \Yii::$app->session->set('is_user', (bool)$value);
    }
}
