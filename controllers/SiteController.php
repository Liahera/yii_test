<?php

namespace app\controllers;

use app\models\Login;
use app\models\User;
use Yii;
use yii\web\Controller;
use app\models\Signup;


class SiteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $model = User::findOne(\Yii::$app->user->identity->id);

            if (Yii::$app->request->get('increment')) {
                $model->number = $model->number + 1;
                $model->save();
            }

            return $this->render('index', [
                'model' => $model
            ]);
        } else {
            $this->redirect('/site/login');
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        $model = new Signup();

        if (Yii::$app->request->post('Signup')) {
            $model->attributes = Yii::$app->request->post('Signup');

            if ($model->validate() && $model->signup()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('signup', ['model' => $model]);
    }

    public function actionIncrementNumber()
    {

    }

    //1. Проверить существует ли пользователь?
    //2. "Внести" пользователя в систему(в сессию)

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $login_model = new Login();

        if (Yii::$app->request->post('Login')) {
            $login_model->attributes = Yii::$app->request->post('Login');

            if ($login_model->validate()) {
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('login',['login_model' => $login_model]);
    }
}
