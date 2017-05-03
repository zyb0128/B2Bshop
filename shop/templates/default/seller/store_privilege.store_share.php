<div class="eject_con">
	<div id="warning" class="alert alert-error"></div>
	<form method="post" target="_parent" action="index.php?act=store_privilege&op=store_bao_share"enctype="multipart/form-data" id="brand_apply_form">
		<input type="hidden" name="pid" value="<?php echo $output['find']['id'];?>">
		<dl>
			<dt>标题</dt>
			<dd id="gcategory1">
				<input type="text" name="title" placeholder="" value="<?php echo $output['find']['title'];?>" id="brand_initial" />
			</dd>
		</dl>
		<dl>
			<dt>简介</dt>
			<dd id="gcategory1">
				<textarea name="intro" rows="2" class="textarea w250" maxlength="50"><?php echo $output['find']['intro'];?></textarea>
			</dd>
		</dl>
		<div class="bottom">
			<label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_submit'];?>"/></label>
		</div>
	</form>
</div>