<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "basket".
 *
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $item_quantity
 */
class Basket extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basket';
    }

    public function behaviors()
    {
        return[TimestampBehavior::className()];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'item_quantity'], 'required'],
            [['user_id', 'item_id', 'item_quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Termék neve'),
            'created_at' => Yii::t('backend', 'Létrehozva'),
            'updated_at' => Yii::t('backend', 'Módosítva'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getFelhasznalo()
//    {
//        return $this->hasOne(Felhasznalo::className(), ['id' => 'felhasznalo_id']);
//    }

}
