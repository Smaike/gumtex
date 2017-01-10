<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emails_tpls".
 *
 * @property integer $id
 * @property string $content
 * @property string $date_add
 * @property string $date_send
 * @property string $date_update
 * @property integer $user_id
 */
class EmailsTpls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emails_tpls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','content'/*, 'date_add', 'date_send', 'date_update', 'user_id'*/], 'required'],
            [['content'], 'string'],
            [['date_add', 'date_send', 'date_update'], 'safe'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'content' => 'Текст письма',
            'date_add' => 'Дата создания',
            'date_send' => 'Дата последней отправки',
            'date_update' => 'Дата изменения',
            'user_id' => 'Создатель шаблона',
        ];
    }

    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $this->user_id = 2;
        $this->date_update = $date->format('Y-m-d H:i:s');
        if ($insert)
            $this->date_add = $date->format('Y-m-d H:i:s');
        if (parent::beforeSave($insert)) {
            return true;
        }
        else return false;

    }
}
