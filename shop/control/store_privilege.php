<?php 
/**
 *
 * 店铺分红设置——我是卖家
 *
 *
 *
 *@since      聖蓝玫瑰提供个人技术支持 
 * 
 */


defined('In33hao') or exit('Access Invalid!');

class store_privilegeControl extends BaseSellerControl {
	public function __construct() {
		parent::__construct();
		Language::read('member_privilege_index');
	}

	public function indexOp(){
		$model_class = Model('privilege');
		$today = time();
		$list_privilege = $model_class -> getPrivilegeList(array('seller_id'=>$_SESSION['seller_id']), '*', 12);
		foreach ($list_privilege as $key => $val) {
			$string_val = unserialize($val['privilege_val']);
			$list_privilege[$key]['privilege_val'] = $string_val;

			if ($_GET['getshua'] == '1') {
				if ($val['privilege_valid_endtime'] < $today) {
					$update['privilege_status'] = 2;
					$model_class -> editPrivilege($update,array('id'=>$val['id']));
				}
			}
		}
		
		self::profile_menu('privilege');
		Tpl::output('list',$list_privilege);
		Tpl::output('show_page',$model_class->showpage());
		Tpl::showPage('store_privilege.store_index');
	}

	public function privilege_addOp(){
		$lang   = Language::getLangContent();
		$model_goods = Model('goods');
		$model_member_vip = Model('member_vip'); //会员等级

		//商品
		$goods_list_data['store_id'] = $_SESSION['seller_id'];
		$goods_list = $model_goods -> getGoodsList($goods_list_data);

		if ($_GET['privilege_id'] != '') {
			$model_privilege = Model('privilege');
			$find_privilege = $model_privilege -> getPrivilegeInfo(array('id'=>$_GET['privilege_id']));
			if (empty($find_privilege)){
				showMessage($lang['wrong_argument'],'','html','error');
			}

			//规则处理
			$find_privilege['privilege_val'] = unserialize($find_privilege['privilege_val']);

			Tpl::output('privilegeInfo',$find_privilege);
		}

		//会员等级
		$vip_list = $model_member_vip -> getMemberViplist(array('vip_level_seller_id'=>$_SESSION['seller_id']),'*',100);

		// var_dump($vip_list);
		Tpl::output('viplist',$vip_list);
		Tpl::output('goods_list',$goods_list);
		Tpl::showPage('store_privilege.store_add','null_layout');
	}

	public function privilege_shareOp(){
		$id = $_GET['privilege_id'];
		$model_class = Model('privilege');

		$find['id'] = $id;
		$find_privilege = $model_class -> getPrivilegeInfo($find);

		Tpl::output('find',$find_privilege);
		Tpl::showPage('store_privilege.store_share','null_layout');
	}

	public function store_bao_shareOp(){
		$model_class = Model('privilege');

		$comm['id'] = $_POST['pid'];
		$data['title'] = $_POST['title'];
		$data['intro'] = $_POST['intro'];
		$data['share'] = 1;

		$edit = $model_class -> editPrivilege($data,$comm);
		if ($edit) {
			showDialog(Language::get('privilege_edit_succ'),'reload','succ');
		}else{
			showDialog(Language::get('privilege_edit_error'),'reload','error');
		}
	}


	public function privilege_checkOp(){
		$pid = intval($_GET['privilege_id']);

		$model_signed = Model('signed');
		$model_member = Model('member');

		$FindAll['pid'] = $pid;
		$FindAll['seller_id'] = $_SESSION['seller_id'];
		$FindAllsigned = $model_signed -> getSignedList($FindAll);
		foreach ($FindAllsigned as $key => $value) {
			$FindAllsigned[$key]['user_id'] = $model_member -> getMemberInfoByID($value['user_id']);
		}


		Tpl::output('list',$FindAllsigned);
		self::profile_menu('123');
		Tpl::showPage('store_privilege.check');
	}

	/**
	 * [store_baoOp 保存]
	 * @return [type] [description]
	 */
	public function store_baoOp(){
		$model_class = Model('privilege');
		$model_goods = Model('goods');
		$model_member_vip = Model('member_vip'); //会员等级

		$find_goods = $model_goods -> getGoodsInfoByID($_POST['goods_id']);
		$privilege_name = array('0','销量','金额');
		$privilege_time_name = array('0','单返','月返','季度返','年返');

		$vip_info = $model_member_vip -> getMemberVip(array('id'=>$_POST['privilege_vip']));

		$data['seller_id'] 	= $_SESSION['seller_id'];
		$data['store_name'] 	= $_SESSION['store_name'];
		$data['goods_id'] 	= $_POST['goods_id'];
		$data['goods_name'] 	= $find_goods['goods_name'];
		$data['privilege_type'] 	= $_POST['privilege_type'];
		$data['privilege_name'] = $privilege_name[$_POST['privilege_type']];
		$data['privilege_time_type'] 	= $_POST['privilege_time'];
		$data['privilege_time_name'] 	= $privilege_time_name[$_POST['privilege_time']];
		$data['privilege_status'] = 1;
		$data['privilege_valid_starttime'] 	= strtotime($_POST['starttime']." 00:00:00");
		$data['privilege_valid_endtime'] 	= strtotime($_POST['endtime']." 23:59:59");
		$data['privilege_vip_type'] = $_POST['privilege_vip'];
		$data['privilege_vip_name'] = $vip_info['vip_level_name']? $vip_info['vip_level_name'] : '普通用户';
		$arr = array_combine($_POST['privilege_limit'],$_POST['privilege_text']);
		$data['privilege_val'] 	= serialize($arr);
		$condition = array('goods_id'=>$_POST['goods_id'],'privilege_vip_type'=>$_POST['privilege_vip'],'privilege_status'=>'1','privilege_time_type'=>$_POST['privilege_time']);
		$empty_privilege = $model_class -> getPrivilegeInfo($condition);
		if (empty($empty_privilege)) {

			if ( date('m',$empty_privilege['privilege_valid_endtime']) < date('m',$data['privilege_valid_starttime']) && date('m',$empty_privilege['privilege_valid_starttime']) < date('m',$data['privilege_valid_starttime']))  {

				//季度检测
				if ( ceil((date('n',$empty_privilege['privilege_valid_endtime']))/3) == ceil((date('n',$data['privilege_valid_starttime']))/3) && $_POST['privilege_time'] == '3') {
					howDialog(Language::get('privilege_add_error'),'reload','error');
				}

				//年度检测
				if ( date('Y',$empty_privilege['privilege_valid_endtime']) == date('Y',$data['privilege_valid_starttime']) && $_POST['privilege_time'] == '4') {
					howDialog(Language::get('privilege_add_error'),'reload','error');
				}

				//创建
				$data['privilege_cerat_time'] = time();
				$add_privilege = $model_class -> addPrivilege($data);
				if ($add_privilege > 0) {
					showDialog(Language::get('privilege_add_succ'),'index.php?act=store_privilege&op=index','succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
				}else{
					showDialog(Language::get('privilege_add_error'),'reload','error');
				}




			}else{
				showDialog(Language::get('privilege_add_error'),'reload','error');
			}	
		}else{
			if (!empty($_POST['privilege_id'])) {
				//修改
				$data['privilege_updata_time'] = time();
				$updata_privilege = $model_class -> editPrivilege($data,$condition);
				if ($updata_privilege) {
					showDialog(Language::get('privilege_edit_succ'),'reload','succ');
				}else{
					showDialog(Language::get('privilege_edit_error'),'reload','error');
				}
			}else{
				showDialog(Language::get('privilege_add_error'),'reload','error');
			}	
		}
	}

	public function overOp(){
		$model_privilege = Model('privilege');
		$id = intval($_GET['id']);


		$update['privilege_status'] = 2;
		$model_privilege -> editPrivilege($update,array('id'=>$on['id']));
		showDialog(Language::get('privilege_edit_succ'),'reload','succ');
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
		$menu_array =array(array('menu_key'=>'privilege','menu_name'=>Language::get('nc_member_privilege_config'), 'menu_url'=>'index.php?act=store_privilege&op=index'));
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}