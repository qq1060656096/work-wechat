<?php
/**
 * Created by PhpStorm.
 * User: 赵思贵
 * Date: 2018/8/13
 * Time: 21:47
 */

namespace Zwei\WorkWechat\Medias;

use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;

/**
 * 素材管理
 * Interface MdeiaApiDefineInterface
 * @package Zwei\WorkWechat\Medias
 */
interface MdeiaApiDefineInterface
{
    /**
     * 上传临时素材
     * 请求方式：POST
     * @var string
     */
    const URL_UPLOAD_TEMP = 'https://qyapi.weixin.qq.com/cgi-bin/media/upload?access_token=%s&type=%s';

    /**
     * 获取临时素材
     *
     * 请求方式：GET
     * @var string
     */
    const URL_GET_TEMP = 'https://qyapi.weixin.qq.com/cgi-bin/media/get?access_token=%s&media_id=%s';

    /**
     *
     * 获取高清语音素材
     *
     * 请求方式：GET
     * @var string
     */
    const URL_GET_HIGH = 'https://qyapi.weixin.qq.com/cgi-bin/media/get/jssdk?access_token=%s&media_id=%s';

    /**
     *
     * 上传图片
     *
     * 请求方式：POST
     * @var string
     */
    const URL_UPLOAD_IMAGE = 'https://qyapi.weixin.qq.com/cgi-bin/media/uploadimg?access_token=%s';



    /**
     *
     * 上传临时素材
     *
     * @param string $accessToken 调用接口凭证
     * @param string $type 类型
     * @param string $filePath 文件路径
     * @param null|string $body
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function updateTemp($accessToken, $type, $filePath, $body = null);

    /**
     *
     * 获取临时素材
     *
     * @param string $accessToken 调用接口凭证
     * @param string $mediaId 媒体文件id
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getTemp($accessToken, $mediaId);
}