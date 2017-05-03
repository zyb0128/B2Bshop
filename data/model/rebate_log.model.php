<?php 
defined('In33hao') or exit('Access Invalid!');
class rebate_logModel extends Model {
	public function __construct() {
		parent::__construct('rebate_log');
	}

	/*
	 * 添加记录
	 *
	 * @param array $param  条件
	 * @return bool
	 */
	public function addRebateLog($param){
		return $this->insert($param);
	}
}