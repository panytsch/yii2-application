<?php

namespace backend\controllers;

use common\components\Authorization;
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
        if (empty(\Yii::$app->request->headers->get('Authorization')))
            return null;
        if (\Yii::$app->request->isGet)
        {
            $data = json_decode(Authorization::decode(\Yii::$app->request->headers->get('Authorization')), true);
            if (!$data || !isset($data['name']) || !isset($data['password']) || !isset($data['email'])) {
                return null;
            }
            $user = new User();
            $user->role_id = User::ROLE_ADMIN;
            $user->username = $data['name'];
            $pass = $data['password'];
            $user->setPassword($pass);
            $user->generateAuthKey();
            $user->email = $data['email'];
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