<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

include_once dirname(dirname(__DIR__)).'/vendor/autoload.php';

use Zwei\WorkWechat\ReceiveMessage;
use Zwei\WorkWechat\Exceptions\DataCallbackUrlException;


/**
 * 数据回调URL验证示例
 *
 *
 * http://你的域名/work-wechat/tests/Examples/data-callback-url-validate.php?corpid=$CORPID$
 * http://qywx.you-bao.cn/work-wechat/tests/Examples/data-callback-url-validate.php?corpid=$CORPID$
 *
 * http://qywx.you-bao.cn/work-wechat/tests/Examples/data-callback-url-validate.php?msg_signature=5c45ff5e21c57e6ad56bac8758b79b1d9ac89fd3&timestamp=1409659589&nonce=263014780&echostr=P9nAzCzyDtyTWESHep1vC5X9xho%2FqYX3Zpb4yKa9SKld1DsH3Iyt3tP3zNdtp%2B4RPcs8TgAE7OaBO%2BFZXvnaqQ%3D%3D
 * 企业微信文档地址: https://work.weixin.qq.com/api/doc#12977/%E9%AA%8C%E8%AF%81URL%E6%9C%89%E6%95%88%E6%80%A7
 *
 *
 */
try {
    $token          = 'dfSuTFE5AV';
    $encodingAesKey = 'QwDwFIirnFrlsByRXvXWMOcutCohYujsXJle4EqhsQx';
    $data           = $_GET;
    $corpId         = '';
    $corpId         = 'wweace8ae2c27a051f';
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