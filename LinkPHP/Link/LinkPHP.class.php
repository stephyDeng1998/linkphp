<?php

/**
 * --------------------------------------------------*
 *  LhinkPHP遵循Apache2开源协议发布  Link ALL Thing  *
 * --------------------------------------------------*
 *  @author LiuJun     Mail-To:liujun2199@vip.qq.com *
 * --------------------------------------------------*
 * Copyright (c) 2017 LinkPHP. All rights reserved.  *
 * --------------------------------------------------*
 *                 LinkPHP框架初始化类               *
 * --------------------------------------------------*
 */

namespace Link;
use Autoload;
class Link
{
    /**
     * 入口
     */
     static public function start()
     {

        /**
         * 运行自定义错误处理方式
         */
        static::_initErrorHandler();
        /**
         * 注册自动加载方法
         */
        static::_initAutoload();
        /**
         * 加载LinkPHP框架系统、应用公共函数
         */
        static::_initLinkFunc();
        /**
         * 加载系统引擎机制
         */
        static::_initEngine();
        /**
         * 加载系统视图索引
         */
        static::_initSQLVI();
        /**
         * 路由参数初始化
         */
        static::_initRouter();
        /**
         * 声明当前平平路径
         */
        static::_initPlatformPathConst();
        /**
         * 分发请求
         */
        static::_dispatch();

     }

     /**
      * 自定义错误信息触发器
      */
     static private function _initErrorHandler()
     {
        require CORE_PATH . 'ErrorHandler' . EXT;
        /**
         * 捕获致命错误自定义处理方法
         */
        register_shutdown_function(array('ErrorHandler','dealFatalError'));
        /**
         * 捕获普通自定义处理方法
         */
        set_error_handler(array('ErrorHandler','linkErrorFunc'));
        /**
         * 捕获异常自定义处理方法
         */
        set_exception_handler(array('ErrorHandler','dealException'));
     }

    /**
     * 注册命名空间第三方类库加载方法
     * 注册控制器模型类自动加载
     */
    static private function _initAutoload()
    {
        /**
         * 加载自动加载方法
         */
        require CORE_PATH . 'Autoload' . EXT;
        /**
         * 注册自动加载方法
         */
        Autoload::register(array('LinkSystemAutoload','toolClassAutoload','namespaceAutoload','userAutoload'));
    }

    /**
     * 加载LinkPHP框架系统函数库
     */
    static private function _initLinkFunc()
    {
        /**
         * 加载LinkPHP框架系统函数
         */
        require FUNCTION_PATH . 'functions.php';
        /**
         * 加载LinkPHP框架应用函数库
         */
        require COMMON_PATH . 'Function/functions.php';
    }

    /**
     * 加载系统引擎机制
     */
    static private function _initEngine()
    {
        \System\Core\Engine::run();
    }

    /**
     * 加载系统数据库视图索引
     */
    static private function _initSQLVI()
    {
        \System\SQL\SQLVI::run();
    }

    /**
     * 路由类支持多模式
     */
    static private function _initRouter()
    {
        /**
         * 实例化路由类
         */
        Router::run();
    }

    /**
     * 声明当前平台路径常量
     */
    static private function _initPlatformPathConst()
    {
        /**
         * 定义控制器路径常量
         */
        define('CURRENT_CONTROLLER_PATH',APPLICATION_PATH . PLATFORM . '/Controller/');
        /**
         * 定义模型路径常量
         */
        define('CURRENT_MODEL_PATH', APPLICATION_PATH . PLATFORM . '/Model/');
        /**
         * 定义视图路径常量
         */
        define('CURRENT_VIEW_PATH', APPLICATION_PATH . PLATFORM . '/View/');

    }

    /**
     * 分发请求
     */
    static private function _dispatch()
    {
        /**
         * 实例化分发类调用run方法
         */
        Dispatch::run();
    }

}

?>