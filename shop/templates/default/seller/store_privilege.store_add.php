<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<div class="eject_con">
	<div id="warning" class="alert alert-error"></div>
	<form method="post" target="_parent" action="index.php?act=store_privilege&op=store_bao"enctype="multipart/form-data" id="brand_apply_form">
		<input type="hidden" name="form_submit" value="ok" />
		<input type="hidden" name="privilege_id" value="<?php echo $output['privilegeInfo']['id']; ?>" />
		<dl>
			<dt><?php echo $lang['store_privilege_goods_class'].$lang['nc_colon'];?></dt>
			<dd id="gcategory1">
				<select name="goods_id">
					<option value="0"><?php echo $lang['nc_please_choose'];?></option>
					<?php if(!empty($output['goods_list'])){ ?>
					<?php foreach($output['goods_list'] as $k => $v){ ?>
					<option value="<?php echo $v['goods_id'];?>"  <?php if ($v['goods_id'] == $output['privilegeInfo']['goods_id']){ ?> selected="selected" <?php } ?>  ><?php echo $v['goods_name'];?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</dd>
		</dl>

		<dl>
			<dt><?php echo $lang['store_privilege_type_class'].$lang['nc_colon'];?></dt>
			<dd id="gcategory2">
				<select name="privilege_type">
					<option value="0"><?php echo $lang['nc_please_choose'];?></option>
					<option value="1" <?php if ('1' == $output['privilegeInfo']['privilege_type']){ ?> selected="selected" <?php } ?>>销量</option>
					<option value="2" <?php if ('2' == $output['privilegeInfo']['privilege_type']){ ?> selected="selected" <?php } ?>>金额</option>
				</select>
			</dd>
		</dl>
		
		<dl>
			<dt><?php echo $lang['store_privilege_time_class'].$lang['nc_colon'];?></dt>
			<dd id="gcategory3">
				<select name="privilege_time">
					<option value="0"><?php echo $lang['nc_please_choose'];?></option>
					<option value="1" <?php if ('1' == $output['privilegeInfo']['privilege_time_type']){ ?> selected="selected" <?php } ?>>单返</option>
					<option value="2" <?php if ('2' == $output['privilegeInfo']['privilege_time_type']){ ?> selected="selected" <?php } ?>>月返</option>
					<option value="3" <?php if ('3' == $output['privilegeInfo']['privilege_time_type']){ ?> selected="selected" <?php } ?>>季度返</option>
					<option value="4" <?php if ('4' == $output['privilegeInfo']['privilege_time_type']){ ?> selected="selected" <?php } ?>>年返</option>
				</select>
			</dd>
		</dl>
		
		<dl>
			<dt><?php echo $lang['store_privilege_text_class'].$lang['nc_colon'];?></dt>
			
			<?php if (is_array($output['privilegeInfo']['privilege_val'])){ ?>
			<dd id="privilege_time_1">
				<?php foreach ($output['privilegeInfo']['privilege_val'] as $key => $rows) { ?>
				<input type="text" name="privilege_limit[]" placeholder="限制" value=" <?php echo  $key ?> " id="brand_initial" />
				<input type="text" name="privilege_text[]" placeholder="百分比" value="<?php echo $rows ?>" id="brand_initial" />
				<?php } ?>
			</dd>
			<?php }else{ ?>
			<dd id="privilege_time_1">
				<input type="text" name="privilege_limit[]" placeholder="限制" value="" id="brand_initial" />
				<input type="text" name="privilege_text[]" placeholder="百分比" value="" id="brand_initial" />
				<input type="text" name="privilege_limit[]" placeholder="限制" value="" id="brand_initial" />
				<input type="text" name="privilege_text[]" placeholder="百分比" value="" id="brand_initial" />
				<input type="text" name="privilege_limit[]" placeholder="限制" value="" id="brand_initial" />
				<input type="text" name="privilege_text[]" placeholder="百分比" value="" id="brand_initial" />
			</dd>
			<?php } ?>
		</dl>
		
		<!-- 每笔 -->
		<dl>
			<dt><?php echo $lang['store_privilege_valid_class'].$lang['nc_colon'];?></dt>
			<dd id="gcategory5">
				<input type="text" class="w80 text" data-dp="1" name="starttime" id="starttime" value="<?php if ($output['privilegeInfo']['privilege_valid_starttime'] == ''){ ?> <?php echo date('Y-m-d');?> <?php } else { ?> <?php echo date('Y-m-d',$output['privilegeInfo']['privilege_valid_starttime']);?> <?php } ?>" /> 至 
				<input type="text" class="w80 text" data-dp="1" name="endtime" id="endtime" value="<?php if ($output['privilegeInfo']['privilege_valid_endtime'] == ''){ ?> <?php echo date('Y-m-d');?> <?php } else { ?> <?php echo date('Y-m-d',$output['privilegeInfo']['privilege_valid_endtime']);?> <?php } ?>" />
			</dd>
		</dl>

		<dl>
			<dt><?php echo $lang['store_privilege_vip_class'].$lang['nc_colon'];?></dt>
			<dd id="gcategory6">
				<select name="privilege_vip">
					<option value=""><?php echo $lang['nc_please_choose'];?></option>
					<option value="0">普通用户</option>
					<?php foreach ($output['viplist'] as $val) { ?>
					<option value="<?php echo $val['id'];?>"><?php echo $val['vip_level_name'];?></option>
					<?php } ?>
				</select>
			</dd>
		</dl>

		<div class="bottom">
			<label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_submit'];?>"/></label>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(function() {
		$("input[data-dp='1']").datepicker({dateFormat: 'yy-mm-dd'});
	})
</script>