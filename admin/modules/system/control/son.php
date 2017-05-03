<?php
/**
 * 子公司设置
 *
 *
 *
 *
 */



defined('In33hao') or exit('Access Invalid!');
class sonControl extends SystemControl{
	private $links = array(
		 array('url'=>'act=son&op=index','text'=>'子公司列表'),
		 array('url'=>'act=son&op=add','text'=>'新增'),
	);

	public function __construct(){
		parent::__construct();
	}

	public function indexOp() {


		Tpl::output('top_link',$this->sublink($this->links,'index'));
		Tpl::setDirquna('system');
		Tpl::showpage('son.list');
	}

	public function addOp(){


		
		Tpl::output('top_link',$this->sublink($this->links,'add'));
		Tpl::setDirquna('system');
		Tpl::showpage('son.add');
	}


}