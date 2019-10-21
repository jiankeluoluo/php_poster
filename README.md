# php 图片海报生成类

#### 介绍
由于工作中多处需要用到后端生成海报给微信H5或者小程序来分享，之前一直使用前端来生成，不过前端跨域什么的虽然能解决，但是还是麻烦，所以改用后端来生成。

#### 特点

1. 采用配置型输入，支持多张图片合并，支持png透明，支持图片圆角处理，支持长文本换行显示。可以返回处理好的海报图片数据流或者直接保存为图片；
2. 配合phpQrcode类库，可以实现生成二维码图片后再合并到海报中，支持生成的二维码叠加logo；
3. 占用内存小，运行示例中的图片，消耗内存：1.81 MB，如果不生成图片中的二维码 则只消耗内存：961.68 KB；


#### 软件架构
php

#### 示例

![输入图片说明](https://images.gitee.com/uploads/images/2019/1016/185853_e5bed5d7_400321.png "在这里输入图片标题")


#### 安装教程

直接运行

#### 使用说明


```
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
//用法一：设置保存路径
poster::make('./img/demo.png');

//用法二：返回数据流
$res = poster::make();
if (!$res) {
    echo '生成失败：', poster::getErrMessage();
} else {
    header("content-type:image/png");
    echo $res;
}

//是否要清理缓存资源
poster::clear();
```

#### 生成二维码

include './inc/phpQrcode.class.php';//由phpQrcode改造，新增返回数据流方法

//二维码生成内容
$code = 'https://www.baidu.com/';

//方法一：生成二维码图片数据流
$qrCodeData = QRcode::pngData($code, 13);

//方法二：生成指定路径图片
QRcode::png($code, './img/qrcode.png',QR_ECLEVEL_L,3,13);

#### 默认配置参数

图片类默认配置参数

```
array(
     'url' => '', //图片路径
     'stream' => 0, //图片数据流，与url二选一
     'left' => 0,//左边距
     'top' => 0,//上边距
     'right' => 0,//有边距
     'bottom' => 0,//下边距
     'width' => 0,//宽
     'height' => 0,//高
     'radius' => 0, //圆角度数，最大值为显示宽度的一半
     'opacity' => 100//透明度
)
```

文本类默认配置参数

```
array(
      'text' => '',//显示文本
      'left' => 0,//左边距
      'top' => 0,//上边距
      'width' => 0, //文本框宽度，设置后可实现文字换行
      'fontSize' => 32, //字号
      'fontPath' => 'msyh.ttf', //字体文件
      'fontColor' => '255,255,255', //字体颜色
      'angle' => 0, //倾斜角度
)
```
