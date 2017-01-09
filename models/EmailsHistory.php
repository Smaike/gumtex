<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emails_history".
 *
 * @property integer $id
 * @property integer $emails_tpls_id
 * @property integer $recipient
 * @property string $date_send
 * @property integer $user_id
 */
class EmailsHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emails_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emails_tpls_id', 'recipient', 'date_send', 'user_id'], 'required'],
            [['emails_tpls_id', 'recipient', 'user_id'], 'integer'],
            [['date_send'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emails_tpls_id' => 'Шаблон',
            'recipient' => 'Получатель',
            'date_send' => 'Дата отправки',
            'user_id' => 'Отправитель',
        ];
    }
}
