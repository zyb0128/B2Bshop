<?php
/**
 * 店铺会员中心
 *
 *
 */



defined('In33hao') or exit('Access Invalid!');

class store_vipControl extends BaseSellerControl{
	public function __construct() {
		parent::__construct();
		Language::read('member_vip_index');
	}

	public function indexOp(){
		$model_store = Model('store');
		$model_member = Model('member'); //会员信息
		$model_member_vip = Model('member_vip'); //会员等级
		$model_member_seller = Model('member_seller');
		
		$store_vip_all = $model_member_seller -> getMemberSellerList(array('seller_id'=>$_SESSION['seller_id']),'*',12);
		foreach ($store_vip_all as $key => $val) {
			$store_vip_all[$key]['info'] = $model_member -> getMemberInfo(array('member_id'=>$val['buyer_id']));
			$store_vip_all[$key]['vip_level'] = $model_member_vip -> getMemberVip(array('id'=>$val['vip_id']));
		}

		$vip_list = $model_member_vip -> getMemberViplist(array('vip_level_seller_id'=>$_SESSION['seller_id']),'*',100);


		self::profile_menu('vip_list');
		Tpl::output('list',$store_vip_all);
		Tpl::output('viplist',$vip_list);
		// Tpl::output('show_page',$store_vip_info->showpage());
		Tpl::showPage('store_vip_index');
	}

	public function levelOp(){
		$model_member_vip = Model('member_vip');

		$find['vip_level_seller_id'] = $_SESSION['seller_id'];
		$list = $model_member_vip -> getmemberViplist($find, '*', 12);


		self::profile_menu('vip_level');
		Tpl::output('list',$list);
		Tpl::showPage('store_vip_level_index');
	}

	public function vip_addOp(){
		if (!empty($_GET['vip_id'])) {
			$model_member_vip = Model('member_vip');
			$find = $model_member_vip -> getmemberViplist($find, '*', 12);
			Tpl::output('find',$find[0]);
		}

		Tpl::showPage('store_vip_level_add','null_layout');
	}

	public function seva_vipOp(){
		$model_member_vip = Model('member_vip');

		$data['vip_level_name'] = $_POST['vip_level_name'];
		
		if (empty($_POST['vip_id'])) {
			$data['vip_level_seller_id'] = $_SESSION['seller_id'];
			$data['vip_level_cesttime'] = time();

			$add = $model_member_vip -> addMemberVip($data);
			if ($add > 0) {
				showDialog(Language::get('privilege_add_succ'),'index.php?act=store_vip&op=level','succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
			}else{
				echo "string";
			}
		}else{
			$condition['id'] = $_POST['vip_id'];
			$upd = $model_member_vip -> editMemberVip($data,$condition);
			if ($upd) {
				showDialog(Language::get('privilege_add_succ'),'index.php?act=store_vip&op=level','succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
			}else{
				echo "string";
			}
		}
	}

	public function ajax_updataOp(){
		$uid = $_POST['vipid'];
		$vip_id = !empty($_POST['updata']) ? $_POST['updata'] : '0';
		$model_member_seller = Model('member_seller');
		$model_privilege = Model('privilege');
		$model_signed = Model('signed');

		$Allsigned = $model_signed -> getSignedList(array('user_id'=>$uid));
		foreach ($Allsigned as $key => $ase) {
			$privilege = $model_privilege -> getPrivilegeInfo(array('id'=>$ase['pid']));
			$privilege_time_type = $privilege['privilege_time_type'];
			if ($privilege_time_type == '4') {
				if ($privilege['privilege_status'] == '1') {
					$meg = array('code'=>'20000','msg'=>'该用户已签订年返协议，请活动结束后在改！');
					echo json_encode($meg);exit;
				}
			}elseif ($privilege_time_type == '3'){
				if ($privilege['privilege_status'] == '1') {
					$meg = array('code'=>'20000','msg'=>'该用户已签订季返协议，请活动结束后在改！');
					echo json_encode($meg);exit;
				}
			}elseif ($privilege_time_type == '2') {
				if ($privilege['privilege_status'] == '1') {
					$meg = array('code'=>'20000','msg'=>'该用户已签订月返协议，请活动结束后在改！');
					echo json_encode($meg);exit;
				}
			}else{
				if ($privilege['privilege_status'] == '1') {
					$meg = array('code'=>'20000','msg'=>'该用户已签订单笔返协议，请活动结束后在改！');
					echo json_encode($meg);exit;
				}
			}
		}

		$updata = $model_member_seller -> editMemberSeller(array('vip_id'=>$vip_id),array('buyer_id'=>$uid));
		if ($updata) {
			$meg = array('code'=>'10000','msg'=>'修改成功');
		}else{
			$meg = array('code'=>'20000','msg'=>'修改失败');
		}
		echo json_encode($meg);
	}

	/**
	 * 用户中心右边，小导航
	 *
	 * @param string    $menu_type  导航类型
	 * @param string    $menu_key   当前导航的menu_key
	 * @return
	 */
	private function profile_menu($menu_key='') {
		Language::read('member_privilege_index');
		$menu_array =array(
				array('menu_key'=>'vip_list','menu_name'=>'会员列表', 'menu_url'=>'index.php?act=store_vip&op=index'),
				array('menu_key'=>'vip_level','menu_name'=>'会员等级','menu_url'=>'index.php?act=store_vip&op=level'),
				);
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}