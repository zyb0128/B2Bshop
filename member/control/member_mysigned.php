<?php 
/**
 * @since      由聖蓝玫瑰提供技术支持 
 */



defined('In33hao') or exit('Access Invalid!');
class member_mysignedControl extends BaseMemberControl {
	public function __construct() {
		parent::__construct();
		/**
		 * 读取语言包
		 */
		Language::read('member_mysigned');
	}

	public function indexOp(){
		$user_id = $_SESSION['member_id'];	//用户ID

		$model_member_seller = Model('member_seller');
		$model_privilege = Model('privilege');
		$model_signed = Model('signed');

		//查找多店铺下的会员
		$find_list['buyer_id'] = $user_id;
		$list = $model_member_seller -> getMemberSellerList($find_list,'*',20);
		foreach ($list as $key => $val) {
			$find_privilege['seller_id'] = $val['seller_id'];
			$find_privilege['privilege_vip_type'] = $val['vip_id'];
			$find_privilege['share'] = 1;
			$list[$key]['privilegelist'] = $model_privilege -> getPrivilegeList($find_privilege);
			foreach ($list[$key]['privilegelist'] as $ky => $g) {
				$find = $model_signed -> findSigned(array('user_id'=>$user_id,'seller_id'=>$g['seller_id'],'pid'=>$g['id']));
				if (!empty($find)) {
					$list[$key]['privilegelist'][$ky]['play'] = '1';
				}
			}
		}

		Tpl::output('list',$list);
		Tpl::output('show_page',$model_member_seller->showpage());
		$this->profile_menu('signed_list');
		Tpl::showpage('member_mysigned.index');
	}

	public function signed_shareOp(){
		$id = intval($_GET['id']);
		$model_privilege = Model('privilege');

		$find_privilege['id'] = $id;
		$find = $model_privilege -> getPrivilegeInfo($find_privilege);
		$find['privilege_val'] = unserialize($find['privilege_val']);

		Tpl::output('find',$find);
		Tpl::showpage('member_mysigned.share','null_layout');
	}

	public function agreeOp(){
		if (empty($_POST['loginPwd'])) {
			showDialog('请填写登录密码','member/index.php?act=member_mysigned&op=index','error');
			exit;
		}
		$pwd = md5($_POST['loginPwd']);
		$user_id = $_SESSION['member_id'];	//用户ID
		$pid = $_POST['pid'];

		$model_member = Model('member');
		$model_signed = Model('signed');

		$FindUser = $model_member -> getMemberInfo(array('member_id'=>$user_id,'member_passwd'=>$pwd));
		if (empty($FindUser)) {
			showDialog('登录密码有误,请仔细检查','member/index.php?act=member_mysigned&op=index','error');
			exit;
		}

		$data['user_id'] = $user_id;
		$data['seller_id'] = $_POST['seller_id'];
		$data['pid'] = $pid;
		$data['lottime'] = time();
		$add = $model_signed -> addSigned($data);
		if ($add) {
			showDialog('您已同意该店铺的政策','member/index.php?act=member_mysigned&op=index','succ');
		}

	}

	/**
	 * 用户中心右边，小导航
	 *
	 * @param string    $menu_type  导航类型
	 * @param string    $menu_key   当前导航的menu_key
	 * @param array     $array      附加菜单
	 * @return
	 */
	private function profile_menu($menu_key='') {
		$menu_array = array(
			1=>array('menu_key'=>'signed_list','menu_name'=>'签约列表','menu_url'=>'index.php?act=member_mysigned&op=index'),
			// 2=>array('menu_key'=>'signed_on','menu_name'=>'与签约','menu_url'=>'index.php?act=member_mysigned&op=signed_on'),
		);
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}