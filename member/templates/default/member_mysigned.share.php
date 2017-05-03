<?php echo $output['find']['store_name'] ?>
<p>
	<?php foreach ($output['find']['privilege_val'] as $key => $val) { ?>
		累计购买<?php echo $key ?>以上，可按<?php echo $val ?>%返回水币 <br />
	<?php } ?>
</p>
<div class="eject_con">
	<div class="adds">
		<div id="warning"></div>
		<form method="post" action="<?php echo MEMBER_SITE_URL;?>/index.php?act=member_mysigned&op=agree" id="address_form" target="_parent">
			<input type="hidden" name="form_submit" value="ok" />
			<input type="hidden" name="pid" value="<?php echo $output['find']['id'] ?>">
			<input type="hidden" name="seller_id" value="<?php echo $output['find']['seller_id'] ?>">
			<div class="bottom">
				<label class="submit-border">
					<input type="password" placeholder="填写登录密码" name="loginPwd">
				</label>
				<label class="submit-border">
					<input type="submit" class="submit" value="确认同意" />
				</label>
				<a class="ncbtn ml5" href="javascript:DialogManager.close('my_signed_share');">取消</a> 
			</div>
		</form>
	</div>
</div>