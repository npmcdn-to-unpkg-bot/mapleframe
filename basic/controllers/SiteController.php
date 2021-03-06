<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Frames;
use app\models\ContactForm;
use app\assets\MapleAsset;
use app\assets\FramesAsset;
use yii\helpers\Json;
use yii\db\Query;
use yii\web\HttpException;
use app\components\Core;
use yii\web\View;

class SiteController extends Controller
{
    //public $layout = '@app/views/layouts/main.php';

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

    /*public function beforeAction($action)
    {
        // ...set `$this->enableCsrfValidation` here based on some conditions...
        // call parent method that will check CSRF if such property is true.
        if ($action->id === 'qwerty') {
            # code...
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
     */
    public function actionAngular() {
        $this->layout = '@app/views/layouts/angular_only.php';
        $this->view->title = 'Super Calculator';
        return $this->render('angular_only');
    }


    public function actionIndex()
    {
        $page_content = array();
        $page_template = 'index';
        $action = Yii::$app->getRequest()->getQueryParam('action');
        if(empty($action) === false) {
            $page_template = 'page';
            $page = (new Query())
                ->select([
                    'p.id',
                    'p.name',
                    'p.path',
                    'p.alias',
                    'p.template',
                    'p.meta_title',
                    'p.description',
                    'p.meta_keywords',
                    'p.meta_description',
                ])
                ->from('{{%pages}} p')
                ->where('p.path = :path', [':path'=>$action])
                ->one();
            if($page) {
                Yii::$app->view->registerMetaTag([
                    'name' => 'description',
                    'content' => $page['description'],
                ]);
                Yii::$app->view->registerMetaTag([
                    'name' => 'keyword',
                    'content' => $page['meta_keywords'],
                ]);
                $page_template = $page['template'];
                $page_content = (new Query())
                    ->select('p.id, p.page_id, p.title, p.description, p.content')
                    ->from('{{%pages_contents}} p')
                    ->where('p.page_id = :page_id', [':page_id'=>$page['id']])
                    ->all();
            } else {
                throw new HttpException( 404, 'Page not found' );
            }
        }
        return $this->render($page_template, ['page_content'=>$page_content]);
    }

    public function init() {

        /*
        $this->view->on(View::EVENT_BEFORE_RENDER, function ($event) {
            Core::pre( View::EVENT_BEFORE_RENDER );
        });

        $this->view->on(View::EVENT_AFTER_RENDER, function ($event) {
            Core::pre( View::EVENT_AFTER_RENDER );
        });

        $this->view->on(View::EVENT_END_BODY, function ($event) {
            Core::pre( View::EVENT_END_BODY );
        });

        $this->view->on(View::EVENT_BEGIN_BODY, function ($event) {
            Core::pre( View::EVENT_BEGIN_BODY );
        });

        $this->view->on(View::EVENT_BEGIN_PAGE, function ($event) {
            Core::pre( View::EVENT_BEGIN_PAGE );
        });

        $this->view->on(View::EVENT_END_PAGE, function ($event) {
            Core::pre( View::EVENT_END_PAGE );
        });
        */
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
            'model' => $model
        ]);
    }

    public function actionTest() {
        echo JSON::encode([
            "id" => "1",
            "local" => "test"
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCorporative() {
        return $this->render('corporative');
    }

    public function actionFrames() {
        $frames = (new Query())
            ->select('f.id, f.name, f.description, f.path, f.status')
            ->from('{{%frames}} f')
            ->all();
        header('HTTP/1.1 200 OK');
        header('Content-type: application/json; charset=UTF-8');
        echo JSON::encode($frames);
    }

    public function actionFrames2() {
        $result = [];
        $input = file_get_contents('php://input');
        if( !empty($input) ) {
            $content = JSON::decode($input);
            $id = (int)$content['id'];
            $model = ($id === 0)
                ? new Frames()
                : Frames::find()->where(['id' => $id])->one();
            $model->setAttributes($content);
            if($model->save()) {
                $result['data'] = $model->getAttributes();
                $result['success'] = '';
            } else {
                $result['errors'] = $model->getErrors();
            }
        }
        echo JSON::encode($result);
    }

    public function actionEldamar() {
        MapleAsset::register($this->view);
        $frame_asset = (new \app\assets\FramesAsset);

        $frames = (new Query())
            ->select('f.id, f.name, f.description, f.path')
            ->from('{{%frames}} f')
            ->where(['id' => 1])
            ->all();

        try {
            foreach($frames as $index => $frame) {
                $frames[$index]['template'] = file_get_contents(Yii::getAlias('@webroot/' . $frame['path']));
                $scripts = $this->_frameScripts($frame['id']);
                $frame_asset->js = array_merge($frame_asset->js, $this->_assetsScripts($scripts));
                $frames[$index]['scripts'] = $scripts;
            }
        }
        catch(\Exception $e) {}
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
