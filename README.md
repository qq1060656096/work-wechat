# Work-Wechat 企业微信api
> 快速开发企业微信


### 安装
> composer vcs安装
```json
{
  "require": {
        "php": ">=7.0.0",
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
```
