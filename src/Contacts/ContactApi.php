<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-12
 * Time: 16:37
 */

namespace Zwei\WorkWechat\Contacts;

use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Helpers\CommonHelper;

/**
 * 联系人api操作
 *
 * Class ContactApi
 * @package Zwei\WorkWechat\Contacts
 */
class ContactApi extends ApiBase implements ContactApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function create($accessToken, $userId, $name, $mobile, array $departmentIds, array $options = [])
    {
        $data = [
            'userid' => $userId,
            'name'  => $name,
            'mobile' => $mobile,
            'department' => $departmentIds,
        ];
        $data = array_merge($options, $data);
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_CREATE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }


    /**
     * @inheritdoc
     */
    public function get($accessToken, $userId)
    {
        $url = sprintf(self::URL_INFO, $accessToken, $userId);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }


    /**
     * @inheritdoc
     */
    public function update($accessToken, $userId, $name = null, $mobile = null, array $departmentIds = [], array $options = [])
    {
        $data = [
            'userid' => $userId,
            'name'  => $name,
            'mobile' => $mobile,
            'department' => $departmentIds,
        ];
        $data = array_merge($options, $data);
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_UPDATE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function delete($accessToken, $userId)
    {
        $url = sprintf(self::URL_DELETE, $accessToken, $userId);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        $result = $this->parseApiResult($response);
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function batchDelete($accessToken, array $userIds)
    {
        $data = [
            'useridlist' => $userIds,
        ];
        $url = sprintf(self::URL_BATCH_DELETE, $accessToken);
        $result = $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $result;
    }


    /**
     * @inheritdoc
     */
    public function getDepartmentUsersSimple($accessToken, $departmentId, $fetchChild = 0)
    {
        $url = sprintf(self::URL_DEPARTMENT_USERS_SIMPLE_INFO, $accessToken, $departmentId, $fetchChild);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }


    /**
     * @inheritdoc
     */
    public function getDepartmentUsersDetail($accessToken, $departmentId, $fetchChild = 0)
    {
        $url = sprintf(self::URL_DEPARTMENT_USERS_DETAIL_INFO, $accessToken, $departmentId, $fetchChild);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

}