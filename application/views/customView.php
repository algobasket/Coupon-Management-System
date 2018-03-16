<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coupon Management</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>

<center>
<?php echo anchor('custom/createCoupon','Create Coupon');?> |
<?php echo anchor('custom/allCoupon','All Coupons');?> |
<?php echo anchor('custom/allCoupon/available','Available Coupon');?> |
<?php echo anchor('custom/allCoupon/expired','Expired Coupon');?> |
<?php echo anchor('custom/allCoupon/deactive','Deactive Coupon');?> |
<?php echo anchor('custom/shippingPage','Shipping Page');?>
</center>
<?php echo $this->session->flashdata('alert');?>
<?php if(isset($isCreateCoupon) && ($isCreateCoupon == true)): ?>
<?php echo form_open('custom/createCoupon');?>
<center><table class="table" cellpadding="10">
	<tr>
		<td>Coupon Name</td>
		<td><input type="text" required  class="form-control" name="couponName" /></td>
	</tr>
  <tr>
		<td>Coupon Code</td>
		<td>
     (Alphanumeric Character upto 30 character)<br>
      <input type="text" required  class="form-control" name="couponCode" id="couponCode" /><button type="button" onclick="createCreateCodes()">Create Dynamic Code</button></td>
	</tr>
<tr>
		<td>Coupon Type</td>
		<td>
			<select class="form-control"   name="couponType">
				<option>Coupon Type</option>
				<option value="specialCoupon">Special Coupon</option>
				<option value="deluxeCoupon">Deluxe Coupon</option>
				<option value="premiumCoupon">Premium Coupon</option>
				<option value="luxuryCoupon">Luxury Coupon</option>
			</select>
		</td>
	</tr>
<tr>
		<td>Start Date</td>
		<td>
			<input type="text" required  class="form-control" name="couponStartDate" placeholder="dd-mm-YY" id="datepicker" />
      <script>
          $('#datepicker').datepicker({
              uiLibrary: 'bootstrap4'
          });
      </script>
    </td>
	</tr>
	<tr>
		<td>Expiry Date</td>
		<td>
			<input type="text" required  class="form-control" name="couponExpiryDate" placeholder="dd-mm-YY" id="datepicker2" />
      <script>
          $('#datepicker2').datepicker({
              uiLibrary: 'bootstrap4'
          });
      </script>
    </td>
	</tr>
	<tr>
		<td>Amount</td>
		<td>
			<input type="text" required  class="form-control" name="couponAmount" placeholder="Coupon Amount" />
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" class="btn btn-primary" name="createCoupon" value="createCoupon" />
		</td>
	</tr>

</center></table>
<?php echo form_close();?>
<?php endif ?>


<?php if(isset($isUpdateCoupon) && ($isUpdateCoupon == true)): ?>
<?php foreach($singleCoupon as $coupon){} ?>
<?php echo form_open('custom/updateCoupon');?>
<center><table class="table" cellpadding="10">
	<tr>
		<td>Coupon Name</td>
		<td><input type="text" required  class="form-control" name="couponName" value="<?php echo $coupon['couponName'];?>" /></td>
	</tr>
  <tr>
		<td>Coupon Code</td>
		<td><input type="text" required  class="form-control" name="couponCode" id="couponCode" value="<?php echo $coupon['couponCode'];?>"/><button type="button" onclick="createCreateCodes()">Create Dynamic Code</button></td>
	</tr>
<tr>
		<td>Coupon Type</td>
		<td>
		<select class="form-control"   name="couponType">
		<option >Coupon Type</option>
		<option <?php echo ($coupon['couponType'] == "specialCoupon") ? "selected":"" ?> value="specialCoupon">Special Coupon</ption>
		<option <?php echo ($coupon['couponType'] == "deluxeCoupon") ? "selected":"" ?> value="deluxeCoupon">Deluxe Coupon</option>
		<option <?php echo ($coupon['couponType'] == "premiumCoupon") ? "selected":"" ?> value="premiumCoupon">Premium Coupon</option>
		<option <?php echo ($coupon['couponType'] == "luxuryCoupon") ? "selected":"" ?> value="luxuryCoupon">Luxury Coupon</option>
		</select>
		</td>
	</tr>
<tr>
		<td>Start Date</td>
		<td>
			<input type="text" required  class="form-control" name="couponStartDate" placeholder="dd-mm-YY" value="<?php echo $coupon['couponStartDate'];?>" />
		</td>
	</tr>
	<tr>
		<td>Expiry Date</td>
		<td>
			<input type="text" required  class="form-control" name="couponExpiryDate" placeholder="dd-mm-YY" value="<?php echo $coupon['couponExpiryDate'];?>" />
		</td>
	</tr>
	<tr>
		<td>Amount</td>
		<td>
			<input type="text" required  class="form-control" name="couponAmount" placeholder="Coupon Amount" value="<?php echo $coupon['couponAmount'];?>" />
		</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>
		<select class="form-control"   name="couponStatus">
		<option <?php echo ($coupon['couponStatus'] == "available") ? "selected":"" ?> value="available">Available Coupon</ption>
		<option <?php echo ($coupon['couponStatus'] == "used") ? "selected":"" ?> value="used">Used Coupon</option>
		<option <?php echo ($coupon['couponStatus'] == "expired") ? "selected":"" ?> value="expired">Expired Coupon</option>
		<option <?php echo ($coupon['couponStatus'] == "deactive") ? "selected":"" ?> value="deactive">Deactive Coupon</option>
		</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" class="btn btn-primary" name="updateCoupon" value="createCoupon" />
		</td>
	</tr>

</center></table>
<?php echo form_close();?>
<?php endif ?>



<?php if(isset($isSingleCoupon) &&  ($isSingleCoupon == true)): ?>
<?php foreach($singleCoupon as $coupon){} ?>

<center><table class="table" cellpadding="10">
	<tr>
		<td>Coupon Name</td>
		<td><?php echo $coupon['couponName'];?></td>
	</tr>
  <tr>
  		<td>Coupon Code</td>
  		<td>
  		<?php echo $coupon['couponCode'] ?>
  		</td>
  	</tr>
<tr>
		<td>Coupon Type</td>
		<td>
		<?php echo $coupon['couponType'] ?>
		</td>
	</tr>
<tr>
		<td>Start Date</td>
		<td>
			<?php echo $coupon['couponStartDate'];?>
		</td>
	</tr>
	<tr>
		<td>Expiry Date</td>
		<td>
			<?php echo $coupon['couponExpiryDate'];?>
		</td>
	</tr>
	<tr>
		<td>Amount</td>
		<td>
			<?php echo $coupon['couponAmount'];?>
		</td>
	</tr>

</center></table>
<?php echo form_close();?>
<?php endif ?>




<?php if(isset($isAllCoupon) && ($isAllCoupon == true)): ?>


<center><table class="table" cellpadding="10">
	<tr>
		<td>Coupon Name</td>
    <td>Coupon Code</td>
		<td>Coupon Type</td>
    <td>Start Date</td>
    <td>Expiry Date</td>
    <td>Amount</td>
    <td>Status</td>
	</tr>
 <?php foreach($allCoupon as $coupon): ?>
  <tr>
   <td><?php echo $coupon['couponName'];?></td>
   <td><?php echo $coupon['couponCode'];?></td>
   <td><?php echo $coupon['couponType'] ?></td>
   <td><?php echo $coupon['couponStartDate'];?></td>
   <td><?php echo $coupon['couponExpiryDate'];?></td>
   <td><?php echo $coupon['couponAmount'];?></td>
   <td><?php echo $coupon['couponStatus'];?></td>
    <td><?php echo anchor('custom/deleteCoupon/'.$coupon['id'],'Delete');?></td>
  </tr>
<?php endforeach ?>
</center></table>
<?php echo form_close();?>
<?php endif ?>


<?php if(isset($isShippingPage) &&  ($isShippingPage == true)): ?>
<?php echo form_open('custom/shippingPage');?>
<center><table class="table" cellpadding="10">
	<tr>
		<td><input type="text" name="fullName" class="form-control" placeholder="Full Name" required/></td>
		<td>
      <select name="country" class="form-control">
        <option value="northKorea">North Korea</option>
        <option value="russia">Russia</option>
        <option value="usa">United States</option>
        <option value="italy">Italy</option>
      </select>
    </td>
	</tr>
  <tr>
  		<td><input type="text" name="addressLine1" class="form-control" placeholder="Address Line 1" required /></td>
  		<td>
  		<input type="text" name="addressLine2" class="form-control" placeholder="Address Line 2" />
  		</td>
  	</tr>
<tr>
		<td><input type="text" name="city" class="form-control" placeholder="City" required /></td>
		<td>
		<input type="text" name="state" class="form-control" placeholder="state" required />
		</td>
	</tr>
<tr>
		<td><input type="text" name="postalCode" class="form-control" placeholder="Postal Code" required /></td>
		<td>
			<input type="text" name="phone" class="form-control" placeholder="Phone" required />
		</td>
	</tr>
  <tr>
  		<td>  <input type="text" name="email" class="form-control" placeholder="Email" required /></td>
  		<td>
  		</td>
  	</tr>
	<tr>
		<td>
      Shipping Method<br>
      <h4>White (Sold By AlgoBasket)</h4><br>
      <input type="radio" name="shipping[]" /> Shipping Rate(5-7 days)<br>
      $1.00 USA Only
    </td>
		<td>
    <br>
    <br><br>
      <input type="radio" name="shipping[]" /> RUSH Shipping Rate(1 day)<br>
      $10.00 USA Only
		</td>
	</tr>
	<tr>
		<td> < Return to product detail</td>
		<td>
    <input type="submit" name="shippingSubmit" class="btn btn-primary" value="Next" />
		</td>
	</tr>
</table></center>
<?php echo form_close();?>
<?php endif ?>




<script>
 function createCreateCodes(){
   var couponCode = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
   document.getElementById('couponCode').value = couponCode.toUpperCase();
   console.log(couponCode);
 }
</script>
