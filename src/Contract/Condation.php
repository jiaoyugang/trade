<?php declare(strict_types = 1);
namespace Kongflower\Pay\Contract;

interface Condation
{
   /**
     * 普通商户境内
     */
    const URL = 'https://api.mch.weixin.qq.com/';

    //PAY TYPE
    /******************************************************************
     *      ****    ***    *     *      ***** *     * **** *****      *
     *      *  *   *   *    *   *         *    *   *  *  * *          *
     *      ****  *******    * *          *     * *   **** *****      *
     *      *    *       *    *           *      *    *    *          *
     *      *   *         *   *           *      *    *    *****      *
     ******************************************************************/
    /**
     * 在手机、ipad等移动设备中通过浏览器来唤起微信支付的支付产品 
     * 
     * */
    const PAY_TYPE_H5 = 'MWEB';
    /**
     * 商户通过在移动端应用APP中集成开放SDK调起微信支付模块完成支付的模式 
     * 
     */
    const PAY_TYPE_APP = 'APP';

    /**
     * 商户系统按微信支付协议生成支付二维码，用户再用微信“扫一扫”完成支付的模式 
     * 
     * */
    const PAY_TYPE_CODE = 'NATIVE';

    /**
     * H5页面通过调用微信支付提供的JSAPI接口调起微信支付模块完成支付 
     * 
     */
    const PAY_TYPE_JSAPI = 'JSAPI';

    /**
     * 付款码支付 
     * 收银员使用扫码设备读取微信用户付款码以后，二维码或条码信息会传送至商户收银台，由商户收银台或者商户后台调用该接口发起支付。
     */
    const PAY_TYPE_MICROPAY = 'MICROPAY';
    
    /**
     * 统一下单地址
     * 
     * */
    const PAY_METHOD_UNIFIED_ORDER = 'pay/unifiedorder';

    /**
     * 支付订单查询 
     * 
     * */
    const PAY_METHOD_ORDER_QUERY = 'pay/orderquery';

    /**
     * 关闭订单
     * 
     * */
    const PAY_METHOD_CLOSE_ORDER = 'pay/closeorder';

    /**
     * 申请退款 
     * 
     * 请求需要双向证书
     * 
     * 当交易发生之后一段时间内，由于买家或者卖家的原因需要退款时，卖家可以通过退款接口将支付款退还给买家，
     * 微信支付将在收到退款请求并且验证成功之后，按照退款规则将支付款按原路退到买家帐号上
     * */
    const PAY_METHOD_REFUND = 'secapi/pay/refund';

    /**
     * 查询退款 
     * 
     * 提交退款申请后，通过调用该接口查询退款状态。
     * 退款有一定延时，用零钱支付的退款20分钟内到账，银行卡支付的退款3个工作日后重新查询退款状态。
     * */
    const PAY_METHOD_REFUND_QUERY = 'pay/refundquery';

    /**
     * 企业向微信用户个人付款
     * 
     * 请求需要双向证书
     * 
     * 目前支持向指定微信用户的openid付款
     */
    const PAY_METHOD_TRANFERS = 'mmpaymkttransfers/promotion/transfers';

    /**
     * 用于商户的企业付款操作进行结果查询，返回付款操作详细结果
     * 
     * 查询企业付款API只支持查询30天内的订单，30天之前的订单请登录商户平台查询。
     */
    const PAY_METHOD_GETTRANFERS = 'mmpaymkttransfers/gettransferinfo';
}