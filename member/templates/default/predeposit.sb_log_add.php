<?php defined('In33hao') or exit('Access Invalid!');?>

<div class="wrap">
	<div class="tabmenu">
		<?php include template('layout/submenu');?>
	</div>
	<div class="ncm-default-form">
		<form method="post" id="recharge_form" action="index.php">
			<input type="hidden" name="form_submit" value="ok" />
			<input type="hidden" name="act" value="predeposit" />
			<input type="hidden" name="op" value="recharge_sb_add" />
			<dl>
				<dt><i class="required">*</i><?php echo $lang['predeposit_recharge_price'].$lang['nc_colon']; ?></dt>
				<dd>
					<input name="pdr_amount" type="text" class="text w50" id="pdr_amount" maxlength="8"/><em class="add-on">
<i class="icon-renminbi"></i></em><span></span></dd>
			</dl>
			<dl class="bottom">
				<dt>&nbsp; </dt>
				<dd>
					<label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_submit']; ?>" /></label>
				</dd>
			</dl>
		</form>
	</div>
</div>