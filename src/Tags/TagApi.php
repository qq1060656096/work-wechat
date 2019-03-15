<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-03-15
 * Time: 11:38
 */

namespace Zwei\WorkWechat\Tags;


use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Helpers\CommonHelper;

class TagApi extends ApiBase implements TagApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function create($accessToken, $tagName, $tagId = null)
    {
        $data = [
            'tagname'   => $tagName,
            'tagid'     => $tagId,
        ];
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
    public function update($accessToken, $tagId, $tagName)
    {
        $data = [
            'tagname'   => $tagName,
            'tagid'     => $tagId,
        ];
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
    public function delete($accessToken, $tagId)
    {
        $url = sprintf(self::URL_DELETE, $accessToken, $tagId);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getUsers($accessToken, $tagId)
    {
        $url = sprintf(self::URL_GET_USERS, $accessToken, $tagId);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function addUsers($accessToken, $tagId, $userList, $partyList)
    {
        $data = [
            'tagid'     => $tagId,
            'userlist'  => $userList,
            'partylist' => $partyList,
        ];
        if (isset($data['userlist'])) {
            $data['userlist'] = array_values($data['userlist']);
        }
        if (isset($data['partylist'])) {
            $data['partylist'] = array_values($data['partylist']);
        }
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_ADD_USERS, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function delUsers($accessToken, $tagId, $userList, $partyList)
    {
        $data = [
            'tagid'     => $tagId,
            'userlist'  => $userList,
            'partylist' => $partyList,
        ];
        if (isset($data['userlist'])) {
            $data['userlist'] = array_values($data['userlist']);
        }
        if (isset($data['partylist'])) {
            $data['partylist'] = array_values($data['partylist']);
        }
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_DEL_USERS, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getList($accessToken)
    {
        $url = sprintf(self::URL_LIST, $accessToken);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

}