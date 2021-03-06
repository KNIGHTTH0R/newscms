<?php
/**
 * Created by PhpStorm.
 * User: edifanov
 * Date: 10.11.17
 * Time: 0:11
 */

namespace app\modules\main;

use yii\base\BootstrapInterface;
use Yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/main/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/main/messages',
            'fileMap' => [
                'modules/main/module' => 'module.php',
            ],
        ];
    }
}