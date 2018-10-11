<?php

namespace backend\controllers;

use backend\models\CompaniesSearch;
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
                $model->logo = $model->file->baseName;
                $model->file->saveAs('uploads/'.$model->logo.'.'.$model->file->extension);
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