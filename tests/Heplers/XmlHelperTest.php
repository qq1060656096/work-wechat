<?php
namespace  Zwei\WorkWechat\Tests\Heplers;


use PHPUnit\Framework\TestCase;
use Zwei\WorkWechat\Helpers\XmlHelper;

/**
 * 测试xml解析
 *
 * Class XmlHelperTest
 * @package Zwei\WorkWechat\Tests\Heplers
 */
class XmlHelperTest extends TestCase
{
    /**
     * 测试解析企业微信推送的加密 suite_ticket 的xml
     */
    public function testParseEncryptSuiteTicketXml() {
        $xml    = '<xml><ToUserName><![CDATA[wwb724435140790a38]]></ToUserName><Encrypt><![CDATA[gSjERy70KI7c8Il2M9FnK98uVZgy0wct8f7kExk/YSprq9Bkz/7pUb75VfAodRYskwAAKs13vQGId/oVe2ju6zPDz2wFF8oJpiQk/gvAw0ahWUx2bDGNx0hGKlO07ljPZFr8SZStPKfsYOBsihPjFKirbTFYCAF0a+Om0Pf1cSL7+HH13Fe+oeIgZ+Lj+NYk+5oPFuxW271Vy89capEluIAqXvnIT7+vLJHV3W/Qgrlk4oGqEQydmKhSwuOUX/a5UudBttlCFRB0v16IeRO84NyHmtoY2XlslPD5Gkmds8XyDRqhuDGKGmc7i6cPfPmt3X5IfurA1VMnIVp+LnoQOotO73UyS/TaCHLRUSNydWPJJWI+0WKwbY/6Meze10zU]]></Encrypt><AgentID><![CDATA[]]></AgentID></xml>';
        $array  = XmlHelper::xmlToArray($xml);
        $this->assertEquals('wwb724435140790a38', $array['ToUserName']);
        $this->assertEquals(trim($array['Encrypt']), 'gSjERy70KI7c8Il2M9FnK98uVZgy0wct8f7kExk/YSprq9Bkz/7pUb75VfAodRYskwAAKs13vQGId/oVe2ju6zPDz2wFF8oJpiQk/gvAw0ahWUx2bDGNx0hGKlO07ljPZFr8SZStPKfsYOBsihPjFKirbTFYCAF0a+Om0Pf1cSL7+HH13Fe+oeIgZ+Lj+NYk+5oPFuxW271Vy89capEluIAqXvnIT7+vLJHV3W/Qgrlk4oGqEQydmKhSwuOUX/a5UudBttlCFRB0v16IeRO84NyHmtoY2XlslPD5Gkmds8XyDRqhuDGKGmc7i6cPfPmt3X5IfurA1VMnIVp+LnoQOotO73UyS/TaCHLRUSNydWPJJWI+0WKwbY/6Meze10zU');
        $this->assertTrue(empty($array['SuiteTicket']));
    }

    /**
     * 测试解析企业微信推送 suite_ticket 的xml
     */
    public function testParseSuiteTicketXml() {
        $xml = <<<str
<xml>
    <SuiteId><![CDATA[ww4asffe99e54c0f4c]]></SuiteId>
    <InfoType> <![CDATA[suite_ticket]]></InfoType>
    <TimeStamp>1403610513</TimeStamp>
    <SuiteTicket><![CDATA[asdfasfdasdfasdf]]></SuiteTicket>
</xml>
str;
        $array = XmlHelper::xmlToArray($xml);

        $this->assertEquals('ww4asffe99e54c0f4c', $array['SuiteId']);
        $this->assertEquals('suite_ticket', trim($array['InfoType']));
        $this->assertEquals('1403610513', $array['TimeStamp']);
        $this->assertEquals('asdfasfdasdfasdf', $array['SuiteTicket']);
    }

    /**
     * 测试数组转xml
     */
    public function testArrayToXml() {
        $array = array (
            'SuiteId' => 'ww4asffe99e54c0f4c',
            'InfoType' => 'suite_ticket',
            'TimeStamp' => '1403610513',
            'SuiteTicket' => 'asdfasfdasdfasdf',
        );
        $xml = XmlHelper::arrayToXml($array);

        $oldXml = <<<str
<xml><SuiteId><![CDATA[ww4asffe99e54c0f4c]]></SuiteId><InfoType><![CDATA[suite_ticket]]></InfoType><TimeStamp>1403610513</TimeStamp><SuiteTicket><![CDATA[asdfasfdasdfasdf]]></SuiteTicket></xml>
str;
        $this->assertEquals($xml, $oldXml);
    }
}