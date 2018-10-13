<?php

namespace backend\controllers;

use backend\models\EmployersSearch;
use common\models\Employers;
use Yii;

class EmployersController extends AdminController
{
    public function actionIndex()
    {
        $searchModel = new EmployersSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = Employers::findOne($id);

        if (empty($model)) {
            Yii::$app->session->addFlash('error', 'Something wrong');
            return $this->redirect('index');
        }

        if (Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if ($model->validate()){
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
        $model = new Employers();

        if (Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if ($model->validate()){
                if ($model->save()){
                    Yii::$app->session->addFlash('success', 'Saved');
                    $model = new Employers();
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
        $model = Employers::findOne($id);

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