<?php
/**
 * 子公司下的二级店铺
 *
 */


defined('In33hao') or exit('Access Invalid!');

class secshopControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){

		Tpl::setDirquna('shop');
		Tpl::showpage('secshop.list');
	}
}