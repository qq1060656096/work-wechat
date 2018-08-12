# Work-Wechat 企业微信api
> 快速开发企业微信


开发文档
===============================

----
* **撰写中** [关于(Intro)](docs/md/1.0-INTRO.md)
* **撰写中** [安装(Install)](docs/md/2.0-INSTALL.md)
* **撰写完成** [数据回调和指令回调URL验证](docs/md/3.0-VALIDATE-URL.md)
* **撰写中** [应用接收Suite事件处理](docs/md/4.0-RECEVIE-SUITE-EVENT.md)
* **撰写中** [推送suite_ticket: 应用接收 suite_ticket 事件处理](docs/md/5.0-SUITE-TICKET.md)
* **撰写中** [授权成功通知: 应用接收 create_auth 事件处理](docs/md/6.0-INSTALL-NOTIFY.md)
* **撰写中** [取消授权通知: 应用接收 cancel_auth 事件处理](docs/md/6.5-UNINSTALL-NOTIFY.md)
* **撰写完成** [生成应用安装URL](docs/md/7.0-GENERATE-INSTALL-URL.md)
* **撰写完成** [生成应用OATU2登录URL](docs/md/8.0-GENERATE-OAUTH2-URL.md)

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
