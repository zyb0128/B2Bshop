<?php
/**
 * 返利模型管理
 *
 *
 *
 * @license   kissbin200@163.com
 * @link     	
 * @since      聖蓝玫瑰 2017年4月14日 11:07:51
 */
defined('In33hao') or exit('Access Invalid!');
class signedModel extends Model {
	public function __construct() {
		parent::__construct('signed');
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
	public function getSignedList($condition, $field = '*', $page = 0, $order = 'id desc',  $limit = '') {
		$result = $this->field($field)->where($condition)->order($order)->limit($limit)->page($page)->select();
		return $result;
	}

	/*
	 * 添加返利
	 *
	 * @param array $param 返利信息
	 * @return bool
	 */
	public function addSigned($param){
		return $this->insert($param);
	}

	/*
	 * 编辑
	 *
	 * @param array $update 更新信息
	 * @param array $condition 条件
	 * @return bool
	 */
	public function editSigned($update, $condition){
		return $this->where($condition)->update($update);
	}

	/*
	 * 单条查询
	 *
	 * @param array $condition 条件
	 * @return bool
	 */
	public function findSigned($condition){
		return $this->where($condition)->find();
	}
}