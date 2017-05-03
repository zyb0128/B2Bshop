<?php 
defined('In33hao') or exit('Access Invalid!');
class member_sellerModel extends Model {
	public function __construct() {
		parent::__construct('member_seller');
	}

	/*
	 * 添加会员
	 *
	 * @param array $param 会员信息
	 * @return bool
	 */
	public function addMemberSeller($param){
		return $this->insert($param);
	}

	/*
	 * 查找会员
	 *
	 * @condition array $condition 查找条件
	 * @return bool
	 */
	public function getMemberSeller($condition){
		return $this->where($condition)->find();
	}

	/**
	 * [getMemberSellerId 查找会员(ID)]
	 * @param  [type] $buyer  [卖家]
	 * @param  [type] $seller [买家]
	 * @return [type]         [description]
	 */
	public function getMemberSellerId($buyer,$seller){
		$condition['buyer_id'] = $buyer;
		$condition['seller_id'] = $seller;
		return $this->where($condition)->find();
	}

	/**
	 * 查询会员列表
	 *
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 字段
	 * @param string $limit 取多少条
	 * @return array
	 */
	public function getMemberSellerList($condition, $field = '*', $page = 0, $order = 'id desc',  $limit = '') {
		$result = $this->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
		return $result;
	}

	/*
	 * 编辑
	 *
	 * @param array $update 更新信息
	 * @param array $condition 条件
	 * @return bool
	 */
	public function editMemberSeller($update, $condition){
		return $this->where($condition)->update($update);
	}
}