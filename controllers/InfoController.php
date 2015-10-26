<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 *  @abstract 申明变量/类/方法
 *  @access指明这个变量、类、函数/方法的存取权限
 *  @author brooks
 *  @const指明常量
 *  @final指明这是一个最终的类、方法、属性，禁止派生、修改。
 *  @global指明在此函数中引用的全局变量
 *  @include指明包含的文件的信息
 *  @module定义归属的模块信息
 *  @modulegroup定义归属的模块组
 *  @package定义归属的包的信息
 *  @param定义函数或者方法的参数信息
 *  @return定义函数或者方法的返回信息
 *  @see定义需要参考的函数、变量，并加入相应的超级连接。
 *  @since 指明该api函数或者方法是从哪个版本开始引入的
 *  @static 指明变量、类、函数是静态的。
 *  @todo指明应该改进或没有实现的地方
 *  @var定义说明变量/属性。
 *  @version定义版本信息
 * 
 */

include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/BaseController.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/models/SMSModel.php';

class InfoController extends BaseController
{
	public $reviewmodel;
	public function __construct() {
		parent::__construct();
	}
	
        public function index()
        {
            
        }
        
        public function register(){
            $info = array(
                'url' => '/api/auth/register',
                'method' => Config::$METHOD_POST,
                'params' => array(
                    array('name'=>'mobile', 'value'=>'用户手机号'),
                    array('name'=>'password', 'value'=>'密码'),
                    array('name'=>'valicode', 'value'=>'验证码'),
                ),
                'return' => array(
                    array('name' =>'user', 'value' => '手机号 //第一次注册，没有填写用户名，就以手机号替代用户名'),
                    array('name' => 'authcode', 'value' => 'JWT code //登录后，所有的请求操作都将该参数添加到URL后面，返回到服务器')
                )
            );
            return $this->go("resiter", $info);
        }
        
        public function login(){
            $info = array(
                'url' => '/api/auth/login',
                'method' => Config::$METHOD_POST,
                'params' => array(
                    array('name'=>'mobile', 'value'=>'用户手机号'),
                    array('name'=>'password', 'value'=>'密码')
                ),
                'return' => array(
                    array('name' =>'user', 'value' => '手机号 //第一次注册，没有填写用户名，就以手机号替代用户名'),
                    array('name' => 'authcode', 'value' => 'JWT code //登录后，所有的请求操作都将该参数添加到URL后面，返回到服务器')
                )
            );
            return $this->go("resiter", $info);
        }
        
        public function sendvalicode(){
            $info = array(
                'url' => '/api/sms/send',
                'method' => Config::$METHOD_POST,
                'params' => array(
                    array('name'=>'mobile', 'value'=>'用户手机号'),
                ),
                'return' => ''
            );
            return $this->go("sendvalicode", $info);
        }
        
        public function valicodelist(){
            $sms = new SMSModel();
            $smslist = $sms->getlist('*', []);
            foreach ($smslist as $smssingle){
                $valicode[] = array(
                    'name' => '手机号: '.$smssingle['mobile'],
                    'value' =>  '验证码: '.$smssingle['valicode']
                );
            }
            $info = array(
                'url' => '在发布之前，不真实发验证码，把验证码列出来，方便测试',
                'method' => Config::$METHOD_GET,
                'params' => $valicode,
                'return' => ''
            );
            return $this->go('valicodelist', $info);
        }
        
        public function eventcreate()
        {
            
            $info = array(
                'url' => '/api/events',
                'method' => Config::$METHOD_POST,
                'params' => array(
                    array('name'=>'title', 'value'=>'活动标题'),
                    array('name'=>'content', 'value'=>'活动内容'),
                    array('name'=>'contact', 'value'=>'联系方式'),
                    array('name'=>'fee', 'value'=>'活动费用'),
                    array('name'=>'place', 'value'=>'活动地点'),
                    array('name'=>'starttime', 'value'=>'活动开始时间'),
                    array('name'=>'endtime', 'value'=>'活动结束时间'),
                ),
                'return' => array(
                    array('name'=>'id', 'value'=>'活动ID'),
                    array('name'=>'user', 'value'=>'User模型'),
                    array('name'=>'title', 'value'=>'活动标题'),
                    array('name'=>'content', 'value'=>'活动内容'),
                    array('name'=>'contact', 'value'=>'联系方式'),
                    array('name'=>'fee', 'value'=>'活动费用'),
                    array('name'=>'place', 'value'=>'活动地点'),
                    array('name'=>'dateline', 'value'=>'活动发布时间'),
                    array('name'=>'starttime', 'value'=>'活动开始时间'),
                    array('name'=>'endtime', 'value'=>'活动结束时间'),
                ),
            );
            return $this->go("eventcreate", $info);
        }
        public function eventupdate()
        {
            
            $info = array(
                'url' => '/api/events/{eventid}',
                'method' => Config::$METHOD_PUT,
                'params' => array(
                    array('name'=>'title', 'value'=>'活动标题'),
                    array('name'=>'content', 'value'=>'活动内容'),
                    array('name'=>'contact', 'value'=>'联系方式'),
                    array('name'=>'fee', 'value'=>'活动费用'),
                    array('name'=>'place', 'value'=>'活动地点'),
                    array('name'=>'starttime', 'value'=>'活动开始时间'),
                    array('name'=>'endtime', 'value'=>'活动结束时间'),
                ),
                'return' => array(
                    array('name'=>'id', 'value'=>'活动ID'),
                    array('name'=>'user', 'value'=>'User模型'),
                    array('name'=>'title', 'value'=>'活动标题'),
                    array('name'=>'content', 'value'=>'活动内容'),
                    array('name'=>'contact', 'value'=>'联系方式'),
                    array('name'=>'fee', 'value'=>'活动费用'),
                    array('name'=>'place', 'value'=>'活动地点'),
                    array('name'=>'dateline', 'value'=>'活动发布时间'),
                    array('name'=>'starttime', 'value'=>'活动开始时间'),
                    array('name'=>'endtime', 'value'=>'活动结束时间'),
                ),
            );
            return $this->go("eventupdate", $info);
        }
        
        public function eventdelete()
        {
            
            $info = array(
                'url' => '/api/events/{eventid}',
                'method' => Config::$METHOD_DELETE,
                'params' => '',
                'return' => '',
            );
            return $this->go("eventdelete", $info);
        }
        
        public function eventdetail()
        {
            
            $info = array(
                'url' => '/api/events/{eventid}',
                'method' => Config::$METHOD_GET,
                'params' => '',
                'return' => array(
                    array('name'=>'id', 'value'=>'活动ID'),
                    array('name'=>'user', 'value'=>'User模型'),
                    array('name'=>'title', 'value'=>'活动标题'),
                    array('name'=>'content', 'value'=>'活动内容'),
                    array('name'=>'contact', 'value'=>'联系方式'),
                    array('name'=>'fee', 'value'=>'活动费用'),
                    array('name'=>'place', 'value'=>'活动地点'),
                    array('name'=>'dateline', 'value'=>'活动发布时间'),
                    array('name'=>'starttime', 'value'=>'活动开始时间'),
                    array('name'=>'endtime', 'value'=>'活动结束时间'),
                ),
            );
            return $this->go("eventdetail", $info);
        }
        
        public function eventlist()
        {
            
            $info = array(
                'url' => '/api/events',
                'method' => Config::$METHOD_GET,
                'params' => '',
                'return' => array(
                    array('name'=>'所有的参数与详情一致', 'value'=>'按时间倒序排列'),
                ),
            );
            return $this->go("eventlist", $info);
        }
        
        public function eventjoin()
        {
            
            $info = array(
                'url' => '/api/events/{eventid}/members',
                'method' => Config::$METHOD_POST,
                'params' => '',
                'return' => '',
            );
            return $this->go("event join ok", $info);
        }
        
        public function eventquit()
        {
            $info = array(
                'url' => '/api/events/{eventid}/members',
                'method' => Config::$METHOD_DELETE,
                'params' => '',
                'return' => '',
            );
            return $this->go("event quit ok", $info);
        }
        
//	public function index()
//	{
//		$keywords = $_GET['keywords'];
//		$whereparm = array(
//			'title[~]' => $keywords,
//			'content[~]' => $keywords
//		);
//		if($keywords){
//			$reviews = $this->reviewmodel->getlist('*', array('OR'=>$whereparm));
//		}else{
//			$reviews = $this->reviewmodel->getlist('*', array());
//		}
//				
//		
//		$parmValue = array(
//			'title' => 'RTS',
//			'login' => $this->login,
//			'author' => $this->author,
//			'reviews' => $reviews,
//			'keywords' => $keywords
//		);
//		return View::load('home', $parmValue);
//	}
}
?>
