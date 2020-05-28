<?php declare(strict_types = 1);

namespace Kongflower\Pay\Event;

/**
 * 注册事件发现者接口
 */
interface Observer
{
    /**
     * 检测参数
     */
    public static function validation();
}