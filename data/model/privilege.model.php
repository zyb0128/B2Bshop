<?php
/**
 * 店铺分红设置模型管理
 *
 */
defined('In33hao') or exit('Access Invalid!');
class privilegeModel extends Model {
	protected $ownShopIds;

	public function __construct() {
		parent::__construct('privilege');
	}

	/*
	 * 添加店铺分红
	 *
	 * @param array $param 店铺分红信息
	 * @return bool
	 */
	public function addPrivilege($param){
		return $this->insert($param);
	}

	/*
	 * 编辑店铺分红
	 *
	 * @param array $update 更新信息
	 * @param array $condition 条件
	 * @return bool
	 */
	public function editPrivilege($update, $condition){
		//清空缓存
		// $store_list = $this->getStoreList($condition);
		// foreach ($store_list as $value) {
		// 	dcache($value['store_id'], 'store_info');
		// }
		
		return $this->where($condition)->update($update);
	}

	/**
	 * 查询店铺分红信息
	 *
	 * @param array $condition 查询条件
	 * @return array
	 */
	public function getPrivilegeInfo($condition) {
		$store_info = $this->where($condition)->find();
		
		return $store_info;
	}

	/**
	 * 查询店铺分红列表
	 *
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 字段
	 * @param string $limit 取多少条
	 * @return array
	 */
	public function getPrivilegeList($condition, $field = '*', $page = 0, $order = 'id desc',  $limit = '') {
		$result = $this->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
		return $result;
	}
}