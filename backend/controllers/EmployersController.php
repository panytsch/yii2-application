<?php

namespace backend\controllers;

use backend\models\EmployersSearch;

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
}