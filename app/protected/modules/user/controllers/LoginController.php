<?php

class LoginController extends Controller
{
    public $defaultAction = 'login';

    /**
     * Displays the login page.
     */
    public function actionLogin($tryIt = false)
    {
        if ($tryIt) {
            UserModule::createAndLoginUserTemp();
            $this->redirect('/');
        }

        $model = new UserLogin();
        if (UserModule::isGuest()) {
            // collect user input data
            if (isset($_POST['UserLogin'])) {
                $attributes = $_POST['UserLogin'];
            }

            if (!empty($attributes)) {
                $model->attributes = $attributes;
                // validate user input and redirect to previous page if valid
                if ($model->validate()) {
                    $this->lastViset();

                    if (Yii::app()->user->returnUrl == '/index.php') {
                        $this->redirect(Yii::app()->controller->module->returnUrl);
                    } else {
                        $this->redirect(Yii::app()->user->returnUrl);
                    }
                }
            }
            // display the login form
            $this->render('/user/login', array('model' => $model));
        } else {
            $this->redirect(Yii::app()->controller->module->returnUrl);
        }
    }

    private function lastViset()
    {
        $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
        $lastVisit->lastvisit = time();
        $lastVisit->save();
    }
}
