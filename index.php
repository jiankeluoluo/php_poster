<?php

include './inc/phpQrcode.class.php';
include './inc/poster.class.php';

//辅助类函数，转换单位
function changeFileSize($size, $dec = 2) {
    $a = array('Byte', 'KB', 'MB', 'GB', 'TB', 'PB');
    $pos = 0;
    while ($size >= 1024) {
        $size /= 1024;
        $pos++;
    }
    return round($size, $dec) . ' ' . $a[$pos];
}

//二维码生成内容
$code = 'https://www.baidu.com/';
//生成二维码图片
$qrCodeData = QRcode::pngData($code, 13);

$config = array(
    'bg_url' => './img/timg.png',//背景图片路径
    'text' => array(
        array(
            'text' => '初夏',//文本内容
            'left' => 312, //左侧字体开始的位置
            'top' => 676, //字体的下边框
            'fontSize' => 16, //字号
            'fontColor' => '255,0,0', //字体颜色
            'angle' => 0,
        ),
        array(
            'text' => '你不运动，地球也会动',
            'left' => 310,
            'top' => 720,
            'width' => 400,
            'fontSize' => 16, //字号
            'fontColor' => '0,0,80', //字体颜色
            'angle' => 0,
        ),
        array(
            'text' => '好嗨哟~',
            'left' => 507,
            'top' => 760,
            'width' => 400,
            'fontSize' => 25, //字号
            'fontColor' => '0,175,80', //字体颜色
            'angle' => -50,
        ),
        array(
            'text' => '做梦吧你，哈哈',
            'left' => 460,
            'top' => 650,
            'width' => 400,
            'fontSize' => 30, //字号
            'fontColor' => '0,0,80', //字体颜色
            'angle' => 20,
        ),
    ),
    'image' => array(
        array(
            'url' => './img/02.jpg',
            'stream' => 0, //图片资源是否是字符串图像流
            'left' => 202,
            'top' => 639,
            'right' => 0,
            'bottom' => 0,
            'width' => 100,
            'height' => 100,
            'radius' => 50,
            'opacity' => 100
        ),
        array(
            'url' => './img/03.png',
            'stream' => 0,
            'left' => 507,
            'top' => 590,
            'right' => 0,
            'bottom' => 0,
            'width' => 108,
            'height' => 108,
            'radius' => 0,
            'opacity' => 100
        ),
        array(
            'url' => '',
            'stream' => $qrCodeData,
            'left' => 273,
            'top' => 844,
            'right' => 0,
            'bottom' => 0,
            'width' => 184,
            'height' => 184,
            'radius' => 0,
            'opacity' => 100
        ),
        array(
            'url' => './img/01.jpg',
            'stream' => 0,
            'left' => 335,
            'top' => 910,
            'right' => 0,
            'bottom' => 0,
            'width' => 50,
            'height' => 50,
            'radius' => 0,
            'opacity' => 100
        ),
    )
);

//设置海报背景图
poster::setConfig($config);
//设置保存路径
$res = poster::make();
//是否要清理缓存资源
poster::clear();
if (!$res) {
    echo '生成失败：', poster::getErrMessage();
} else {
    header("content-type:image/png");
    echo $res;
}
//echo '消耗内存：', changeFileSize(memory_get_usage());
