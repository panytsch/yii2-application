<?php

namespace backend\controllers;

use backend\models\CompaniesSearch;
use common\helpers\ModelHelper;
use common\models\Companies;
use Yii;
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
     * @throws \yii\base\Exception
     */
    public function actionUpdate(int $id)
    {
        $model = Companies::findOne($id);

        if (empty($model)) {
            Yii::$app->session->addFlash('error', 'Something wrong');
            return $this->redirect('index');
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
                $model->save();
            }
        }

        return $this->render('_form', [
            'model' => $model
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionAdd()
    {
        $model = new Companies();

        if (Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()){
                $modelHelper = new ModelHelper();
                $path2File = $modelHelper->getFilePathForModel($model);
                $model->logo = $path2File
                    .$model->file->baseName.'.'.$model->file->extension;
                $model->file->saveAs($_SERVER['DOCUMENT_ROOT'].'/frontend/web/'.$model->logo);
                if ($model->save()){
                    Yii::$app->session->addFlash('success', 'Saved');
                    $model = new Companies();
                } else {
                    Yii::$app->session->addFlash('error', 'Something wrong');
                }
            }
        }

        return $this->render('_form', [
            'model' => $model
        ]);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $model = Companies::findOne($id);

        if (empty($model)) {
            Yii::$app->session->addFlash('error', 'Something wrong');
            return $this->redirect('index');
        }

        $model->delete()
            ? Yii::$app->session->addFlash('success', 'Deleted')
            : Yii::$app->session->addFlash('error', 'Something wrong')
        ;
        return $this->redirect('index');
    }
}