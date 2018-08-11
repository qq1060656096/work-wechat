<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 12:20
 */

namespace Zwei\WorkWechat\Tests\Heplers;


use PHPUnit\Framework\TestCase;
use Zwei\WorkWechat\Helpers\CommonHelper;

class CommonHelperTest extends TestCase
{
    /**
     * 测试url增加参数
     */
    public function testUrlAppendParams() {
        $url = 'http://localhost/test.php?corpid=$CORPID$';
        $params = [
            'app-name' => 'test',
        ];
        $newUrl = CommonHelper::urlAppendParams($url, $params);
        $this->assertEquals($newUrl, 'http://localhost/test.php?corpid=%24CORPID%24&app-name=test');
    }
}