<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

include_once dirname(dirname(__DIR__)).'/vendor/autoload.php';


use Zwei\WorkWechat\ReceiveMessage;
use Zwei\WorkWechat\Exceptions\DataCallbackUrlException;


/**
 * 指令回调URL验证示例
 * http://qywx.you-bao.cn/work-wechat/tests/Examples/command-callback-url-validate.php?corpid=$CORPID$
 * http://qywx.you-bao.cn/work-wechat/tests/Examples/command-callback-url-validate.php?corpid=$CORPID$
 *
 * @todo 注意指令回调URL验证和数据回调URL验证是一样的, 但是指定回调要处理处理事件响应
 *
 *
 *
 *
 * http://qywx.you-bao.cn/work-wechat/tests/Examples/data-callback-url-validate.php?msg_signature=5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3&timestamp=1409659589&nonce=263014780&echostr=P9nAzCzyDtyTWESHep1vC5X9xho%2FqYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp%2B4RPcs8TgAE7OaBO%2BFZXvnaqQ%3D%3D
 * 企业微信文档地址: https://work.weixin.qq.com/api/doc#12977/%E9%AA%8C%E8%AF%81URL%E6%9C%89%E6%95%88%E6%80%A7
 *
 *
 */


$receiveMessage = new ReceiveMessage();

//*********************
// 指令回调URL 响应事件
//*********************

$eventRawData   = $receiveMessage->getEventRawData();
if ($eventRawData) {
    date_default_timezone_set('PRC'); //设置中国时区
    $data['1date'] = date('Y-m-d H;i;s');
    $data['2date'] = $eventRawData;
    $data = print_r($data, true);
    file_put_contents(__FILE__.'.txt', $data);
    echo "success";
    exit;
}

//****************
// 指令回调URL验证
//*****************


try {
    $token          = 'svSLryqHx';
    $encodingAesKey = 'VC2cNUGdzb2YLkVcWSXe0xII3qKabdAWAB1yBwc2Sod';
    $data           = $_GET;
    $corpId         = '';
    //$corpId         = 'wweace8ae2c27a051f';
    // 没有设置corpId通过url中获取, 请在数据回调中加入
    if (empty($corpId) && !empty($_GET['corpid'])) {
        $corpId = $_GET['corpid'];
    }
    $receiveMessage = new ReceiveMessage();
    $echoStr = $receiveMessage->dataCallbackUrlValidate($token, $encodingAesKey, $corpId, $data);
    echo $echoStr;
} catch (DataCallbackUrlException $e) {
    print("ERR: " . $e->getCode() . "\n\n");
}