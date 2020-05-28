<?php declare(strict_types = 1);

namespace Kongflower\Pay\Event;

/**
 * 事件监听类
 */
abstract class Event
{

    private static $observers = array();

    /**
     * 注册事件
     * @param  string $eventName
     * @param  object $handle
     */
    public static function on($eventName,$handle)
    {
        self::$observers[$eventName] = $handle;
    }

    /**
     * 触发事件
     * @param  string $eventName
     * @param  array  $handle
     */
    public static function trigger($eventName,$handle)
    {
        call_user_func_array(self::$observers[$eventName] , $handle);
    }

    /**
     * 销毁事件
     * @param  string $eventName
     */
    public function destruction($eventName)
    {
        unset(self::$observers[$eventName]);
    }

}