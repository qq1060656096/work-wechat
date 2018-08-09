<?php
namespace Zwei\WorkWechat;

use Zwei\WorkWechat\Exceptions\DataCallbackUrlException;

/**
 * 接收企业微信消息
 *
 * Class ReceiveMessage
 * @package Zwei\WorkWechat
 */
class ReceiveMessage
{
    /**
     *
     * 数据回调URL验证
     *
     * 注意请在"数据回调URL"增加参数corpid=$CORPID$
     *
     * @example DEMO1 数据回调URL: http://demo.com/?corpid=$CORPID$
     * @example DEMO2 数据回调URL: http://demo.com/qywx-callback/receive-message?corpid=$CORPID$
     *
     * @since  用于接收托管企业微信应用的用户消息和用户事件。
     * @since URL支持使用$CORPID$模板参数表示corpid，推送事件时企业微信会自动将其替换为授权企业的corpid。
     * @since (关于如何回调，请参考接收消息。注意验证时$CORPID$模板参数会替换为当前服务商的corpid，校验时也应该使用corpid初始化解密库)
     *
     * @see 企业微信服务商请看: https://work.weixin.qq.com/api/doc#10970
     * @see 数据回调URL: URL支持使用$CORPID$模板参数表示corpid
     *
     * @param string $token 用于生成签名校验回调请求的合法性
     * @param string $encodingAesKey 回调消息加解密参数, 是AES密钥的Base64编码, 用于解密回调消息内容对应的密文
     * @param string $corpId 授权企业的corpid(注意服务方,应该在数据回调URL设置该参数: 例如?corpid=$CORPID$)
     * @param array $data 企业微信callback携带参数
     *
     * @return string 解密后的明文
     * @throws DataCallbackUrlException
     */
    public function dataCallbackUrlValidate($token, $encodingAesKey, $corpId, array $data) {

        $wxcpt              = new \WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        $sVerifyMsgSig      = $data['msg_signature'];
        $sVerifyTimeStamp   = $data['timestamp'];
        $sVerifyNonce       = $data['nonce'];
        $sVerifyEchoStr     = $data['echostr'];
        // 需要返回的明文
        $sEchoStr = "";
        $errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);
        if ($errCode == 0) {
            return $sEchoStr;
        } else {
            throw new DataCallbackUrlException($errCode, "验证数据回调URL错误");
        }
    }
}