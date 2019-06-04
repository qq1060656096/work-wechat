<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-06-04
 * Time: 11:47
 */
namespace Zwei\WorkWechat\Contacts;

use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Helpers\CommonHelper;

class ContactWayApi extends ApiBase implements ContactWayApiDefineInterface
{

    /**
     * @inheritdoc
     */
    public function add($accessToken, $type, $scene, array $userIds, $style = null, $remark = "", $skipVerify = true, $state = "", array $party = [])
    {
        $data = [
            "type"  => $type,
            "scene" => $scene,
            "style" => $style,
            "remark" => $remark,
            "skip_verify" => $skipVerify,
            "state" => $state,
            "user" => $userIds,
            "party" => $party,
        ];
        $data = array_merge($data);
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_ADD, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function get($accessToken, $configId)
    {
        $data = [
            'config_id' => $configId,
        ];
        $url = sprintf(self::URL_GET, $accessToken);
        $response = $this->client->request('post', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function update($accessToken, $configId, array $userIds, $style = null, $remark = "", $skipVerify = true, $state = "", array $party = [])
    {
        $data = [
            "config_id"  => $configId,
            "style" => $style,
            "remark" => $remark,
            "skip_verify" => $skipVerify,
            "state" => $state,
            "user" => $userIds,
            "party" => $party,
        ];
        $data = array_merge($data);
        $data = CommonHelper::deleteArrayNullValue($data);
        $url = sprintf(self::URL_ADD, $accessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function delete($accessToken, $configId)
    {
        $data = [
            'config_id' => $configId,
        ];
        $url = sprintf(self::URL_DEL, $accessToken);
        $response = $this->client->request('post', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        $result = $this->parseApiResult($response);
        return $result;
    }
}