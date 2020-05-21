<?php declare(strict_types=1);

namespace Kongflower\Pay\Exception;

use Exception;
use Kongflower\Pay\Support\Response;

/**
 * class  WxPayException
 * 
 */
class WxPayException extends Exception
{
    public function __construct($msg)
    {
        return (new Response($msg))->respnoseJson();
    }
}