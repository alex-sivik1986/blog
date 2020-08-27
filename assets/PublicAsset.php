<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	
//	public $jsOptions = [ 'position' => \yii\web\View::POS_HEAD ];
	
    public $css = [
        'frontend/css/bootstrap.min.css',
		'frontend/css/font-awesome.min.css', 
		'frontend/css/style.css',
		
		
    ];
    public $js = [
//		  'frontend/js/jquery.min.js',
		  'frontend/js/bootstrap.min.js',
		  'frontend/js/main.js',
		  'frontend/js/loadmore.js'
    ];
    public $depends = [
	      'yii\web\JqueryAsset'     
    ];
}
