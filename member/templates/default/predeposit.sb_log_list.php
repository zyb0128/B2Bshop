<?php defined('In33hao') or exit('Access Invalid!');?>

<div class="wrap">
	<div class="tabmenu">
		<?php include template('layout/submenu');?>
		<a class="ncbtn ncbtn-bittersweet" title="在线充值" href="index.php?act=predeposit&op=recharge_sb_add" style="right: 0px;"><i class="icon-shield"></i>在线充值水币</a> 
		<!-- <a class="ncbtn ncbtn-mint" href="index.php?act=member_security&op=auth&type=pd_cash" style="right: 107px;"><i class="icon-money"></i>申请提现</a> 
		<a class="ncbtn ncbtn-bluejeansjeans" href="index.php?act=predeposit&op=rechargecard_add"><i class="icon-shield"></i>充值卡充值</a> --> 
	</div>
	<form method="get" action="index.php">
		<table class="ncm-search-table">
			<input type="hidden" name="act" value="predeposit" />
			<input type="hidden" name="op" value="sb_log_list" />
			<tr>
				<td>&nbsp;</td>
				<th>单号</th>
				<td class="w160 tc"><input type="text" class="text w150" name="pdr_sn" value="<?php echo $_GET['"pdr_sn"'];?>"/></td>
				<td class="w70 tc"><label class="submit-border">
						<input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" />
					</label></td>
			</tr>
		</table>
	</form>
	<table class="ncm-default-table">
		<thead>
			<tr>
				<th><?php echo $lang['predeposit_rechargesn']; ?></th>
				<th class="w150"><?php echo $lang['predeposit_addtime']; ?></th>
				<th class="w150"><?php echo $lang['predeposit_payment']; ?></th>
				<th class="w150"><?php echo $lang['predeposit_recharge_price']; ?>(<?php echo $lang['currency_zh'];?>)</th>
				<th class="w150"><?php echo $lang['predeposit_paystate']; ?></th>
				<th class="w110"><?php echo $lang['nc_handle'];?></th>
			</tr>
		</thead>
		<tbody>
			<?php if (count($output['list'])>0) { ?>
			<?php foreach($output['list'] as $val) { ?>
			<tr class="bd-line">
				<td><?php echo $val['pdr_sn'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$val['pdr_add_time']);?></td>
				<td><?php echo $val['pdr_payment_name'];?></td>
				<td class="red">+<?php echo $val['pdr_amount'];?></td>
				<td><?php echo intval($val['pdr_payment_state']) ? '已支付' : '未支付';?></td>
				<td class="ncm-table-handle">
					<span><a href="../shop/index.php?act=buy&op=pd_sb_pay&pay_sn=<?php echo $val['pdr_sn'];?>" class="btn-mint"><i class="icon-shield"></i><p>支付</p></a></span>
				</td>
			</tr>
			<?php } ?>
			<?php } else {?>
			<tr>
				<td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<?php if (count($output['list'])>0) { ?>
			<tr>
				<td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
			</tr>
			<?php } ?>
		</tfoot>
	</table>
</div>