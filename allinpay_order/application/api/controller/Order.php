<?php
namespace app\api\controller;

use think\Controller;
use think\Db;

class Order extends Controller
{
    public $url = "https://syb.allinpay.com/sappweb/usertrans/cuspay?";

    public function order(){
        return view();
    }

    public function index()
    {
        $oid = input('post.oid');
        if(!$oid){
           echo "订单号不能为空！";
            return ;
        }
        $params = array();
        $params['appid'] = config('appConfig.APPID');
        $params['c'] = "FFFYPtuu";//RQGGRG8A
        $params['oid'] =  $oid;
        $params['sign'] = SignArray($params, config('appConfig.APPKEY'));
        $data = $this->UrlParams($params);
        //return $this->url.$data;
        $this->redirect($this->url.$data);

    }

    /**
     * 生成URL参数
     * @param array $array
     * @return string
     */
    function UrlParams(array $array){
        $buff = "";
        foreach ($array as $k => $v)
        {
            if($k == "returl" || $k == "trxreserve"){
                $buff .= $k . "=" . urlencode($v). "&";
            }else
            $buff .= $k . "=" . $v . "&";
        }
        $buff = trim($buff, "&");
        return $buff;
    }
}
