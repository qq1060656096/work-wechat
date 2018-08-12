<?php
/**
 * Created by PhpStorm.
 * User: drupal
 * Date: 2018/8/11
 * Time: 6:19
 */

namespace Zwei\WorkWechat\Contacts;

/**
 * 联系人api
 *
 * Interface ContactApiDefineInterface
 * @package Zwei\WorkWechat\Contacts
 */
interface ContactApiDefineInterface
{
    /**
     * 创建成员
     * 请求方式：POST
     * @var string
     */
    const URL_CREATE = 'https://qyapi.weixin.qq.com/cgi-bin/user/create?access_token=%s';

    /**
     * 读取成员
     * 请求方式：GET
     * @var string
     */
    const URL_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token=%s&userid=%s';

    /**
     * 更新成员
     * 请求方式：POST
     * @var string
     */
    const URL_UPDATE = 'https://qyapi.weixin.qq.com/cgi-bin/user/update?access_token=%s';

    /**
     * 删除成员
     * 请求方式：GET
     * @var string
     */
    const URL_DELETE = 'https://qyapi.weixin.qq.com/cgi-bin/user/delete?access_token=%s&userid=%s';

    /**
     * 批量删除成员
     * 请求方式：POST
     * @var string
     */
    const URL_BATCH_DELETE = 'https://qyapi.weixin.qq.com/cgi-bin/user/batchdelete?access_token=%s';

    /**
     * 获取部门成员
     * 请求方式：GET
     * @var string
     */
    const URL_DEPARTMENT_USERS_SIMPLE_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/user/simplelist?access_token=%s&department_id=%s&fetch_child=%s';

    /**
     * 获取部门成员详情
     * 请求方式：GET
     * @var string
     */
    const URL_DEPARTMENT_USERS_DETAIL_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token=%s&department_id=%s&fetch_child=%s';

    /**
     * 创建成员
     *
     * @param string $accessToken 调用接口凭证
     * @param int $userId 成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节
     * @param string $name 成员名称。长度为1~64个字符
     * @param string $mobile 手机号码。企业内必须唯一，mobile/email二者不能同时为空
     * @param array $departmentIds 成员所属部门id列表,不超过20个
     * @param array $options 可选值,请看企业微信成员管理文档
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function create($accessToken, $userId, $name, $mobile, array $departmentIds, array $options = []);

    /**
     * 读取成员
     *
     * @param string $accessToken 调用接口凭证
     * @param int $userId 成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function get($accessToken, $userId);

    /**
     * 更新成员
     *
     * @param string $accessToken 调用接口凭证
     * @param int $userId 成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节
     * @param null|string $name 成员名称。长度为1~64个字符
     * @param null|string $mobile 手机号码。企业内必须唯一，mobile/email二者不能同时为空
     * @param array $departmentIds 成员所属部门id列表,不超过20个
     * @param array $options 可选值,请看企业微信成员管理文档
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function update($accessToken, $userId, $name = null, $mobile = null, array $departmentIds = [], array $options = []);

    /**
     * 删除成员
     *
     * @param string $accessToken 调用接口凭证
     * @param int $userId 成员UserID。对应管理端的帐号，企业内必须唯一。不区分大小写，长度为1~64个字节
     * @return bool 成功返回true, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function delete($accessToken, $userId);

    /**
     * 删除成员
     *
     * @param string $accessToken 调用接口凭证
     * @param array $userIds 成员UserID列表。对应管理端的帐号。最多支持200个。若存在无效UserID，直接返回错误
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function batchDelete($accessToken, array $userIds);

    /**
     * 获取部门成员
     *
     * @param string $accessToken 调用接口凭证
     * @param integer $departmentId 部门id
     * @param integer $fetchChild 1/0：是否递归获取子部门下面的成员
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getDepartmentUsersSimple($accessToken, $departmentId, $fetchChild = 0);

    /**
     * 获取部门成员详情
     *
     * @param string $accessToken 调用接口凭证
     * @param integer $departmentId 部门id
     * @param integer $fetchChild 1/0：是否递归获取子部门下面的成员
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getDepartmentUsersDetail($accessToken, $departmentId, $fetchChild = 0);
}