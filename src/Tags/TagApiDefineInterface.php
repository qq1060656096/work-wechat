<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-03-15
 * Time: 11:16
 */

namespace Zwei\WorkWechat\Tags;


interface TagApiDefineInterface
{
    /**
     * 创建标签url
     */
    const URL_CREATE = "https://qyapi.weixin.qq.com/cgi-bin/tag/create?access_token=%s";

    /**
     * 更新标签名字url
     */
    const URL_UPDATE = "https://qyapi.weixin.qq.com/cgi-bin/tag/update?access_token=%s";


    /**
     * 删除标签url
     */
    const URL_DELETE = "https://qyapi.weixin.qq.com/cgi-bin/tag/delete?access_token=%s&tagid=%s";


    /**
     * 获取标签成员url
     */
    const URL_GET_USERS = "https://qyapi.weixin.qq.com/cgi-bin/tag/get?access_token=%s&tagid=%s";


    /**
     * 增加标签成员url
     */
    const URL_ADD_USERS = "https://qyapi.weixin.qq.com/cgi-bin/tag/addtagusers?access_token=%S";

    /**
     * 删除标签成员url
     */
    const URL_DEL_USERS = "https://qyapi.weixin.qq.com/cgi-bin/tag/deltagusers?access_token=%s";

    /**
     * 获取标签列表url
     */
    const URL_LIST = "https://qyapi.weixin.qq.com/cgi-bin/tag/list?access_token=%s";

    /**
     * 创建标签
     *
     * @param string $accessToken 调用接口凭证
     * @param string $tagName 标签名称，长度限制为32个字（汉字或英文字母），标签不可与其他标签重名。
     * @param integer $tagId 标签id，非负整型，指定此参数时新增的标签会生成对应的标签id，不指定时则以目前最大的id自增。
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function create($accessToken, $tagName, $tagId = null);

    /**
     * 更新标签名字
     *
     * @param string $accessToken 调用接口凭证
     * @param integer $tagId 标签ID
     * @param string $tagName 标签名称，长度限制为32个字（汉字或英文字母），标签不可与其他标签重名。
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function update($accessToken, $tagId, $tagName);


    /**
     * 删除标签
     *
     * @param string $accessToken 调用接口凭证
     * @param integer $tagId 标签ID
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function delete($accessToken, $tagId);


    /**
     * 获取标签成员
     *
     * @param string $accessToken 调用接口凭证
     * @param integer $tagId 标签ID
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getUsers($accessToken, $tagId);


    /**
     * 增加标签成员
     *
     * @param string $accessToken 调用接口凭证
     * @param integer $tagId 标签ID
     * @param array $userList 企业成员ID列表，注意：userlist、partylist不能同时为空
     * @param array $partyList 企业部门ID列表，注意：userlist、partylist不能同时为空
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function addUsers($accessToken, $tagId, $userList, $partyList);


    /**
     * 删除标签成员
     * @param string $accessToken 调用接口凭证
     * @param integer $tagId 标签ID
     * @param array $userList 企业成员ID列表，注意：userlist、partylist不能同时为空
     * @param array $partyList 企业部门ID列表，注意：userlist、partylist不能同时为空
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function delUsers($accessToken, $tagId, $userList, $partyList);

    /**
     * 获取标签列表url
     *
     * @param $accessToken
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getList($accessToken);
}