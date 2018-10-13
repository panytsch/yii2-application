<?php

namespace backend\controllers;

use backend\models\CompaniesSearch;
use common\helpers\ModelHelper;
use common\models\Companies;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class CompaniesController extends AdminController
{
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionUpdate(int $id)
    {
        $model = Companies::findOne($id);

        if (empty($model)) {
            throw new NotFoundHttpException();
        }

        if (Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()){
                $modelHelper = new ModelHelper();
                $path2File = $modelHelper->getFilePathForModel($model);
                $model->logo = $path2File
                    .$model->file->baseName.'.'.$model->file->extension;
                $model->file->saveAs($_SERVER['DOCUMENT_ROOT'].'/frontend/web/'.$model->logo);
                if (!$model->save()){
                    var_dump($model->errors);die();
                }
            }
        }

        return $this->render('_form', [
            'model' => $model
        ]);
    }

    protected function formFields(array $post)
    {

    }
}