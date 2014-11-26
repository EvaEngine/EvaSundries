<?php
/**
 * Created by PhpStorm.
 * User: wscn
 * Date: 14-11-25
 * Time: 下午5:42
 */
namespace Eva\EvaSundries\Utils;

class BaiduCountUrl {

    var $cc = "1";      //不知道，一般为1
    var $ck = "1";      //是否支持cookie 1:0
    var $cl = "32-bit"; //颜色深度
    var $ds = "1024x768";   //屏幕尺寸
    var $et = "0";      //初始值为0,如果ep时间变量不是0的话，它会变成其他
    var $ep = "0";      //初始值为0,时间变量，反映页面停留时间
    var $fl = "11.0";   //flash版本
    var $ja = "1";      //java支持版本
    var $ln = "zh-CN";  //语言
    var $lo = "0";      //不知道，一般为0
    var $nv = "0";      //不知道，一般为1或0
    var $sb = "17";     //浏览器，17代表360浏览器
    var $st = "4";      //不知道，之前的请求为4
    var $v  = "1.0.70";//百度统计的版本号
    var $lv = "2";      //不知道，之前的请求为2

    var $lt;            // 当前时间，待补充
    var $rnd;      //十位随机数，待补充
    var $si;            //貌似是百度统计ID，待补充
    var $u;             //待统计页面，待补充

    var $url;           //请求url;


    /**
     * @param $BaiduId  申请百度统计时的百度ID
     * @param $page_url 待统计页面的url
     */
    public function __construct($BaiduId, $page_url) {
        $this->si = $BaiduId;
        $this->u  = $page_url;
    }

    public function getFirstRequestUrl() {
        $this->lt = time();
        $this->rnd = rand(1000000000, 9999999999);
        $this->url = "http://hm.baidu.com/hm.gif?cc=$this->cc&ck=$this->ck&cl=$this->cl&ds=$this->ds&ep=25717%2C21700&et=$this->et&fl=$this->fl&ja=$this->ja&ln=$this->ln&lo=$this->lo&lt=$this->lt&nv=$this->nv&rnd=$this->rnd&si=$this->si&st=$this->st&v=$this->v&lv=$this->lv&u=$this->u";

        return $this->url;
    }

    public function getSecondRequestUrl() {
        $this->lt = time();
        $this->rnd = rand(1000000000, 9999999999);
        $this->url = "http://hm.baidu.com/hm.gif?cc=$this->cc&ck=$this->ck&cl=$this->cl&ds=$this->ds&et=$this->et&fl=$this->fl&ja=$this->ja&ln=$this->ln&lo=$this->lo&lt=$this->lt&nv=$this->nv&rnd=$this->rnd&si=$this->si&st=$this->st&v=$this->v&lv=$this->lv";

        return $this->url;
    }
} 