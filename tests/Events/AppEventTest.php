<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 23:43
 */

namespace Zwei\WorkWechat\Tests\Events;

use PHPUnit\Framework\TestCase;
use Zwei\WorkWechat\Events\AppEvent;
use Zwei\WorkWechat\Events\AppEventResult;
use Zwei\WorkWechat\Events\Receives\StandardEventReceive;
use Zwei\WorkWechat\Events\Receives\SuiteEventReceive;

class AppEventTest extends TestCase
{
    /**
     * 获取测试日志文件名
     * @return string
     */
    public static function getTestLogFileName() {
        $testLogFileName = dirname(__DIR__).'/Logs/'.basename(__FILE__).'.test.log';
        return $testLogFileName;
    }

    /**
     * 添加测试日志文件
     * @param $strLog
     */
    public static function appendLog($strLog) {
        $testLogFileName = static::getTestLogFileName();
        $content = @file_get_contents($testLogFileName);
        file_put_contents($testLogFileName, $content.$strLog);
    }

    /**
     * 测试生成回调url连接数据提供者
     * @return array
     */
    public function generateCallbackValidateUrlProvider() {
        return [
            [
                '正式环境数据回调url',
                'http://b5e5e082.ngrok.io/crm/qywx/api/zntk/v1/call-back-url2/app',
                [],
                '',
            ],
            [
                '测试环境数据回调url',
                'http://localhost/crm/qywx/api/zntk/v1/call-back-url2/app',
                [],
                '',
            ],
            // 测试数据回调验证url
            [
                '测试环境测试推送 suite_ticket',
                'http://localhost/crm/qywx/api/zntk/v1/call-back-url2/app',
                $params = [
                    'msg_signature' => '0bd3ab65298925cf7ac599f0c1ec9e498a94ee9e',
                    'timestamp' => '1534001585',
                    'nonce' => '1534034077',
                    'echostr' => 'UMySWpVUSOxs1oy2mmDRVFZmYsSEjj5FuCGxdAjl0Ujrx7Pw6dcOUfXpPlZ6RKRcIYmgjXG2KsDOSF5+naNpdw==',
                    'corpid' => 'wweace8ae2c27a051f',
                ],
                '',
            ],

            [
                '正式环境 推送 suite_ticket',
                'http://b5e5e082.ngrok.io/crm/qywx/api/zntk/v1/call-back-url2/app',
                [],
                '',
            ],
            [
                '测试环境 推送 suite_ticket',
                'http://localhost/crm/qywx/api/zntk/v1/call-back-url2/app',
                [],
                '',
            ],
            // 测试数据回调验证url
            [
                '测试环境测 试推送 suite_ticket',
                'http://localhost/crm/qywx/api/zntk/v1/call-back-url2/app',
                $params = [
                    'msg_signature' => 'ac0c0beb0f0378a894436a313e7486c7a54d7099',
                    'timestamp' => '1533862253',
                    'nonce' => '1533702735',
                    'corpid' => 'wweace8ae2c27a051f',
                ],
                '<xml><ToUserName><![CDATA[wwb724435140790a38]]></ToUserName><Encrypt><![CDATA[KK1HmszOCAuQCX2igRNjC3ym1yHMbBpUrIxNlBvEM8LxvNiixUfBckcUTmI4ronITtrTxkwxIi2hyHxaD6NT4L4yOjq+s5A34w4s4ZMmVX6S4tanP6gi4fx6bEhIJQYQL7vjppUicprM09VyLe+JkPuxt9ytqB1n2AdukwbgfT5tCT0kE73QN0XDHNXaaXJEJFpAwQ+DtoLPWE2iZF0ehhy/QbnYxXisNTOt4Npx2imrhCjD3nKmydoX3yQHKtJN6liiPq/sE9zkRrh0MqucSMko4SJLf1l/q+Xr9akgbQgsfienA0mwqXriAJCDjzCUfMm6ouL18lBYEz6ZhHjNw1qap5vYwkJw2uWPFzEYA13H0gZjIorFHYR70msvBgA9]]></Encrypt><AgentID><![CDATA[]]></AgentID></xml>',
            ],
        ];
    }
    /**
     * 测试生成回调url连接
     * @dataProvider generateCallbackValidateUrlProvider
     */
    public function testGenerateCallbackValidateUrl($envName, $url, $params, $body) {

        $suiteEventReceive      = new SuiteEventReceive();
        $standardEventReceive   = new StandardEventReceive();
        $obj = new AppEvent($suiteEventReceive, $standardEventReceive);
        $callbackValidateUrl = $obj->generateCallbackUrl($url, $params);
        $strLog = <<<str

[date: %s] %s
%s
str;
        $strLog = sprintf($strLog, date('Y-m-d H;i:s'), $envName, $callbackValidateUrl);
        if (!empty($body)) {
            $strLog .= "\nxml:\n{$body}\n\n";
        } else {
            $strLog.="\n\n";
        }
        self::appendLog($strLog);
        $this->assertStringEndsWith('corpid=%24CORPID%24', $callbackValidateUrl);
    }

    /**
     * 测试处理数据回调验证
     */
    public function testProcessCallbackUrlValidate() {
        $_GET = [
            'msg_signature' => '0bd3ab65298925cf7ac599f0c1ec9e498a94ee9e',
            'timestamp' => '1534001585',
            'nonce' => '1534034077',
            'echostr' => 'UMySWpVUSOxs1oy2mmDRVFZmYsSEjj5FuCGxdAjl0Ujrx7Pw6dcOUfXpPlZ6RKRcIYmgjXG2KsDOSF5+naNpdw==',
            'corpid' => 'wweace8ae2c27a051f',
        ];
        $token                  = 'svSLryqHx';
        $encodingAesKey         = 'VC2cNUGdzb2YLkVcWSXe0xII3qKabdAWAB1yBwc2Sod';
        $suiteEventReceive      = new SuiteEventReceive();
        $standardEventReceive   = new StandardEventReceive();
        $isProcessEvent         = true;
        // 处理回调url验证
        // 处理企业微信推送事件
        $obj = new AppEvent($suiteEventReceive, $standardEventReceive, $isProcessEvent);
        $appEventResult = $obj->processCallback($token, $encodingAesKey);
        $this->assertEquals($appEventResult->getEchoString(), '1623209352636626933');
        $this->assertEquals($appEventResult->getEchoString(), $appEventResult->getEventHandleResult());
        $this->assertEquals($appEventResult->getType(), AppEventResult::TYPE_VALIDATE_URL);
    }

    /**
     * 测试发送 suite_ticket
     *
     */
    public function testSendSuiteTicket_ProcessEventCallback() {
        $_GET = [
            'msg_signature' => 'ac0c0beb0f0378a894436a313e7486c7a54d7099',
            'timestamp' => '1533862253',
            'nonce' => '1533702735',
        ];
        $GLOBALS['HTTP_RAW_POST_DATA'] = '<xml><ToUserName><![CDATA[wwb724435140790a38]]></ToUserName><Encrypt><![CDATA[KK1HmszOCAuQCX2igRNjC3ym1yHMbBpUrIxNlBvEM8LxvNiixUfBckcUTmI4ronITtrTxkwxIi2hyHxaD6NT4L4yOjq+s5A34w4s4ZMmVX6S4tanP6gi4fx6bEhIJQYQL7vjppUicprM09VyLe+JkPuxt9ytqB1n2AdukwbgfT5tCT0kE73QN0XDHNXaaXJEJFpAwQ+DtoLPWE2iZF0ehhy/QbnYxXisNTOt4Npx2imrhCjD3nKmydoX3yQHKtJN6liiPq/sE9zkRrh0MqucSMko4SJLf1l/q+Xr9akgbQgsfienA0mwqXriAJCDjzCUfMm6ouL18lBYEz6ZhHjNw1qap5vYwkJw2uWPFzEYA13H0gZjIorFHYR70msvBgA9]]></Encrypt><AgentID><![CDATA[]]></AgentID></xml>';
        $token                  = 'svSLryqHx';
        $encodingAesKey         = 'VC2cNUGdzb2YLkVcWSXe0xII3qKabdAWAB1yBwc2Sod';
        $suiteEventReceive      = new SuiteEventReceive();
        $standardEventReceive   = new StandardEventReceive();
        $isProcessEvent         = true;
        // 处理回调url验证
        // 处理企业微信推送事件
        $obj = new AppEvent($suiteEventReceive, $standardEventReceive, $isProcessEvent);
        $appEventResult = $obj->processCallback($token, $encodingAesKey);
        $this->assertEquals($appEventResult->getEchoString(), 'success');
        $this->assertEquals($appEventResult->getType(), AppEventResult::TYPE_EVENT);
        $this->assertEquals($appEventResult->getEventHandleResult()['return'], 'doing_suite_ticket');
    }
}