<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\assets\MapleAsset;
use app\assets\FramesAsset;
use yii\helpers\Json;
use yii\db\Query;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionFrames() {
        $frames = (new Query())
            ->select('f.id, f.name, f.description, f.path')
            ->from('{{%frames}} f')
            ->all();
        header('HTTP/1.1 200 OK');
        header('Content-type: application/json; charset=UTF-8');
        echo JSON::encode($frames);
    }
    
    public function actionEldamar() {
        MapleAsset::register($this->view);
        $frame_asset = (new \app\assets\FramesAsset);

        $frames = (new \yii\db\Query())
            ->select('f.id, f.name, f.description, f.path')
            ->from('{{%frames}} f')
            ->all();
        
        try {
            foreach($frames as $index => $frame) {
                $frames[$index]['template'] = file_get_contents(Yii::getAlias('@webroot/' . $frame['path']));
                $scripts = $this->_frameScripts($frame['id']);
                $frame_asset->js = array_merge($frame_asset->js, $this->_assetsScripts($scripts));
                $frames[$index]['scripts'] = $scripts;
            }
        }
        catch(\Exception $e) {
            
        }
        $frame_asset->registerAssetFiles($this->view);
        return $this->render('eldamar', [
            'frames' => $frames
        ]);
    }
    
    protected function _assetsScripts($frame_scripts) {
        $result = [];
        if(is_array($frame_scripts)) {
            foreach($frame_scripts as $index => $script) {
                $result[] = $script['path'];
            }
        }
        return $result;
    }
    
    protected function _frameScripts($frame_id) {
        return (new \yii\db\Query())
                ->select('fj.id, fj.frame_id, fj.path, fj.name, fj.description, fj.position, fj.type')
                ->from('{{%frame_js}} fj')
                ->where('fj.frame_id = :id', [':id'=>$frame_id])
                ->all();
    }
    
    public function beforeAction($action)
    {
        // ...set `$this->enableCsrfValidation` here based on some conditions...
        // call parent method that will check CSRF if such property is true.
        /*if ($action->id === 'qwerty') {
            # code...
            $this->enableCsrfValidation = false;
        }*/
        return parent::beforeAction($action);
    } 
    
    public function actionQwerty() {
        $content = null;
        $input = file_get_contents('php://input');
        if( $input !== "" ) {
            $content = JSON::decode($input);
        }
        var_dump($input);
        var_dump($content);
    }
}
