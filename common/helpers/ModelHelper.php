<?php

namespace common\helpers;

use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

class ModelHelper
{
    /**
     * @var string
     */
    protected $uploadPathRoot;

    /**
     * @param ActiveRecord $model
     * @return string
     * @throws \yii\base\Exception
     */
    public function getFilePathForModel(ActiveRecord $model) :string
    {
        $path = $this->uploadPathRoot . $model::tableName().'/'.$model->getPrimaryKey();
        clearstatcache();
        if (!is_dir($path)){
            FileHelper::createDirectory($path, 0777, true);
        }
        return 'uploads/' . $model::tableName().'/'.$model->getPrimaryKey().'/';
    }

    public function __construct()
    {
        $this->uploadPathRoot = dirname(__DIR__, 2).'/frontend/web/uploads/';
    }

    /**
     * @return string
     */
    public function getUploadPathRoot(): string
    {
        return $this->uploadPathRoot;
    }

    /**
     * @param string $uploadPathRoot
     */
    public function setUploadPathRoot(string $uploadPathRoot): void
    {
        $this->uploadPathRoot = $uploadPathRoot;
    }
}