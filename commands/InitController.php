<?php
/**
 * InitController.php
 *
 * Author: Larry Li <larryli@qq.com>
 */

namespace app\commands;


use Yii;
use yii\console\Controller;

class InitController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->runAction('migrate/up');
        Yii::$app->runAction('ipv4/init');
    }
}