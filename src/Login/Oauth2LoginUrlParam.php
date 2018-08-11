<?php
namespace Zwei\WorkWechat\Login;

use Zwei\WorkWechat\Base;
use Zwei\WorkWechat\Helpers\CommonHelper;

/**
 * Oauth2 登录 url 参数
 *
 * Class Oauth2LoginUrlParam
 * @package Zwei\WorkWechat\Login
 * @property string|null $scope 应用授权作用域
 * @property string|null $state 重定向后会带上state参数，企业可以填写a-zA-Z0-9的参数值，长度不可超过128个字节
 * @property string|null $agentId 企业应用的id: 当scope是snsapi_userinfo或snsapi_privateinfo时，该参数必填注意redirect_uri的域名必须与该应用的可信域名一致
 */
class Oauth2LoginUrlParam extends Base
{

    /**
     * 获取所有属性
     *
     * @return array
     */
    public function getAttributes() {
        return [
            'state'     => '应用授权作用域',
            'agentid'   => '重定向后会带上state参数',
            'scope'     => '企业应用的id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        $arr = $this->getAttributes();
        $arr = CommonHelper::deleteArrayNullValue($arr);
        $str = '';
        $str = http_build_query($arr);
        return $str;
    }
}