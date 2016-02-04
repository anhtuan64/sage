<?php 
/**
 * Template Name: page register template
 *
 * @package RT
 * @subpackage Sage
 * @since 1.0
 */

get_header(); 
?>
<h1 class="page-heading"><?php echo rt_replace_color_title_in_archive( get_the_title() );?></h1>
<div class="page-register"> 
	<h4> <?php echo __( 'Enroll now', RT_LANGUAGE ) ?> </h4>
<form action="" method="post">
	<div class="box-science course-information">
		<h3> <?php echo __( 'Course Information', RT_LANGUAGE ) ?> </h3>
		<?php 
			$regiser_name = get_field( "khoahoc_regiser", get_the_ID() );
			$address = get_field( "diadiem_regiser", get_the_ID() );
			$date = get_field( "date_register", get_the_ID() );
		?> 
		<ul> 
			<li> 
				<span class="left">	<?php echo __( 'Science name: *', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					<select name="science-name" required>
						<?php 
							for ($i=0; $i < count($regiser_name); $i++) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $regiser_name[$i]['name_science']; ?></option>
						<?php	
							}	
						?>				
					</select>
				</span>
			</li><!-- end Science name  -->
			<li> 
				<span class="left">	<?php echo __( 'Place: *', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					<select name="place" required>
						<?php 
							for ($i=0; $i < count($address); $i++) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $address[$i]['address']; ?></option>
						<?php	
							}	
						?>				
					</select>
				</span>
			</li><!-- end Place  -->
			<li> 
				<span class="left">	<?php echo __( 'Date: *', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					<select name="date" required>
						<?php 
							for ($i=0; $i < count($date); $i++) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $date[$i]['datetime']; ?></option>
						<?php	
							}	
						?>				
					</select>
				</span>
			</li><!-- end Date  -->
		</ul>
	</div> <!-- end Course Information -->

<div class="student-information">
	<div class="box-science">
		<h3> <?php echo __( 'Student information', RT_LANGUAGE ) ?> </h3>
		<?php 
			$specialize_register = get_field( "specialize_register", get_the_ID() );
		?> 
		<ul> 
			<li> 
				<span class="left">	<?php echo __( 'Name: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					<select name="courses" required>
						<option value="1">Mr</option>
						<option value="2">Ms</option>
					</select>
				</span>
			</li><!-- end name  -->
			<li> 
				<span class="left">	<?php echo __( 'First and last name: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					 <input class="firstandlast" placeholder="<?php echo __( 'First and last name: ', RT_LANGUAGE ) ?>" autofocus required />
				</span>
			</li><!-- end First and last name  -->
			<li> 
				<span class="left">	<?php echo __( 'Phone: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					 <input class="phone" placeholder="<?php echo __( 'Phone: ', RT_LANGUAGE ) ?>"  required />
				</span>
			</li><!-- end Phone  -->
			<li> 
				<span class="left">	<?php echo __( 'email: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					 <input class="email" placeholder="<?php echo __( 'Email: ', RT_LANGUAGE ) ?>"  required />
				</span>
			</li><!-- end email  -->
			<li> 
				<span class="left">	<?php echo __( 'Organization: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					 <input class="organization" placeholder="<?php echo __( 'organization: ', RT_LANGUAGE ) ?>"  required />
				</span>
			</li><!-- end Organization  -->
			<li> 
				<span class="left">	<?php echo __( 'Company: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					 <input class="company" placeholder="<?php echo __( 'Company: ', RT_LANGUAGE ) ?>"  required />
				</span>
			</li><!-- end Company  -->
			<li> 
				<span class="left">	<?php echo __( 'Position: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					 <input class="position" placeholder="<?php echo __( 'Position: ', RT_LANGUAGE ) ?>"  required />
				</span>
			</li><!-- end Position  -->
			<li> 
				<span class="left">	<?php echo __( 'Field: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					<select name="field" required>
						<?php 
							for ($i=0; $i < count($specialize_register); $i++) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $specialize_register[$i]['specialize']; ?></option>
						<?php	
							}	
						?>				
					</select>
				</span>
			</li><!-- end Specialize  -->
		</ul>
	</div>
</div> <!-- end Student information -->

	<div class="box-science more-information">
		<h3> <?php echo __( 'Student information', RT_LANGUAGE ) ?> </h3>
		<?php 
			$source_register = get_field( "source_register", get_the_ID() );
			$pay = get_field( "thanhtoan_register", get_the_ID() );
		?> 
		<ul>
			<li> 
				<span class="left">	<?php echo __( 'You know what courses through sources?: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					<select name="source" required>
						<?php 
							for ($i=0; $i < count($source_register); $i++) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $source_register[$i]['source_name']; ?></option>
						<?php	
							}	
						?>				
					</select>
				</span>
			</li><!-- end You know what courses through sources  -->
			<li> 
				<span class="left">	<?php echo __( 'Payment type: ', RT_LANGUAGE ) ?> </span>
				<span class="right"> 
					<select name="payment-type" required>
						<?php 
							for ($i=0; $i < count($pay); $i++) {
						?>
							<option value="<?php echo $i; ?>"><?php echo $pay[$i]['pay_register']; ?></option>
						<?php	
							}	
						?>				
					</select>
				</span>
			</li><!-- end You know what courses through sources  -->
		</ul>
	</div> <!-- end More information -->

	<div class="button-register"> 
		<input class="button small" type="submit" name="register_submit" value="<?php echo __( ' Register ', RT_LANGUAGE ) ?>" />
		<a id="register_user_addmore" class="button navy small" href="#"><?php echo __( ' Plus subscribers ', RT_LANGUAGE ) ?></a>
	</div>

</form>
</div> <!-- page-register -->
<?php
if(isset($_POST['science-name'])){
    $select1 = $_POST['science-name'];
    var_dump($select1);
}
?>
<?php get_footer();