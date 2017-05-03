<?php defined('In33hao') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<div class="tabmenu">
	<?php include template('layout/submenu');?>
</div>
<form method="get" action="index.php" target="_self">
	<table class="search-form">
		<input type="hidden" name="act" value="store_brokerage" />
		<input type="hidden" name="op" value="index_year" />
		<input type="hidden" name="submit" value="ok"> 
		<input type="hidden" name="pay_t" value="4">  
		<tr>
			<td class="tr">
				<div class="fr">
					<label class="submit-border"><input type="submit" class="submit" value="生成" /></label>
				</div>
				<div class="fr">
					<div class="fl" style="margin-right:3px;">
						<select name="pay_buyer_id" class="querySelect">
							<option value="" <?php echo $output['search_arr']['pay_buyer_id']==''?'selected':''; ?>>全部用户</option>
							<?php foreach ($output['vip'] as $val){?>
							<option value="<?php echo $val['buyer_id'] ?>" <?php echo $output['search_arr']['pay_buyer_id']==$val['buyer_id']?'selected':''; ?>> <?php echo $val['info']['member_name'] ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="fl" style="margin-right:3px;">
						<select name="pay_goods_id" class="querySelect">
							<option value="">全部商品</option>
							<?php foreach ($output['goodslist'] as $val){?>
							<option value="<?php echo $val['goods_commonid'] ?>" <?php echo $output['search_arr']['pay_goods_id']==$val['goods_commonid']?'selected':''; ?>> <?php echo $val['goods_name'] ?> </option>
							<?php } ?>
						</select>
					</div>
					<div class="fl" style="margin-right:3px;">
						<select name="pay_privilege_id" class="querySelect">
							<option value="1">销量</option>
							<option value="2">金额</option>
						</select>
					</div>
					<div class="fl" style="margin-right:3px;">
						<select name="pay_year" class="querySelect">
							<option value="2017">2017年</option>
							<option value="2018">2018年</option>
							<option value="2019">2019年</option>
							<option value="2020">2020年</option>
						</select>
					</div>
				</div>
			</td>
		</tr>
	</table>
</form>

<table class="ncsc-default-table">
	<thead>
		<tr>
			<th class="w10"></th>
			<th>客户名称</th>
			<th>产品名称</th>
			<th>数量与金额</th>
			<th>政策</th>
			<th>返利状态</th>
			<th>记录日期</th>
			<th>金额</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($output['list'])) { ?>
		<?php foreach($output['list'] as $val) { ?>
		<tr class="bd-line">
			<td></td>
			<td><?php echo $val['user']['member_name']; ?></td>
			<td><?php echo $val['goods']['goods_name']; ?></td>
			<td><?php echo $val['pay_num']; ?>件 / <?php echo $val['pay_fee']; ?> 元 </td>
			<td>
				用户等级： <?php echo $val['pol']['privilege_vip_name'] ?> <br />
				<?php foreach($val['pol']['privilege_val'] as $key => $vall) { ?>
					<?php echo $key ?> 以上，按  <?php echo $vall ?> %算 <br>
				<?php } ?>
			</td>
			<td><?php if($val['status'] == '1') { ?>未返利<?php } else { ?>已返利<?php } ?></td>
			<td><?php echo date('Y',$val['add_time']); ?>年</td>
			<td><?php echo $val['scale_fee'] ?></td>
			<td><?php if($val['status'] == '1') { ?><a href="index.php?act=store_brokerage&op=pay&secret=<?php echo $val['secret'] ?>">同意</a><?php } else { ?><?php } ?></td>
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