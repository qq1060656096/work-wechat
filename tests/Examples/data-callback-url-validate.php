<?php
include_once dirname(dirname(__DIR__)).'/vendor/autoload.php';

use Zwei\WorkWechat\ReceiveMessage;
use Zwei\WorkWechat\Exceptions\DataCallbackUrlException;


/**
 * 数据回调URL验证示例
 *
 *
 * http://你的域名/work-wechat/tests/Examples/data-callback-url-validate.php?corpid=$CORPID$
 *
 * 企业微信文档地址: https://work.weixin.qq.com/api/doc#12977/%E9%AA%8C%E8%AF%81URL%E6%9C%89%E6%95%88%E6%80%A7
 */
try {
    $token          = 'svSLryqHx';
    $encodingAesKey = 'VC2cNUGdzb2YLkVcWSXe0xII3qKabdAWAB1yBwc2Sod';
    $data           = $_GET;
    $corpId         = 'wweace8ae2c27a051f';
    // 没有设置corpId通过url中获取, 请在数据回调中加入
    if (empty($corpId) && !empty($_GET['corpid'])) {
        $corpId = $_GET['corpid'];
    }
    $receiveMessage = new ReceiveMessage();
    $echoStr = $receiveMessage->dataCallbackUrlValidate($token, $encodingAesKey, $corpId, $data);
    var_dump($echoStr);
} catch (DataCallbackUrlException $e) {
    print("ERR: " . $e->getCode() . "\n\n");
}