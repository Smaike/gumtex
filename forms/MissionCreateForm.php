<?php

namespace app\forms;

use Yii;
use yii\base\Model;

use app\models\Client;
use app\models\Event;
use app\models\EventsService;
use app\models\File;
use app\models\Mission;
use app\models\MissionFile;
use app\models\MissionUser;

/**
 * ContactForm is the model behind the contact form.
 */
class MissionCreateForm extends Model
{
    public $theme;
    public $description;
    public $status;
    public $id_created;
    public $is_report;
    public $created_at;
    public $updated_at;
    public $updated_by;
    public $files;
    public $executors;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status', 'is_report', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['theme'], 'string', 'max' => 255],
            [['files'], 'file', 'maxFiles' => 5],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'theme' => 'Тема',
            'description' => 'Описание',
            'status' => 'Статус',
            'id_created' => 'Кем создан',
            'is_report' => 'Нужен ли отчет',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'updated_by' => 'Кем изменен',
            'files' => 'Файлы',
        ];
    }

    public function save()
    {
        $mission = new Mission();
        $mission->attributes = $this->attributes;
        if(!$mission->save()){
            return false;
        }
        foreach ($this->files as $file) {
            $mFile = new File();
            $mFile->title = $file->name;
            $mFile->ext = $file->extension;
            $mFile->filename = \Yii::$app->security->generateRandomString();
            $mFile->created_at = date("Y-m-d H:i:s");
            if($mFile->save()){
                $file->saveAs("uploads/" . $mFile->filename . "." . $mFile->ext);
                $mission_file = new MissionFile();
                $mission_file->id_mission = $mission->id;
                $mission_file->id_file = $mFile->id;
                if($mission->save()){
                    return true;
                }
            }
        }
        return false;
    }

}
