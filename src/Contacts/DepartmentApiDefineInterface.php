<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 21:35
 */

namespace Zwei\WorkWechat\Contacts;

use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;

/**
 * 部门接口定义
 *
 * Class DepartmentApiDefineInterface
 * @package Zwei\WorkWechat\Contacts
 */
interface DepartmentApiDefineInterface
{
    /**
     * 创建部门
     * 请求方式：POST
     * @var string
     */
    const URL_CREATE = 'https://qyapi.weixin.qq.com/cgi-bin/department/create?access_token=%';

    /**
     * 更新部门
     * 请求方式：POST
     * @var string
     */
    const URL_UPDATE = 'https://qyapi.weixin.qq.com/cgi-bin/department/update?access_token=%s';

    /**
     * 删除部门
     * 请求方式：GET
     * @var string
     */
    const URL_DELETE = 'https://qyapi.weixin.qq.com/cgi-bin/department/delete?access_token=%s&id=%s';

    /**
     * 获取部门列表
     * 请求方式：GET
     * @var string
     */
    const URL_LIST = 'https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=%s&id=%s';

    /**
     * 创建部门
     *
     * @param string $accessToken 调用接口凭证
     * @param string $name 部门名称。长度限制为1~32个字符，字符不能包括\:?”<>｜
     * @param int $parentId 父部门id，32位整型
     * @param int $order 在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)
     * @param int $id 部门id，32位整型，指定时必须大于1。若不填该参数，将自动生成id
     * @return integer 成功返回部门id, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function create($accessToken, $name, $parentId = 1, $order = 1, $id = 0);


    /**
     * 更新部门
     *
     * null值则不更新该字段
     *
     * @param string $accessToken 调用接口凭证
     * @param int $id 部门id
     * @param string $name 部门名称。长度限制为1~32个字符，字符不能包括\:?”<>｜
     * @param int $parentId 父部门id，32位整型
     * @param int $order 在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)
     * @return bool 成功返回true, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function update($accessToken, $id, $name, $parentId = null, $order = null);

    /**
     * 删除部门
     *
     * null值则不更新该字段
     *
     * @param string $accessToken 调用接口凭证
     * @param int $id 部门id（注：不能删除根部门；不能删除含有子部门、成员的部门）
     * @return bool 成功返回true, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function delete($accessToken, $id);

    /**
     * 获取部门列表
     *
     * null值则不更新该字段
     *
     * @param string $accessToken 调用接口凭证
     * @param int $id 部门id。获取指定部门及其下的子部门。 如果null，默认获取全量组织架构
     * @return array 成功返回数组, 失败抛出异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getList($accessToken, $id = 1);
}