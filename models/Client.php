<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $birthday
 * @property string $p_first_name
 * @property string $p_last_name
 * @property string $p_middle_name
 * @property string $mobile
 * @property string $p_mobile
 * @property integer $type
 * @property integer $category
 * @property integer $id_consultant
 * @property string $comment
 * @property string $where_know
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['birthday'], 'safe'],
            [['type', 'category', 'id_consultant'], 'integer'],
            [['comment', 'where_know'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'p_first_name', 'p_last_name', 'p_middle_name'], 'string', 'max' => 60],
            [['mobile', 'p_mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'birthday' => 'Birthday',
            'p_first_name' => 'P First Name',
            'p_last_name' => 'P Last Name',
            'p_middle_name' => 'P Middle Name',
            'mobile' => 'Mobile',
            'p_mobile' => 'P Mobile',
            'type' => 'Type',
            'category' => 'Category',
            'id_consultant' => 'Id Consultant',
            'comment' => 'Comment',
            'where_know' => 'Where Know',
        ];
    }

    public function getAge()
    {
        $birthday_timestamp = strtotime($this->birthday);
        $age = date('Y') - date('Y', $birthday_timestamp);
        if (date('md', $birthday_timestamp) > date('md')) {
            $age--;
        }
        return $age;
    }
}
