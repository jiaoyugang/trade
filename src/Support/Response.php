<?php
namespace Kongflower\Pay\Support;

class Response
{
    /**
     * 响应类型
     */
    protected $type;

    /**
     * 响应内容
     */
    protected $body;


    public function __construct($body)
    {
        $this->body = $body;
    }

    /**
     * 输出响应体
     */
    public function respnoseJson()
    {
        die($this->body);
    }

    
    public function __call($name, $arguments)
    {
        return call_user_func_array($name, $arguments);
    }
}