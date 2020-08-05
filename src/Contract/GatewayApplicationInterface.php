<?php
namespace Kongflower\Pay\Contract;

interface GatewayApplicationInterface
{
    /**
     * To pay.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string $gateway
     * @param array  $params
     *
     * @return Collection|Response
     */
    public function pay($gateway, $params);

    /**
     * Query an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function find($order, string $type);

    /**
     * Refund an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @return Collection
     */
    public function refund(array $order);

    /**
     * Cancel an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function cancel($order);

    /**
     * Close an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function close($order);

    /**
     * Verify a request.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array|null $content
     *
     * @return Collection
     */
    public function verify($content, bool $refund);

    /**
     * Echo success to server.
     *
     * @author gang <18838952961@163.com>
     *
     * @return Response
     */
    public function success();
}