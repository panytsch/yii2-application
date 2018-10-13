<?php

namespace frontend\controllers;


use common\models\Employers;
use frontend\models\EmployersSearch;

class EmployersController extends BaseController
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployersSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView(int $id)
    {
        $employer = Employers::findOne($id);

        if (empty($employer)) {
            \Yii::$app->session->addFlash('error', 'Employer not found');
            return $this->redirect('index');
        }

        return $this->render('_form', ['model' => $employer]);
    }
}