<?php

namespace frontend\controllers;

use common\models\Companies;
use frontend\models\CompaniesSearch;

class CompaniesController extends BaseController
{
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView(int $id)
    {
        $company = Companies::findOne($id);

        if (empty($company)) {
            \Yii::$app->session->addFlash('error', 'Company not found');
            return $this->redirect('index');
        }

        return $this->render('_form', ['model' => $company]);
    }
}