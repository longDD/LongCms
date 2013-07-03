<?php

$current_conf = array(
        //'配置项'=>'配置值'
);

$common_conf = include(APP_COMMON . 'config.php');

return array_merge($current_conf, $common_conf);