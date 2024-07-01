<?php

namespace backend\controllers;

use common\models\LoginForm;
use DirectoryIterator;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\StringHelper;
use yii\web\Controller;

date_default_timezone_set('Asia/Bangkok');


class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'grab', 'createadmin'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'index2','changepassword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index3'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionChangepassword()
    {
        $model = new \backend\models\Resetform();
        if ($model->load(Yii::$app->request->post())) {

            $model_user = \backend\models\User::find()->where(['id' => Yii::$app->user->id])->one();
            if ($model->oldpw != '' && $model->newpw != '' && $model->confirmpw != '') {
                if ($model->confirmpw != $model->newpw) {
                    $session = Yii::$app->session;
                    $session->setFlash('msg_err', 'รหัสยืนยันไม่ตรงกับรหัสใหม่');
                } else {
                    if ($model_user->validatePassword($model->oldpw)) {
                        $model_user->setPassword($model->confirmpw);
                        if ($model_user->save()) {
                            $session = Yii::$app->session;
                            $session->setFlash('msg_success', 'ทำการเปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
                            return $this->redirect(['site/logout']);
                        }
                    } else {
                        $session = Yii::$app->session;
                        $session->setFlash('msg_err', 'รหัสผ่านเดิมไม่ถูกต้อง');
                    }
                }

            } else {
                $session = Yii::$app->session;
                $session->setFlash('msg_err', 'กรุณาป้อนข้อมูลให้ครบ');
            }

        }
        return $this->render('_setpassword', [
            'model' => $model
        ]);
    }

    public
    function actionGrab()
    {

        $aControllers = [];


        // $path = \Yii::$app->getBasePath() . 'icesystem/';
        $path = \Yii::$app->basePath;

        $ctrls = function ($path) use (&$ctrls, &$aControllers) {

            $oIterator = new \DirectoryIterator($path);

            foreach ($oIterator as $oFile) {

                if (!$oFile->isDot()

                    && (false !== strpos($oFile->getPathname(), 'controllers')

                        || false !== strpos($oFile->getPathname(), 'modules')

                    )

                ) {


                    if ($oFile->isDir()) {

                        $ctrls($oFile->getPathname());

                    } else {

                        if (strpos($oFile->getBasename(), 'Controller.php')) {


                            $content = file_get_contents($oFile->getPathname());

                            $controllerName = $oFile->getBasename('.php');


                            $route = explode(\Yii::$app->basePath, $oFile->getPathname());

                            $route = str_ireplace(array('modules', 'controllers', 'Controller.php'), '', $route[1]);

                            $route = preg_replace("/(\/){2,}/", "/", $route);


                            $aControllers[$controllerName] = [

                                'filepath' => $oFile->getPathname(),

                                'route' => mb_strtolower($route),

                                'actions' => [],

                            ];

                            preg_match_all('#function action(.*)\(#ui', $content, $aData);


                            $acts = function ($aData) use (&$aControllers, &$controllerName) {


                                if (!empty($aData) && isset($aData[1]) && !empty($aData[1])) {


                                    $aControllers[$controllerName]['actions'] = array_map(

                                        function ($actionName) {
                                            return mb_strtolower(trim($actionName, '{\\.*()'));
                                        },

                                        $aData[1]

                                    );


                                }

                            };


                            $acts($aData);

                        }

                    }


                }

            }

        };


        $ctrls($path);


        echo '<pre>';

        //   print_r($aControllers);

        foreach ($aControllers as $value) {

            //  $route_name = substr($value['route'],2);
            $route_name = substr($value['route'], 1);
            for ($x = 0; $x <= count($value['actions']) - 1; $x++) {
                $fullname = $route_name . '/' . $value['actions'][$x];
                if ($fullname != '') {
                    $chk = \common\models\AuthItem::find()->where(['name' => $fullname])->one();
                    if ($chk) continue;

                    $model = new \common\models\AuthItem();
                    $model->name = $fullname;
                    $model->type = 2;
                    $model->description = '';
                    $model->created_at = time();
                    $model->save(false);
                }
                echo $fullname . '<br/>';

            }
            //echo $route_name;
            // print_r($value['route']);
        }
        // print_r($aControllers['AdjustmentController']);

    }

    public function actionIndex()
    {
        return $this->render('_index2');
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $this->layout = 'main_login';
            $model->password = '';
            return $this->render('login_new', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCreateadmin($id)
    {
        $usr = trim($id);
        $model = new \common\models\User();
        $model->username = $usr;
        $model->setPassword($usr);
        $model->generateAuthKey();
        $model->email = "user_$usr@cameltire.com";
        $model->status = 10;
        if ($model->save()) {
            \Yii::$app->session->set('login_worker', $model->username);
            echo "ok";
        }
    }


}
