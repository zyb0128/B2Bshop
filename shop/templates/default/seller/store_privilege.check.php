<?php defined('In33hao') or exit('Access Invalid!');?>
<style type="text/css">
	ul li {float:left}
	ul li span {padding: 15px; line-height: 15px;}
</style>
<div class="tabmenu">
	<?php include template('layout/submenu');?>
</div>
<div>已签约人数：</div>
<div class="ncsc-form-default">
	<ul>
		<?php foreach ($output['list'] as $key => $rows) { ?>
		<li><span><?php echo $rows['user_id']['member_name'] ?></span></li>
		<?php } ?>
	</ul>
</div>
