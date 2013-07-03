<?php

//原样输出
function P($cont) {
    echo '<pre>';
    print_r($cont);
    echo '</pre>';
}

//My md5
function myMd5($cont) {
    $prefix = C('ENCRYPT_CONSTANT') ? C('ENCRYPT_CONSTANT') : 'longdd';
    return md5($prefix . $cont);
}

