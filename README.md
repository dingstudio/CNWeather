# CNWeather
## China Weather Application Official Interface
中国天气网官方数据获取接口 By PHP

## 支持特性
- [x] 天气查询
- [x] 温湿度查询
- [x] 快速接口改造，整合API管理平台
- [x] JSON返回，支持JSONP跨域接口改造

## 依赖扩展
本程序基于XML DOM解析技术实现省/地级市/行政区划的ID索引，同时，数据拉取和通讯使用了PHPCurl，所以请务必确保PHP的DOMDocument和Curl扩展处于可用状态。
如需整合HTTPS等SSO平台技术，请同时启用Openssl扩展。

## 版权说明
本程序的XML数据文件取自网络并略加修改，程序主体部分遵循MIT License进行开源。

&copy; 2012-2018 DingStudio All Rights Reserved.
