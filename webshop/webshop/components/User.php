<?php
namespace common\components;

/**
 * @property boolean $isAdmin
 * @property integer $szerepkor
 * @property integer $projekt
 * @property string $projektCime
 */
class User extends \yii\web\User {

    /**
     * Session-ben tárolt értékek, bejelentkezéskor kapnak értéket
     */
    /**
     * Eredetileg admin-e a felhasználó
     * Ha admin, akkor is lehet, hogy egy másik szerepkörrel jelentkezett be, de adminként plusz jogosultágai vannak
     * Pl. bejelentkezéskor kiválszthatja bármelyik projektot
     */
    public function getIsAdmin() {
        return (bool)\Yii::$app->session->get('is_admin', false);
    }

    public function setIsAdmin($value) {
        \Yii::$app->session->set('is_admin', (bool)$value);
    }

    public function getSzerepkor() {
        return (int)\Yii::$app->session->get('szerepkor', 0);
    }

    public function setSzerepkor($value) {
        \Yii::$app->session->set('szerepkor', (int)$value);
    }

     public function getProjekt() {
        return (int)\Yii::$app->session->get('projekt', 0);
    }

    public function setProjekt($value) {
        \Yii::$app->session->set('projekt', (int)$value);
    }

    public function getProjektCime() {
        return (string)\Yii::$app->session->get('projekt_cime', '');
    }

    public function setProjektCime($value) {
        \Yii::$app->session->set('projekt_cime', (string)$value);
    }

    public function getVizsgalatiSzemely() {
        return (string)\Yii::$app->session->get('vizsgalatiszemely_id', '');
    }

    public function setVizsgalatiSzemely($value) {
        \Yii::$app->session->set('vizsgalatiszemely_id', (int)$value);
    }

    public function getKitoltottKerdoiv() {
        return (string)\Yii::$app->session->get('kitoltottkerdoiv_id', '');
    }

    public function setKitoltottKerdoiv($value) {
        \Yii::$app->session->set('kitoltottkerdoiv_id', (int)$value);
    }

    public function getMeres() {
        return (string)\Yii::$app->session->get('meres_id', '');
    }

    public function setMeres($value) {
        \Yii::$app->session->set('meres_id', (int)$value);
    }

    public function getKerdoiv() {
        return (string)\Yii::$app->session->get('kerdoiv_id', '');
    }

    public function setKerdoiv($value) {
        \Yii::$app->session->set('kerdoiv_id', (int)$value);
    }

    public function getNeme() {
        return \Yii::$app->session->get('neme', '');
    }

    public function setNeme($value) {
        \Yii::$app->session->set('neme', $value);
    }

    public function getKSzId(){
        return 'kSz'.$this->id;
    }
}
