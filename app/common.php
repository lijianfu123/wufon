<?php
/**
 * 应用公共文件
 */
define('ROOT_FOLDER', './'); //站点根目录
define('UPLOAD_FOLDER', 'upload'); //上传文件夹
define('MINUTE_SECONDS', 60); //1 分钟的秒数
define('HOUR_SECONDS', MINUTE_SECONDS * 60); //1 小时的秒数
define('DAY_SECONDS', HOUR_SECONDS * 24); //1 天的秒数

require('./app/common/util/function_util.php');
require('./app/common/util/control_util.php');
require('./app/common/util/url_util.php');