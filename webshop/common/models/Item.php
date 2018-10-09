<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $name
 */
class Item extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
            	'class' => TimestampBehavior::className(),
        		'value' => function($event) {
        			return date('Y-m-d H:i:s');
        		},
        	],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
}
