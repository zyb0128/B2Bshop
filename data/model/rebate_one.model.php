<?php 
defined('In33hao') or exit('Access Invalid!');
class rebate_oneModel extends Model {
	public function __construct() {
		parent::__construct('rebate_one');
	}

	/*
	 * 添加记录
	 *
	 * @param array $param  条件
	 * @return bool
	 */
	public function addRebateOne($param){
		return $this->insert($param);
	}

	/*
	 * 查询记录
	 *
	 * @param array $param  条件
	 * @return bool
	 */
	public function getRebateOne($param){
        		return $this->where($param)->find();
	}

	/*
	 * 删除记录
	 *
	 * @param array $param  条件
	 * @return bool
	 */
	public function delRebateOne($param){
        		return $this->where($param)->delete();
	}

	/**
	 * 查询列表
	 *
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 字段
	 * @param string $limit 取多少条
	 * @return array
	 */
	public function getRebateOneList($condition, $field = '*', $page = 0, $order = 'id desc',  $limit = '') {
		$result = $this->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
		return $result;
	}

	/**
	 * [getRebateOneListGoodsById 查询列表中的商品信息]
	 * @param  [int] $goodsID [商品ID]
	 * @return [array]          [商品信息]
	 */
	public function getRebateOneListGoodsById($goodsID){
		$result =  Model('goods') -> getGoodsInfoAndPromotionById($goodsID);
		return $result;
	}

	/**
	 * [getRebateOneListMemberById 查询列表中的客户信息]
	 * @param  [type] $memberID [客户ID]
	 * @return [type]           [客户信息]
	 */
	public function getRebateOneListMemberById($memberID){
		$result =  Model('member') -> getMemberInfoByID($memberID);
		return $result;
	}

	/**
	 * [getRebateOneListPrivilegeById 查询列表中的政策信息]
	 * @param  [type] $goodsID [商品ID]
	 * @param  [type] $storeID [店铺ID]
	 * @param  [type] $buyerID [购买者ID]
	 * @param  [type] $val [分红信息]
	 * @return [type]          [description]
	 */
	public function getRebateOneListPrivilegeById($goodsID,$storeID,$buyerID,$val){
		$param['seller_id'] = $storeID;
		$param['goods_id'] = $goodsID;
		$param['privilege_vip_type'] = $buyerID;
		$param['privilege_val'] = $val;

		$result =  Model('privilege') -> getPrivilegeInfo($param);
		return $result;
	}

	/*
	 * 编辑(公用)
	 *
	 * @param array $update 更新信息
	 * @param array $condition 条件
	 * @return bool
	 */
	public function editRebateAll($update, $condition){
		return $this->where($condition)->update($update);
	}
}