<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emails_send".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $subject
 * @property string $content
 * @property string $recipients
 * @property integer $is_send
 * @property string $date_send
 * @property integer $user_id
 */
class EmailsSend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emails_send';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_send', 'user_id'], 'integer'],
            [['subject', 'content', 'recipients'], 'required'],
            [['content', 'recipients'], 'string'],
            [['date_send'], 'safe'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'id шаблона',
            'subject' => 'тема',
            'content' => 'контент',
            'recipients' => 'Recipients',
            'is_send' => 'Is Send',
            'date_send' => 'дата отправки',
            'user_id' => 'пользователь',
        ];
    }
}
