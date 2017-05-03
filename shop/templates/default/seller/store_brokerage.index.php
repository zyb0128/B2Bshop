<?php defined('In33hao') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<div class="tabmenu">
	<?php include template('layout/submenu');?>
</div>
<!-- <form method="get" action="index.php" target="_self">
	<table class="search-form">
		<input type="hidden" name="act" value="store_brokerage" />
		<input type="hidden" name="op" value="index" />
		<tr>
			<td class="tr">
				<div class="fr">
					<label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_common_search'];?>" /></label>
				</div>
				<div class="fr">
					<div class="fl" style="margin-right:3px;">
						<select name="pay_buyer_id" id="search_type" class="querySelect">
							<option value="" <?php echo $output['search_arr']['pay_buyer_id']==''?'selected':''; ?>>全部用户</option>
							<?php foreach ($output['vip'] as $val){?>
							<option value="<?php echo $val['buyer_id'] ?>" <?php echo $output['search_arr']['pay_buyer_id']==$val['buyer_id']?'selected':''; ?>> <?php echo $val['info']['member_name'] ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="fl" style="margin-right:3px;">
						<select name="pay_goods_id" id="search_type" class="querySelect">
							<option value="" <?php echo $output['search_arr']['pay_goods_id']==''?'selected':''; ?>>全部</option>
							<?php foreach ($output['goodslist'] as $val){?>
							<option value="<?php echo $val['goods_commonid'] ?>" <?php echo $output['search_arr']['pay_goods_id']==$val['goods_commonid']?'selected':''; ?>> <?php echo $val['goods_name'] ?> </option>
							<?php } ?>
						</select>
					</div>
					<input type="text" class="text w70" name="search_start_time" id="search_start_time" value=" <?php if (empty($output['search_arr']['start_time'])) { ?> <?php echo date('Y-m-d');?> <?php }else{ ?> <?php echo date('Y-m-d',$output['search_arr']['start_time']);?><?php } ?>" /> ~
					<input type="text" class="text w70" name="search_end_time" id="search_end_time" value=" <?php if (empty($output['search_arr']['end_time'])) { ?> <?php echo date('Y-m-d');?> <?php }else{ ?> <?php echo date('Y-m-d',$output['search_arr']['end_time']);?><?php } ?>" />
					<label class="add-on"><i class="icon-calendar"></i></label>
				</div>
			</td>
		</tr>
	</table>
</form> -->


<table class="ncsc-default-table">
	<thead>
		<tr>
			<th class="w10"></th>
			<th>结算单号</th>
			<th>产品名称</th>
			<th>数量与金额</th>
			<th>会员</th>
			<th>下单日期</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($output['list'])) { ?>
		<?php foreach($output['list'] as $val) { ?>
		<tr class="bd-line">
			<td></td>
			<td><?php echo $val['order_sn']; ?></td>
			<td><?php echo $val['goodsInfo']['']; ?></td>
			<td><?php echo $val['pay_num']; ?>件 / <?php echo $val['pay_fee']; ?> 元 </td>
			<td>
			姓名:<?php echo $val['buyer_name']; ?><br/>等级:<?php echo $val['buyer_vip_name']; ?>
			</td>
			<td><?php echo date('Y-m-d H:i:s',$val['add_time']); ?></td>
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

<div>
	<?php if (!empty($output['countlist'])) { ?>
	商家： <?php echo $output['countlist']['seller_name'] ?>  已购买数量：<?php echo $output['countlist']['buyNum'] ?>  已消费金额：<?php echo $output['countlist']['buyFee'] ?> 【享有<?php echo $output['countlist']['scale']*100 ?>%返利比例，可返利：<?php echo $output['countlist']['scale_fee'] ?> 元】 + <a href="index.php?act=store_brokerage&op=pay&secret=<?php echo $output['countlist']['secret'] ?>">返利按钮</a> +
	<?php } ?>
</div>

<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js"></script>
<script type="text/javascript">
	$('#search_end_time , #search_start_time').datepicker({dateFormat: 'yy-mm-dd'});
</script>