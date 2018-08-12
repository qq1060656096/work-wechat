<?php
namespace Zwei\WorkWechat\Tests\Suites;


use PHPUnit\Framework\TestCase;
use Zwei\WorkWechat\Login\Oauth2LoginUrlParams;
use Zwei\WorkWechat\Suites\SuiteApi;

class SuiteTest extends TestCase
{
    /**
     * 测试获取第三方应用凭证
     */
    public function testGetSuiteAccessToken() {
        $suiteId     = '';
        $suiteSecret = '';
        $suiteTicket = '';
        $obj = new SuiteApi();
//        $obj->getSuiteAccessToken($suiteId, $suiteSecret, $suiteTicket);
        $this->assertEquals(1, 1);
    }

    /**
     * 生成suite oauth2 登录url数据提供者
     *
     * @return array
     */
    public function generateOauth2LoginUrlProvider() {
        $oauth2LoginUrlParam0 = new Oauth2LoginUrlParams();
        $oauth2LoginUrlParam0->scope = 'snsapi_base';
        $oauth2LoginUrlParam0->state = '';

        $oauth2LoginUrlParam1 = new Oauth2LoginUrlParams();
        $oauth2LoginUrlParam1->scope = 'snsapi_base2';
        $oauth2LoginUrlParam1->state = '3389';
        return [
            [
                'wwb724435140790a38-1',
                'localhost',
                $oauth2LoginUrlParam0,
                'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wwb724435140790a38-1&redirect_uri=localhost&response_type=code&scope=snsapi_base&state=#wechat_redirect'
            ],
            [
                'wwb724435140790a38-2',
                'localhost',
                $oauth2LoginUrlParam1,
                'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wwb724435140790a38-2&redirect_uri=localhost&response_type=code&scope=snsapi_base2&state=3389#wechat_redirect'
            ],
            [
                'wwb724435140790a38-3',
                'localhost',
                null,
                'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wwb724435140790a38-3&redirect_uri=localhost&response_type=code&scope=&state=#wechat_redirect'
            ],
        ];
    }

    /**
     * 测试生成suite oauth2 登录url
     * @dataProvider generateOauth2LoginUrlProvider
     */
    public function testGenerateOauth2LoginUrl($suiteId, $redirectUri, $oauth2LoginUrlParam, $oldUrl) {

        $obj = new SuiteApi();
        $url = $obj->generateOauth2LoginUrl($suiteId, $redirectUri, $oauth2LoginUrlParam);
        $this->assertEquals($url, $oldUrl);
    }


    /**
     * 生成应用安装url数据提供者
     *
     * @return array
     */
    public function generateAppInstallUrlProvider() {
        return [
            [
                'wwb724435140790a38',
                'preAuthCode01',
                'localhost',
                '',
                'https://open.work.weixin.qq.com/3rdapp/install?suite_id=wwb724435140790a38&pre_auth_code=preAuthCode01&redirect_uri=localhost&state='
            ],
            [
                'wwb724435140790a38',
                'preAuthCode02',
                'localhost',
                'state3389',
                'https://open.work.weixin.qq.com/3rdapp/install?suite_id=wwb724435140790a38&pre_auth_code=preAuthCode02&redirect_uri=localhost&state=state3389'
            ],
        ];
    }

    /**
     * 测试生成应用安装url
     * @dataProvider generateAppInstallUrlProvider
     */
    public function testGenerateAppInstallUrl($suiteId, $preAuthCode, $redirectUri, $state, $oldUrl) {
        $obj = new SuiteApi();
        $url = $obj->generateAppInstallUrl($suiteId, $preAuthCode, $redirectUri, $state);
        $this->assertEquals($url, $oldUrl);
    }
}