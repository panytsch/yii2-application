<?php

namespace backend\controllers;

use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'get-new-admin'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Need headers
     *
     * @return null|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionGetNewAdmin()
    {
        $result = [];
        if (empty(\Yii::$app->request->headers->get('Authorization'))
            || empty(\Yii::$app->request->headers->get('email')))
            return null;
        if (\Yii::$app->request->headers->get('Authorization') === \Yii::$app->params['authKeyForGetAdmin']
            && \Yii::$app->request->isGet)
        {
            $user = new User();
            $user->role_id = User::ROLE_ADMIN;
            $user->username = \Yii::$app->request->headers->get('username')
                ?? \Yii::$app->security->generateRandomString(10);
            $pass = \Yii::$app->security->generateRandomString(10);
            $user->setPassword($pass);
            $user->generateAuthKey();
            $user->email = \Yii::$app->request->headers->get('email');
            if ($user->save()){
                $result = [
                    'status' => 'success',
                    'data' => [
                        'email' => $user->email,
                        'username' => $user->username,
                        'password' => $pass
                    ]
                ];
            } else {
                $result = $user->errors;
            }
        }
        return $this->asJson($result);
    }
}