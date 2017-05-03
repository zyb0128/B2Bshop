<?php defined('In33hao') or exit('Access Invalid!');?>

<div class="tabmenu">
	<?php include template('layout/submenu');?>
	<a href="javascript:void(0)" class="ncbtn ncbtn-mint" nc_type="dialog" dialog_title="新增会员等级" dialog_id="my_goods_brand_apply" dialog_width="480" uri="index.php?act=store_vip&op=vip_add">新增等级</a>
</div>

<table class="ncsc-default-table">
	<thead>
		<tr>
			<th class="w150">等级名称</th>
			<th></th>
			<th></th>
			<th></th>
			<th class="w100">操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($output['list'])) { ?>
		<?php foreach($output['list'] as $val) { ?>
		<tr class="bd-line">
			<td><?php echo $val['vip_level_name'] ?></td>
			<td></td>
			<td> </td>
			<td></td>
			<td class="nscs-table-handle">
				<span><a href="javascript:void(0)" class="btn-bluejeans" nc_type="dialog" dialog_title="等级编辑" dialog_id="my_goods_brand_edit" dialog_width="480" uri="index.php?act=store_vip&op=vip_add&vip_id=<?php echo $val['id']; ?>"><i class="icon-edit"></i><p><?php echo $lang['nc_edit'];?></p></a></span>
			</td>
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