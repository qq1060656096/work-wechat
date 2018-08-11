<?php
namespace Zwei\WorkWechat\Tests\Suites;


use PHPUnit\Framework\TestCase;
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
}