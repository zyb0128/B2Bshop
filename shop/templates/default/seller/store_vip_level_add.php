<div class="eject_con">
	<div id="warning" class="alert alert-error"></div>
	<form method="post" target="_parent" action="index.php?act=store_vip&op=seva_vip"enctype="multipart/form-data" id="brand_apply_form">
		<input type="hidden" name="form_submit" value="ok" />
		<input type="hidden" name="vip_id" value="<?php echo $output['find']['id']; ?>" />
		
		<dl>
			<dt>会员等级名称 :</dt>

			<dd id="privilege_time_1">
				<input type="text" name="vip_level_name" placeholder="" value="<?php echo $output['find']['vip_level_name'];?>" id="brand_initial" />
			</dd>

		</dl>
		

		<div class="bottom">
			<label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_submit'];?>"/></label>
		</div>
	</form>
</div>