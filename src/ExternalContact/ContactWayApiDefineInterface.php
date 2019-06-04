<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-06-04
 * Time: 13:33
 */
namespace Zwei\WorkWechat\Contacts;

interface ContactWayApiDefineInterface
{
    /**
     * 配置客户联系「联系我」方式
     * 请求方式：POST
     * @var string
     */
    const URL_ADD = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/add_contact_way?access_token=%s";

    /**
     * 获取企业已配置的「联系我」方式
     * 请求方式：POST
     * @var string
     */
    const URL_GET = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/get_contact_way?access_token=%s";

    /**
     * 更新企业已配置的「联系我」方式
     * 请求方式：POST
     * @var string
     */
    const URL_UPDATE = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/update_contact_way?access_token=%s";

    /**
     * 删除企业已配置的「联系我」方式
     * 请求方式：POST
     * @var string
     */
    const URL_DEL = "https://qyapi.weixin.qq.com/cgi-bin/externalcontact/del_contact_way?access_token=%s";

    /**
     * 配置客户联系「联系我」方式
     * @param string $accessToken
     * @param integer $type 联系方式类型,1-单人, 2-多人
     * @param integer $scene 场景，1-在小程序中联系，2-通过二维码联系
     * @param array $userIds 使用该联系方式的用户userID列表，在type为1时为必填，且只能有一个
     * @param integer|null $style 在小程序中联系时使用的控件样式，详见附表
     * @param string $remark 联系方式的备注信息，用于助记，不超过30个字符
     * @param boolean $skipVerify 外部客户添加时是否无需验证，默认为true
     * @param string $state 企业自定义的state参数，用于区分不同的添加渠道，在调用“获取外部联系人详情”时会返回该参数值
     * @param array $party 使用该联系方式的部门id列表，只在type为2时有效
     * @return mixed
     */
    public function add($accessToken, $type, $scene, array $userIds, $style = null, $remark = "", $skipVerify = true, $state = "", array $party = []);


    /**
     * 获取企业已配置的「联系我」方式
     *
     * @param string $accessToken 调用接口凭证
     * @param string $configId 联系方式的配置id
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function get($accessToken, $configId);


    /**
     * 配置客户联系「联系我」方式
     * @param string $accessToken
     * @param string $configId 联系方式的配置id
     * @param array $userIds 使用该联系方式的用户userID列表，在type为1时为必填，且只能有一个
     * @param integer|null $style 在小程序中联系时使用的控件样式，详见附表
     * @param string $remark 联系方式的备注信息，用于助记，不超过30个字符
     * @param boolean $skipVerify 外部客户添加时是否无需验证，默认为true
     * @param string $state 企业自定义的state参数，用于区分不同的添加渠道，在调用“获取外部联系人详情”时会返回该参数值
     * @param array $party 使用该联系方式的部门id列表，只在type为2时有效
     * @return mixed
     */
    public function update($accessToken, $configId, array $userIds, $style = null, $remark = "", $skipVerify = true, $state = "", array $party = []);


    /**
     * 删除企业已配置的「联系我」方式
     *
     * @param string $accessToken 调用接口凭证
     * @param string $configId 联系方式的配置id
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function delete($accessToken, $configId);
}