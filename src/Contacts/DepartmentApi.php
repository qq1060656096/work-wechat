<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 21:53
 */

namespace Zwei\WorkWechat\Contacts;


use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;
use Zwei\WorkWechat\Helpers\CommonHelper;

/**
 * 企业微信部门api
 *
 * Class DepartmentApi
 * @package Zwei\WorkWechat\Contacts
 */
class DepartmentApi extends ApiBase implements DepartmentApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function create($accessToken, $name, $parentId = 1, $order = 1, $id = 0)
    {
        $data = [
            'id' => $id,
            'name'  => $name,
            'parentid' => $parentId,
            'order' => $order,
        ];
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_CREATE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function update($accessToken, $id, $name, $parentId = null, $order = null)
    {
        $data = [
            'id' => $id,
            'name'  => $name,
            'parentid' => $parentId,
            'order' => $order,
        ];
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_UPDATE, $accessToken);
        $response = $this->client->request('POST', $url, [
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }
    /**
     * @inheritdoc
     */
    public function delete($accessToken, $id)
    {
        $url = sprintf(self::URL_DELETE, $accessToken, $id);
        $response = $this->client->request('get', $url);
        return $this->parseApiResult($response);
    }
    /**
     * @inheritdoc
     */
    public function getList($accessToken, $id = 1)
    {
        $url = sprintf(self::URL_LIST, $accessToken, $id);
        $response = $this->client->request('get', $url);
        return $this->parseApiResult($response);
    }

}