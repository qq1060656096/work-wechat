<?php
/**
 * Created by PhpStorm.
 * User: 赵思贵
 * Date: 2018/8/10
 * Time: 17:10
 */
error_reporting(E_ALL);
ini_set("display_errors", "On");
include_once dirname(dirname(__DIR__)).'/vendor/autoload.php';

$suiteId = 'wwb724435140790a38';
$suiteSecret = 'D3Exxspn8QnWpLzYLzfCMrS4xZcMukOMenkdFMMGaeY';
$suiteTicket = 'eWrw5y_oCqrz3dhDPP4oxu0CuqH_qYd12EINCvLEZWcbKFGoQOA0rq3oDQner2vU';
$obj = new \Zwei\WorkWechat\Suite($suiteId, $suiteSecret, $suiteTicket);
list($suiteAccessToken, $expiresIn) = $obj->getSuiteAccessToken();
var_dump($suiteAccessToken);