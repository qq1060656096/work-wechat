<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-14
 * Time: 08:21
 */

namespace Zwei\WorkWechat\Medias;


use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;
use Zwei\WorkWechat\Helpers\CommonHelper;

class MdeiaApi extends ApiBase implements MdeiaApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function updateTemp($accessToken, $type, $filePath)
    {
        $data = [
            [
                'name' => 'media',
                'contents' => fopen($filePath, 'r'),
            ]
        ];
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_UPLOAD_TEMP, $accessToken, $type);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'multipart' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getTemp($accessToken, $mediaId)
    {
        $url = sprintf(self::URL_GET_TEMP, $accessToken, $mediaId);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getHigh($accessToken, $mediaId)
    {
        $url = sprintf(self::URL_GET_HIGH, $accessToken, $mediaId);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function updateImage($accessToken, $type, $filePath, $body = null)
    {
        $data = [
            [
                'name' => 'media',
                'contents' => fopen($filePath, 'r'),
            ]
        ];
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_UPLOAD_IMAGE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'multipart' => $data,
        ]);
        return $this->parseApiResult($response);
    }

}