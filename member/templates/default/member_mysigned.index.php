<?php defined('In33hao') or exit('Access Invalid!');?>

<div class="wrap">
	<div class="tabmenu">
		<?php include template('layout/submenu');?>
	</div>
	

	<table class="ncm-default-table">
		<thead>
			<tr>
				<th >标题</th>
				<th ></th>
				<th >简介</th>
				<th ></th>
				<th >有效期</th>
				<th ></th>
				<th >店铺</th>
				<th ><?php echo $lang['nc_handle'];?></th>
			</tr>
		</thead>
		<tbody>
		<?php  if (count($output['list'])>0) { ?>
		<?php foreach($output['list'] as $val) { ?>
			<?php foreach($val['privilegelist'] as $vals) { ?>
			<tr class="bd-line">
				<td><?php echo $vals['title'];?></td>
				<td></td>
				<td><?php echo $vals['intro'];?></td>
				<td></td>
				<td class="goods-time"><?php echo date("Y-m-d",$vals['privilege_valid_starttime']).'~'.date("Y-m-d",$vals['privilege_valid_endtime']);?></td>
				<td></td>
				<td><?php echo $vals['store_name'];?></td>
				<td>
					<?php  if (empty($vals['play'])) { ?>
					<a href="javascript:void(0)" dialog_title="同意协议" dialog_id="my_signed_share" class="ncbtn ncbtn-bittersweet" nc_type="dialog" uri="index.php?act=member_mysigned&op=signed_share&id=<?php echo $vals['id'];?>" dialog_width="550" title="同意协议"> <i class="icon-ok-sign"></i>同意</a>
					<?php } else { ?>
					<a href="javascript:void(0)" class="ncbtn ncbtn-bittersweet"><i class="icon-ok">已同意</i></a>
					<?php }?>
				</td>
			</tr>
			<?php }?>
		<?php }?>
		<?php } else { ?>
			<tr>
				<td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
			</tr>
		<?php } ?>
		</tbody>

		<tfoot>
			<tr>
				<td colspan="20"><div class="pagination"><?php echo $output['show_page'];?></div></td>
			</tr>
		</tfoot>
	</table>
</div>