<?php

namespace backend\controllers;

use backend\models\CompaniesSearch;
use Yii;

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
}