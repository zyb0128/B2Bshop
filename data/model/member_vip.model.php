<?php

defined('In33hao') or exit('Access Invalid!');

class member_vipModel extends Model{
	public function __construct(){
		parent::__construct('member_vip');
	}

	/*
	 * ���
	 *
	 * @param array $param 
	 * @return bool
	 */
	public function addMemberVip($param){
		return $this->insert($param);
	}

	public function getMemberViplist($condition, $field = '*', $page = 0, $order = 'id desc',  $limit = ''){
		$result = $this->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
		return $result;
	}

	public function getMemberVip($condition){
		$result = $this->where($condition)->find();
		return $result;
	}

	/*
	 * �༭
	 *
	 * @param array $update ������Ϣ
	 * @param array $condition ����
	 * @return bool
	 */
	public function editMemberVip($update, $condition){
		return $this->where($condition)->update($update);
	}
}