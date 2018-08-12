# 企业微信 PHP SDK
=====
介绍
-----
简单的企业微信服务商应用 PHP SDK, 通过调用相应的接口，使你可以轻松地开发企业微信应用


开发文档
===============================

----
* **未撰写** [关于(Intro)](docs/md/1.0-INTRO.md)
* **未撰写** [安装(Install)](docs/md/2.0-INSTALL.md)
* **未撰写** [目录结构](docs/md/2.5-APPLICATION-STRUCT.md)
* **撰写完成** [数据回调和指令回调URL验证](docs/md/3.0-VALIDATE-URL.md)
* **未撰写** [应用接收Suite事件处理](docs/md/4.0-RECEVIE-SUITE-EVENT.md)
* **未撰写** [推送suite_ticket: 应用接收 suite_ticket 事件处理](docs/md/5.0-SUITE-TICKET.md)
* **未撰写** [授权成功通知: 应用接收 create_auth 事件处理](docs/md/6.0-INSTALL-NOTIFY.md)
* **撰写** [取消授权通知: 应用接收 cancel_auth 事件处理](docs/md/6.5-UNINSTALL-NOTIFY.md)
* **撰写完成** [生成应用安装URL](docs/md/7.0-GENERATE-INSTALL-URL.md)
* **撰写完成** [生成应用OATU2登录URL](docs/md/8.0-GENERATE-OAUTH2-URL.md)
* **未撰写** [成员管理: 通讯录操作](docs/md/6.5-UNINSTALL-NOTIFY.md)
* **未撰写** [部门管理: 部门操作](docs/md/6.5-UNINSTALL-NOTIFY.md)


### 安装
> composer vcs安装
```json
{
  "require": {
        "php": ">=7.2.0",
        "zwei/work-wechat": "dev-master"
  },
 "repositories": [
   {
     "type": "vcs",
     "url": "https://github.com/qq1060656096/work-wechat.git"
   }
 ]
}
```

### 单元测试
```sh
phpunit --bootstrap ./tests/TestInit.php ./tests/

phpunit --bootstrap ./tests/TestInit.php ./tests/Heplers/CommonHelperTest.php
phpunit --bootstrap ./tests/TestInit.php ./tests/Events
```
