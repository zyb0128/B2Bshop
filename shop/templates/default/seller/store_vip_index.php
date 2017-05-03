<?php defined('In33hao') or exit('Access Invalid!');?>

<div class="tabmenu">
	<?php include template('layout/submenu');?>
	<!-- <a href="#" class="ncbtn ncbtn-mint">新增会员</a> -->
</div>
<table class="search-form">
	<form method="get">
		<input type="hidden" name="act" value="">
		<input type="hidden" name="op" value="">
		<tr>
			<td>&nbsp;</td>
			<th><?php echo $lang['store_goods_brand_name'];?></th>
			<td class="w160"><input type="text" class="text" name="brand_name" value="<?php echo $_GET['brand_name']; ?>"/></td>
			<td class="w70 tc"><label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" /></label></td>
		</tr>
	</form>
</table>

<table class="ncsc-default-table">
	<thead>
		<tr>
			<th class="w150">会员帐号</th>
			<th>会员头像</th>
			<th>会员等级</th>
			<th>注册时间</th>
			<th class="w100">最后登录时间</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($output['list'])) { ?>
		<?php foreach($output['list'] as $val) { ?>
		<tr class="bd-line">
			<td><?php echo $val['info']['member_name']; ?></td>
			<td><img src="<?php echo brandImage($val['info']['member_avatar']);?>" onload="javascript:DrawImage(this,88,44);" /></td>
			<td>
				<select id="playVip" vipid="<?php echo $val['buyer_id']; ?>">
					<option value="">普通会员</option>
					<?php foreach($output['viplist'] as $vasl) { ?>
					<option value="<?php echo $vasl['id']; ?>" <?php if ($vasl['id'] == $val['vip_id']){ ?> selected="selected" <?php } ?>><?php echo $vasl['vip_level_name']; ?></option>
					<?php } ?>
				</select>
			</td>
			<td><?php echo date('Y-m-d H:i:s',$val['info']['member_time']); ?></td>
			<td><?php echo date('Y-m-d H:i:s',$val['info']['member_old_login_time']); ?></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr>
			<td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
		</tr>
		<?php } ?>
	</tbody>
	<tfoot>
		<?php if (!empty($output['list'])) { ?>
		<tr>
			<td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
		</tr>
		<?php } ?>
	</tfoot>
</table>

<script type="text/javascript">
	$(function() {
		$("#playVip").change(function(){
			var vipid = $(this).attr("vipid");
			var updata = $(this).val();
			var inajax = "1";
			var url = "index.php?act=store_vip&op=ajax_updata";
			var data = {vipid:vipid,updata:updata,inajax:inajax};
			$.ajax({
				url:url,
				data:data,
				dataType:'json',
				type:'post',
				success:function(v){
					alert(v.msg);
				}
			})
		})
	})
</script>