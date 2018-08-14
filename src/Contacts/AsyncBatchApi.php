<?php
/**
 * Created by PhpStorm.
 * User: 赵思贵
 * Date: 2018/8/13
 * Time: 21:40
 */

namespace Zwei\WorkWechat\Contacts;


use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;
use Zwei\WorkWechat\Helpers\CommonHelper;

/**
 *
 * 异步批量接口
 *
 * Class AsyncBatchApi
 * @package Zwei\WorkWechat\Contacts
 */
class AsyncBatchApi extends ApiBase implements AsyncBatchApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function userIncreaseUpdate($accessToken, $mediaId, $toInvite = true, $url = null, $token = null, $encodingaeskey = null)
    {
        $data = [
            'media_id' => $mediaId,
            'to_invite' => $toInvite,
            'callback' => [
                'url' => $url,
                'token' => $token,
                'encodingaeskey' => $encodingaeskey,
            ],
        ];
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_USERS_INCREASE_UPDATE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function userFullCoverage($accessToken, $mediaId, $toInvite = true, $url = null, $token = null, $encodingaeskey = null)
    {
        $data = [
            'media_id' => $mediaId,
            'to_invite' => $toInvite,
            'callback' => [
                'url' => $url,
                'token' => $token,
                'encodingaeskey' => $encodingaeskey,
            ],
        ];
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_USERS_FULL_COVERAGE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function departmentFullCoverage($accessToken, $mediaId, $url = null, $token = null, $encodingaeskey = null)
    {
        $data = [
            'media_id' => $mediaId,
            'callback' => [
                'url' => $url,
                'token' => $token,
                'encodingaeskey' => $encodingaeskey,
            ],
        ];
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_DEPARTMENT_FULL_COVERAGE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getAsyncResult($accessToken, $jobId)
    {
        $url = sprintf(self::URL_GET_ASYNC_RESULT, $accessToken, $jobId);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

}