<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $openid = I('get.openid');
        if( empty($openid) ){
            die('参数错误');
        }
        $time = strtotime(date('Y-m-d'));
        $data = M('qiandao')->where(array('openid'=>$openid, 'create_time'=>$time))->find();
        if( $data ){
            $this->assign('data', $data);
            $this->display('caipiao1');
            exit;
        }
        $this->assign('openid', $openid);
        $this->display();
    }


    public function AjaxQiandao()
    {
        if( IS_POST && IS_AJAX ){
            $openid = I('post.openid');
            if( empty($openid) ){
                $this->ajaxReturn(array('status'=>'n', 'msg'=>'参数错误！'));
            }
            $time = strtotime(date('Y-m-d'));
            //检查今天是否签到
            $is_data = M('qiandao')->where(array('openid'=>$openid, 'create_time'=>$time))->find();
            if( $is_data ){
                $this->ajaxReturn(array('status'=>'n', 'msg'=>'今天已经签到了！'));
            }
            //添加签到
            $insert = M('qiandao')->add(array('openid'=>$openid, 'create_time'=>$time));
            if( $insert > 0 ){
                $this->ajaxReturn(array('status'=>'y', 'msg'=>'签到成功！'));
            }else{
                $this->ajaxReturn(array('status'=>'n', 'msg'=>'签到成功！'));
            }

        }
    }
}
