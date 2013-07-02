<?php

$conf = array(
        //'配置项'=>'配置值'
);

$comConf = include APP_COMMON . 'config.php';
return array_merge($conf, $comConf);