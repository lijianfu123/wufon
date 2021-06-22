<?php
//+----------------------------------------------------------------------
//| 全局中间件定义文件
//+----------------------------------------------------------------------

return [
    //think\middleware\LoadLangPack::class, //多语言加载
    //think\middleware\FormTokenCheck::class, //表单令牌
    //think\middleware\CheckRequestCache::class, //请求缓存

    think\middleware\SessionInit::class, //Session初始化
    think\middleware\AllowCrossDomain::class //跨域请求支持
];