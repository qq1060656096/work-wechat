<?php
/**
 * Created by PhpStorm.
 * User: 赵思贵
 * Date: 2018/8/13
 * Time: 21:11
 */

namespace Zwei\WorkWechat\Contacts;

use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;

/**
 * 异步批量接口
 *
 * Interface AsyncApiDefineInterface
 * @package Zwei\WorkWechat\Contacts
 */
interface AsyncBatchApiDefineInterface
{
    /**
     * 增量更新成员
     * 请求方式：POST
     * @var string
     */
    const URL_USERS_INCREASE_UPDATE = 'https://qyapi.weixin.qq.com/cgi-bin/batch/syncuser?access_token=%s';

    /**
     * 全量覆盖成员
     * 请求方式：POST
     * @var string Full coverage
     */
    const URL_USERS_FULL_COVERAGE = 'https://qyapi.weixin.qq.com/cgi-bin/batch/replaceuser?access_token=%s';

    /**
     * 全量覆盖部门
     *
     * 请求方式：POST
     * @var string
     */
    const URL_DEPARTMENT_FULL_COVERAGE = 'https://qyapi.weixin.qq.com/cgi-bin/batch/replaceparty?access_token=%s';

    /**
     * 全量覆盖部门
     *
     * 请求方式：GET
     * @var string
     */
    const URL_GET_ASYNC_RESULT = 'https://qyapi.weixin.qq.com/cgi-bin/batch/getresult?access_token=%s&jobid=%s';

    /**
     *
     * @param string $accessToken 企业access_token
     * @param string $mediaId 上传的csv文件的media_id
     * @param bool $toInvite 是否邀请新建的成员使用企业微信
     * @param string $url 企业应用接收企业微信推送请求的访问协议和地址
     * @param string $token 用于生成签名
     * @param string $encodingaeskey 用于消息体的加密，是AES密钥的Base64编码
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function userIncreaseUpdate($accessToken, $mediaId, $toInvite = true, $url = null, $token = null, $encodingaeskey = null);


    /**
     * 全量覆盖成员
     * @param string $accessToken 企业access_token
     * @param string $mediaId 上传的csv文件的media_id
     * @param bool $toInvite 是否邀请新建的成员使用企业微信
     * @param string $url 企业应用接收企业微信推送请求的访问协议和地址
     * @param string $token 用于生成签名
     * @param string $encodingaeskey 用于消息体的加密，是AES密钥的Base64编码
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function userFullCoverage($accessToken, $mediaId, $toInvite = true, $url = null, $token = null, $encodingaeskey = null);

    /**
     * 全量覆盖部门
     * @param string $accessToken 企业access_token
     * @param string $mediaId 上传的csv文件的media_id
     * @param string $url 企业应用接收企业微信推送请求的访问协议和地址
     * @param string $token 用于生成签名
     * @param string $encodingaeskey 用于消息体的加密，是AES密钥的Base64编码
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function departmentFullCoverage($accessToken, $mediaId, $url = null, $token = null, $encodingaeskey = null);


    /**
     * @param string $accessToken 企业access_token
     * @param string $jobId 异步任务id，最大长度为64字节
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getAsyncResult($accessToken, $jobId);
}