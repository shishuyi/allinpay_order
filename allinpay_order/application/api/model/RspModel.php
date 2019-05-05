<?php
/**
 * Created by PhpStorm.
 * User: 通联支付-stone
 * Date: 2019/2/15
 * Time: 14:48
 */

namespace app\api\model;


class RspModel
{
    public $appid = "";
    public $cusid = "";
    public $trxcode = "";
    public $timestamp = "";
    public $randomstr = "";
    public $sign = "";
    public $bizseq = "";
    public $retcode = "";
    public $retmsg = "";
    public $amount = "";
    public $trxreserve = "";

    //初始化
    public function init($code,$msg){
        $this->retcode = $code;
        $this->retmsg = $msg;
        $this->appid = config('APPID');
        $this->cusid = config('CUSID');
        $this->trxcode = "T001";
        $this->timestamp = date("YmdHms");
        $this->randomstr = $this->timestamp;
    }
    //对对象进行签名
    public function sign(){
        $array = array();
        foreach($this as $key => $value) {
            if($value!=""){
                $array[$key] = $value;
            }
        }
        $signStr = SignArray($array, config('APPKEY'));
        $this->sign = $signStr;
    }

}