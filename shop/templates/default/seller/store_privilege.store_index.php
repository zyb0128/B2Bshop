<?php defined('In33hao') or exit('Access Invalid!');?>

<div class="tabmenu">
	<?php include template('layout/submenu');?>
	<a title="刷新" class="ncbtn ncbtn-aqua" href="index.php?act=store_privilege&op=index&getshua=1" style="right:100px" onclick="return confirm('您确定要执行刷新吗？');"><i class="icon-refresh"></i>刷新</a>
	<a href="javascript:void(0)" class="ncbtn ncbtn-mint" nc_type="dialog" dialog_title="<?php echo $lang['member_privilege_add'];?>" dialog_id="my_goods_brand_apply" dialog_width="480" uri="index.php?act=store_privilege&op=privilege_add"><?php echo $lang['member_privilege_add'];?></a>
</div>
<div class="ncsc-form-default">
	<table class="ncsc-default-table">
		<thead>
			<tr>
				<th class="w150"><?php echo $lang['list_title_header_privilege_goods'];?></th>
				<th><?php echo $lang['list_title_header_privilege_first'];?></th>
				<th><?php echo $lang['list_title_header_privilege_second'];?></th>
				<th><?php echo $lang['list_title_header_privilege_thirdly'];?></th>
				<th><?php echo $lang['list_title_header_privilege_fourthly'];?></th>
				<th><?php echo $lang['list_title_header_privilege_fifth'];?></th>
				<th><?php echo $lang['list_title_header_privilege_sixth'];?></th>
				<th class="w200"><?php echo $lang['nc_handle'];?></th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($output['list'])) { ?>
			<?php foreach($output['list'] as $val) { ?>
			<tr class="bd-line">
				<td><?php echo $val['goods_name']; ?></td>
				<td><?php echo $val['privilege_name']; ?></td>
				<td><?php echo $val['privilege_time_name']; ?></td>
				<td>
					<?php foreach($val['privilege_val'] as $key => $vall) { ?>
						<?php echo $key ?> 以上，按  <?php echo $vall ?> %算 <br>
					<?php } ?>
				</td>
				<td><?php echo date('Y-m-d H:i',$val['privilege_valid_starttime']); ?>至<?php echo date('Y-m-d H:i',$val['privilege_valid_endtime']); ?></td>
				<td><?php if ($val['privilege_status'] < '2') {  ?> 生效中 <?php } else { ?> 已过期<?php } ?></td>
				<td><?php echo $val['privilege_vip_name']; ?></td>
				<td class="nscs-table-handle">
					<?php if ($val['share'] != '1') { ?>
					<span><a href="javascript:void(0)" class="btn-bluejeans" nc_type="dialog" dialog_title="<?php echo $lang['member_privilege_edit'];?>" dialog_id="my_goods_brand_edit" dialog_width="480" uri="index.php?act=store_privilege&op=privilege_add&privilege_id=<?php echo $val['id']; ?>"><i class="icon-edit"></i><p><?php echo $lang['nc_edit'];?></p></a></span>
					<span><a href="javascript:void(0)" class="btn-bluejeans" nc_type="dialog" dialog_title="<?php echo $lang['member_privilege_share'];?>" dialog_id="my_goods_brand_share" dialog_width="480" uri="index.php?act=store_privilege&op=privilege_share&privilege_id=<?php echo $val['id']; ?>"><i class="icon-share"></i><p>发布</p></a></span>
					<?php } ?>
					<span><a href="index.php?act=store_privilege&op=privilege_check&privilege_id=<?php echo $val['id']; ?>"  class="btn-bluejeans"><i class="icon-check"></i><p>已签约人</p></a></span>
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
</div>

