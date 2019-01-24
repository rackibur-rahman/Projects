<?php

/*
 * Generates seat chart html-content that is used to replace the shortcode
 */
function vh_gettheseatchart($showid, $type = '') {

global $screenspacing,$wpdb;
	if ($type == 'offline') {
		$offlineAdmin = 'admin';
	}
	if ($offlineAdmin != 'admin') {
		$type = apply_filters('rst_paypal_payment_type', '');
	}
	if (!$type) {
		$type = 'offline';
	}
	if ($type == 'paypal') {
		$type = '';
	}

	
	
$rst_options = get_option(RSTPLN_OPTIONS);  
if($rst_options['rst_idle_time'])   
{
$rstidlecounter=$rst_options['rst_idle_time'];
}else{
$rstidlecounter=10;
}

if($rst_options['rst_idle_clear_cart']) 
{
$rst_idle_clear_cart=$rst_options['rst_idle_clear_cart'];
}else{
$rst_idle_clear_cart=7;
}       
	
	$currenturl = curPageURL();

	$rst_paypal_options = get_option(RSTPLN_PPOPTIONS);
	$wplanguagesoptions = get_option(RSTLANGUAGES_OPTIONS);
	$event_name_title=__("Movie", "vh");
	$event_booking_closed=__("*Online Booking is Closed, We Appreciate Your Patronage!", "vh");
	$booking_warning=__("Online booking will close {DURATION} prior to engagement", "vh");
	$event_booking_warning1=__("Online booking will close", "vh");
	$event_booking_warning2=__("prior to engagement", "vh");
	$event_datetime=__("Event Date & Time", "vh");
	$event_time=__("Time", "vh");
    $event_date=__("Date", "vh");
	$event_venue=__("Venue", "vh");
	$event_empty_warning=__("Your cart will empty if idle for ", "vh").$rst_idle_clear_cart.__(" min.", "vh");
	$event_view_cart=__("View Cart", "vh");
	$event_seat_processing=__("Processing.....", "vh");
	$coupon_apply_memberid=__("Apply Member ID", "vh");
	$coupon_apply_coupon=__("Apply Coupon", "vh");
	$coupon_enter_memberid=__("Enter Member ID", "vh");
	$wpuser_onlyloggedin=__("Sorry, Only logged in users can access this show.", "vh");
	$event_double_booking=__("Sorry this seat is already booked by someone else", "vh");





	
	if($wplanguagesoptions['rst_enable_languages']=="on")
	{
		if($wplanguagesoptions['languages_event_double_booking'])
		{
			$event_double_booking=$wplanguagesoptions['languages_event_double_booking'];
		}
		
		if($wplanguagesoptions['languages_wpuser_onlyloggedin'])
		{
			$wpuser_onlyloggedin=$wplanguagesoptions['languages_wpuser_onlyloggedin'];
		}   
		if($wplanguagesoptions['languages_event_name'])
		{
			$event_name_title=$wplanguagesoptions['languages_event_name'];
		}
		if($wplanguagesoptions['languages_booking_closed'])
		{
			$event_booking_closed=$wplanguagesoptions['languages_booking_closed'];
		}       
		if($wplanguagesoptions['languages_booking_warning1'])
		{
			//$event_booking_closed=$wplanguagesoptions['languages_booking_warning1'];
		}       
		if($wplanguagesoptions['languages_booking_warning2'])
		{
			//$event_booking_closed=$wplanguagesoptions['languages_booking_warning2'];
		}       
		if($wplanguagesoptions['languages_event_datetime'])
		{
			$event_datetime=$wplanguagesoptions['languages_event_datetime'];
		}   
		if($wplanguagesoptions['languages_event_venue'])
		{
			$event_venue=$wplanguagesoptions['languages_event_venue'];
		}   
		if($wplanguagesoptions['languages_event_empty_warning'])
		{
			$event_empty_warning=$wplanguagesoptions['languages_event_empty_warning'];
		}       
		if($wplanguagesoptions['languages_event_view_cart'])
		{
			$event_view_cart=$wplanguagesoptions['languages_event_view_cart'];
		}   
		if($wplanguagesoptions['languages_booking_warning'])
		{
			$booking_warning=$wplanguagesoptions['languages_booking_warning'];
		}   

		if($wplanguagesoptions['languages_event_seat_processing'])
		{
			$event_seat_processing=$wplanguagesoptions['languages_event_seat_processing'];
		}   
	
		if($wplanguagesoptions['languages_coupon_apply_memberid'])
		{
			$coupon_apply_memberid=$wplanguagesoptions['languages_coupon_apply_memberid'];
		}           
		if($wplanguagesoptions['languages_coupon_apply_coupon'])
		{
			$coupon_apply_coupon=$wplanguagesoptions['languages_coupon_apply_coupon'];
		}       
		if($wplanguagesoptions['languages_coupon_enter_memberid'])
		{
			$coupon_enter_memberid=$wplanguagesoptions['languages_coupon_enter_memberid'];
		}           
		
			
	}

	$return_page = $rst_paypal_options['custom_return'];
	if ($return_page != '') {
		$currenturl = $return_page;
	}

	

	$stylecss = $rst_options['rst_theme'];
	if ($stylecss == '') {

		$stylecss = 'lite.css';

	}

	$rst_h_msg = $rst_options['rst_h_msg'];

	$paymentsuccess = "";

	//if (isset($_POST) && $_POST['custom'] != '') {
	 //   $paymentsuccess = succesrstsmessage();
   // }
	

	$screenspacing=1;
	if($rst_options['rst_zoom'])
	{
	$screenspacing=$rst_options['rst_zoom'];
	}
	
$seatsize=$wpdb->get_var("SELECT LENGTH( seatno ) AS fieldlength FROM rst_seats where show_id='".addslashes($showid['id'])."' ORDER BY fieldlength DESC LIMIT 1 ");
//print "<br>1-".$seatsize;
if($seatsize>2)
{
$seatsize=5*($seatsize-2);
}else
{
$seatsize=0;
}

	
	$seats = rst_seats_operations('list', '', $showid['id']);
	$divwidth = (($seats[0]['total_seats_per_row']) + 2) * (24+$seatsize);
//print $divwidth;
  
	$divwidth=$divwidth * $rst_options['rst_zoom'];
	

	
	$mindivwidth = 640;
	if ($divwidth < $mindivwidth) {
		$divwidth = $mindivwidth;
	}
	
	if($rst_options['rst_fixed_width'])
	{
	$divwidth =$rst_options['rst_fixed_width'];
	}   

	if ($rst_options['rst_alignment'] == 3) {
		$style = 'margin-left: auto;';
	}

	if ($rst_options['rst_alignment'] == 2) {
		$style = 'margin-right: auto;';
	}

	if ($rst_options['rst_alignment'] == 1) {
		$style = 'margin: auto;';
	}

	
	
	
	?>
<!--Row Seats v2.48 starts-->
   
	<div class="event_info_box" style="width: 100%; <?php echo $style; ?>">
<?php
apply_filters('rowseats-addtocalendar-js',$showdata);

?>  
	
	<script type="text/javascript">
		var RSTPLN_CKURL = '<?php echo RSTPLN_CKURL?>';
		var RSTAJAXURL = '<?php echo RSTPLN_URL?>ajax.php';
	</script>
	<script type='text/javascript' src='<?php echo RSTPLN_JALURL ?>jquery.alerts.js'></script>
	<script type='text/javascript' src='<?php echo RSTPLN_URL ?>js/jquery.blockUI.js'></script>
<script type='text/javascript' src='<?php echo RSTPLN_URL ?>js/row_seats.js'></script>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo RSTPLN_JALURL ?>jquery.alerts.css"/>
	<?php
   // if ($type == 'offline') {
	//    $stylecss = 'lite.css';

   // }
	?>
   
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo RSTPLN_CSSURL . $stylecss ?>"/>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo RSTPLN_CSSURL . 'common.css' ?>"/>
 

<?php
$seatsize=$wpdb->get_var("SELECT LENGTH( seatno ) AS fieldlength FROM rst_seats where show_id='".addslashes($showid['id'])."' ORDER BY fieldlength DESC LIMIT 1 ");
//print "<br>9-".$seatsize;
if($seatsize>2)
{
$seatsize=5*($seatsize-2);
}else
{
$seatsize=0;
}

?> 
	<style>

	
	
	

ul.r li {



	font-size: <?php echo (int)(10 * $rst_options['rst_zoom']);?>px !important;

	height: <?php echo (int)(24 * $rst_options['rst_zoom']);?>px !important;

	line-height: <?php echo (int)(24 * $rst_options['rst_zoom']);?>px !important;


	width: <?php echo (int)((21+$seatsize) * $rst_options['rst_zoom']);?>px !important;



  

}



</style> 

<?php
apply_filters('row_seats_color_selection_css',$showid['id']);
?>

	<script type='text/javascript' src='<?php echo RSTPLN_COKURL ?>jquery.cookie.js'></script>
   <!-- <script type="text/javascript" src="<?php echo RSTPLN_IDLKURL ?>jquery.countdown.js"></script>
	<script type="text/javascript" src="<?php echo RSTPLN_IDLKURL ?>idle-timer.js"></script>-->
 <?
wp_enqueue_script('jquery');
?> 
	<!--<link rel="stylesheet" type="text/css" media="all" href="<?php echo RSTPLN_IDLKURL ?>jquery.countdown.css"/>-->

	<input type="hidden" name="startedcheckout" id="startedcheckout" value=""/>
	<input type="hidden" name="numberoffreecoupons" id="numberoffreecoupons" value=""/>
	<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo $currenturl; ?>"/>

	<?php
	$showid = $showid['id'];
	$showdata['vmid'] = $showid;
	$showdata = rst_shows_operations('byid', $showdata, '');
	$closebooking = $rst_options['rst_close_bookings'];
	if ($closebooking == '') {
		$closebooking = 60;
	}
	$showdata = $showdata[0];
	$eventname = $showdata['show_name'];
	$_SESSION['views']=  $showdata['id'];
	$venue = $showdata['venue'];
	$eventdate = $showdata['show_start_time'];
	$eventdate = date('Y-m-d H:i:s', strtotime($showdata['show_start_time']));
	$eventdate1 = strtotime($eventdate);
	$currentdate = strtotime(current_time('mysql', 0));
	$eventdate1 = $eventdate1 - (60 * $closebooking);
	$stopsonlinebooking = $closebooking / 60;
	if ($closebooking < 60) {
		$prefixh = 'mins';
		$stopsonlinebooking = $closebooking;
	} else {
		$prefixh = 'hr';
	}
	//$checking_string="stopsonlinebooking =".$stopsonlinebooking." and type=".$type."<br><br>";
	if ($stopsonlinebooking == 0) {
		$stopsonlinebooking = '';
	} else {
		 $booking_warning=str_replace('{DURATION}',$stopsonlinebooking." ".$prefixh,$booking_warning);
		$stopsonlinebooking = " ($booking_warning)";
	}
	if ($type == 'offline') {
	  //  $stopsonlinebooking = '';
	}
	$currenttime = current_time('mysql', 0);

	$bookedseats = getbookedseatsbyshow($showid);
	$totalseats = gettotalseatsbyshow($showid);
 //$bookedseats=4;  $totalseats=5; 
	
$vairablename="row_seats_wpuser_access_".$showdata['id'];
$vairablenamevalue=$rst_options[$vairablename];
//if($vairablenamevalue=="on")
//{ 
	
	//if ($currentdate >= $eventdate1 && $type != 'offline') {
	if($_REQUEST['stoprefresh']=="yes")
	{
	
if($rst_options['rst_idle_message'])    
{
$rstidlemsg=$rst_options['rst_idle_message'];
}else{
$rstidlemsg='{showname} : Sorry this page is idle for long. To continue <a href="{returnurl}">click here</a>';
}
$tags = array('{showname}', '{showdate}', '{returnurl}');
$vals = array($eventname, $eventdate, $_REQUEST['returnurl']);
$rstidlemsg = str_replace($tags, $vals, $rstidlemsg);
$rstidlemsg = stripslashes($rstidlemsg);
echo '<div><br/><strong>'.$rstidlemsg.'</strong></div></div><br>';
	} elseif(!is_user_logged_in() && $vairablenamevalue=="on")
	{
	
	echo   '<div><br/><strong>'.$wpuser_onlyloggedin.'</strong></div></div>';
	
	
	}
	
	
	  elseif ($currentdate >= $eventdate1) {

		echo   '<div><br/><strong>'.$event_booking_closed.'</strong></div></div>';

	} elseif($bookedseats>=$totalseats)  {
	
	 echo   "<div id='eventdetails' >

		$event_name_title:$eventname <br/>

		$event_datetime: $eventdate  <br/>

		$event_venue:$venue<br/><div><br/><strong>online booking close, we appreciate your patronage..</strong></div></div>";
	
	} else {

		$html = '';

		$movie_date_time = explode(' ', $eventdate);
        if ( date('G:i',strtotime($movie_date_time[1])) == '0:00' ) {
            $time = __('All day', 'vh');
        } else {
            $time = date('G:i',strtotime($movie_date_time[1]));
        }

        $venu_div = '';

        if ( $venue != '' ) {
            $venu_div = "<div class='event_venue'>
                            $event_venue:$venue<br/>
                        </div>";
        }

		// showcart ----->
		$html .= "<a name='show_top'></a><div class='showchart'><div style='width:100%; margin: 0 auto;'><div class='showchart paymentsucess'>$paymentsuccess</div>

		<div class='vc_message_box vc_message_box-classic vc_message_box-rounded vc_color-alert-info'>
            <div class='vc_message_box-icon'></div>
            <p>$event_empty_warning &nbsp;&nbsp;</p>
            <div id='defaultCountdown' ></div>
            <div class='clearfix'></div>
        </div>      
		
        <div id='defaultCountdown' ></div>
        <div id='idleCountdown' style='display: none;'></div>
        </div><div id='eventdetails' >
        <div class='event_info'>
        <span>$event_name_title:</span> $eventname" . ", " . "<span>$event_date:</span> " . date('j.m.Y',strtotime($movie_date_time[0])) . ", <span>$event_time:</span> " . $time . "</div><div class='event_online_booking'>" . $stopsonlinebooking.".</div>

        $venu_div

        </div></div>";
		// <----- showcart
		$html .= apply_filters('row_seats_generel_admission_form','',$showid);
		$html .= apply_filters('rowseats-addtocalendar-showbutton','',$showdata); 
		$html .= "<div id='showprview' class='localcss' align='center' style='width:100%; margin-left: auto;margin-right: auto;' >";

		
	
		?>
		
		<script>
	
		var regtype = '<?php echo $type?>';
		var offlineAdmin = '<?php echo $offlineAdmin?>';
		var rstidlecounter = '<?php echo $rstidlecounter?>';

		///////////////////////// idle time code /////////////////
		
function addQueryParam( url, key, val ){
	var parts = url.match(/([^?#]+)(\?[^#]*)?(\#.*)?/);
	var url = parts[1];
	var qs = parts[2] || '';
	var hash = parts[3] || '';

	if ( !qs ) {
		return url + '?' + key + '=' + encodeURIComponent( val ) + hash;
	} else {
		var qs_parts = qs.substr(1).split("&");
		var i;
		for (i=0;i<qs_parts.length;i++) {
			var qs_pair = qs_parts[i].split("=");
			if ( qs_pair[0] == key ){
				qs_parts[ i ] = key + '=' + encodeURIComponent( val );
				break;
			}
		}
		if ( i == qs_parts.length ){
			qs_parts.push( key + '=' + encodeURIComponent( val ) );
		}
		return url + '?' + qs_parts.join('&') + hash;
	}
}

		
		function idleforlong() {
		var newurl=addQueryParam( window.location.href, 'stoprefresh', 'yes' );
		var newurl=addQueryParam( newurl, 'returnurl', window.location.href );
		window.location.href=newurl;
		//alert(newurl);
		}
		function liftOff() {

			jQuery.post("<?php echo RSTAJAXURL?>",
				{
					action: 'releasecurrentcart',
					details:<?php echo $showid?>,
					redirecturl: document.getElementById('redirecturl').value,
					cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
				},

				function (msg) {

					jQuery("#showprview").html((msg));
					document.getElementById('return').value = document.getElementById('redirecturl').value;
					jQuery(".seatplan .showseats").each(function (i) {

						if (jQuery(this).attr("rel") == "Y") {
							jQuery(this).click(function () {
								getupdatedshow(jQuery(this).attr("id"));
							});
						}

						if (jQuery(this).attr("rel") == "H") {

							jQuery(this).click(function () {

								id = jQuery(this).attr("id");

								jConfirm('<?php echo $rst_h_msg;?>', 'Wheelchair Access', function (r) {
									if (r == true) {
										getupdatedshow(id);
									}
									else {
									}
								});
							});
						}
					});
				});
		}

		
<?php
$rstidlecounter=$rstidlecounter*60;
$rst_idle_clear_cart=$rst_idle_clear_cart*60;

?>
var IDLE_TIMEOUT = <?php echo $rstidlecounter;?>; //seconds
var IDLE_TIMEOUT2 = <?php echo $rst_idle_clear_cart;?>; //seconds
var _idleSecondsCounter = 0;
var _idleSecondsCounter2 = 0;
document.onclick = function() {
	_idleSecondsCounter = 0;
	_idleSecondsCounter2 = 0;
};
document.onmousemove = function() {
	_idleSecondsCounter = 0;
	_idleSecondsCounter2 = 0;
};
document.onkeypress = function() {
	_idleSecondsCounter = 0;
	_idleSecondsCounter2 = 0;
};
window.setInterval(CheckIdleTime, 1000);

function CheckIdleTime() {
	_idleSecondsCounter++;
	 _idleSecondsCounter2++;
	 
	var austDay = new Date();
	jQuery.cookie("rst_cart_time_<?php echo $showid?>", austDay.getTime());

	var oPanel = document.getElementById("idleCountdown");
	var mytime=(IDLE_TIMEOUT - _idleSecondsCounter);
	var minutes = Math.floor(mytime / 60);
	var seconds = mytime - minutes * 60;    
	var minutes = ("0" + minutes).slice(-2);
	var seconds = ("0" + seconds).slice(-2);
	var oPanel2 = document.getElementById("defaultCountdown");
	var mytime2=(IDLE_TIMEOUT2 - _idleSecondsCounter2);
	var minutes2 = Math.floor(mytime2 / 60);
	var seconds2 = mytime2 - minutes2 * 60; 
	var minutes2 = ("0" + minutes2).slice(-2);
	var seconds2 = ("0" + seconds2).slice(-2);  

	if (_idleSecondsCounter2 == IDLE_TIMEOUT2) {
		_idleSecondsCounter2=0;
		//oPanel2.innerHTML = "00:00";
		oPanel2.innerHTML = "<blink><font color=red class=blink><b>Clearing cart....</b></font></blink>";
		liftOff();
		

	}
	else
	{
	
	if((IDLE_TIMEOUT2-_idleSecondsCounter2)<30)
	{
	oPanel2.innerHTML = "<blink><font color=red class=blink><b>"+minutes2 +":"+seconds2+"</b></font></blink>";
	}else { 
	oPanel2.innerHTML = minutes2 +":"+seconds2;
	}
	}       
	
	if (_idleSecondsCounter == IDLE_TIMEOUT) {
		//alert("Time expired!");
		oPanel.innerHTML = "00:00";
		clearInterval(CheckIdleTime);
		idleforlong();
		return false;
		//exit;
	}
	else
	{

	oPanel.innerHTML = minutes +":"+seconds;

	}
	

	
	
	
	
	
}

/*      
		
		
		IdleTimer.subscribe("idle", function () {
		
		  // alert('idle');

			var status = document.getElementById("status");

			jQuery('#defaultCountdown').countdown('destroy');

			var austDay = new Date();

			austDay.setMinutes(austDay.getMinutes() + 7);

			jQuery('#defaultCountdown').countdown({until: austDay, onExpiry: liftOff, format: 'MS', compact: true,

				description: ''});
				
			jQuery('#idleCountdown').countdown('destroy');

			var austDay1 = new Date();

			austDay1.setMinutes(austDay1.getMinutes() + <?php echo $rstidlecounter?>);

			jQuery('#idleCountdown').countdown({until: austDay1, onExpiry: idleforlong, format: 'MS', compact: true,

				description: ''});
				

		});


		IdleTimer.subscribe("active", function () {

			var status = document.getElementById("status");

			var austDay = new Date();

			jQuery.cookie("rst_cart_time_<?php echo $showid?>", austDay.getTime());

			jQuery('#defaultCountdown').countdown('destroy');

			austDay.setMinutes(austDay.getMinutes() + 7);

			jQuery('#defaultCountdown').countdown({until: austDay, onExpiry: liftOff, format: 'MS', compact: true,

				description: ''});

			jQuery('#defaultCountdown').countdown('pause');
			
			var austDay1 = new Date();
			
			jQuery('#idleCountdown').countdown('destroy');

			austDay1.setMinutes(austDay1.getMinutes() + <?php echo $rstidlecounter?>);

			jQuery('#idleCountdown').countdown({until: austDay1, onExpiry: idleforlong, format: 'MS', compact: true,

				description: ''});

			jQuery('#idleCountdown').countdown('pause');            

		});

		IdleTimer.start(1000);
		
*/      
		///////////////////////// idle time code ended /////////////////

		function getupdatedshow(id) {

			if (jQuery.cookie("rst_cart_time_<?php echo $showid?>") == null) {

				var dat = new Date();

				jQuery.cookie("rst_cart_time_<?php echo $showid?>", dat.getTime());

			} else {

				var dat = new Date();

				diff = dat.getTime() - jQuery.cookie("rst_cart_time_<?php echo $showid?>");

				if (diff > 600000) {
					jQuery.cookie("rst_cart_<?php echo $showid?>", null);
				}

			}

			jQuery('#showprview').block({

				message: '<?php echo $event_seat_processing;?>',
				css: { border: '3px solid #a00' }

			});

			jQuery.post("<?php echo RSTAJAXURL?>",
				{
					action: 'booking',
					details: id,
					redirecturl: document.getElementById('redirecturl').value,
					cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>"),
					offline: (regtype == 'offline') ? 'offline' : ''
				},

				function (msg) {

					jQuery("#showprview").html((msg));

					jQuery('#showprview').unblock();

					document.getElementById('return').value = document.getElementById('redirecturl').value;

					jQuery(".seatplan .showseats").each(function (i) {

						if (jQuery(this).attr("rel") == "Y") {

							// seat onclick ----->
							jQuery(this).click(function () {
								getupdatedshow(jQuery(this).attr("id"));
							});
							// <----- seat onclick
						}

						if (jQuery(this).attr("rel") == "H") {

							jQuery(this).click(function () {

								id = jQuery(this).attr("id");

								jConfirm('<?php echo $rst_h_msg;?>', 'Wheelchair Access', function (r) {

									if (r == true) {
										getupdatedshow(id);
									}
									else {
									}
								});
							});
						}
					});
				});
		}

		
		
		function getupdatedshow(id) {

			if (jQuery.cookie("rst_cart_time_<?php echo $showid?>") == null) {

				var dat = new Date();

				jQuery.cookie("rst_cart_time_<?php echo $showid?>", dat.getTime());

			} else {

				var dat = new Date();

				diff = dat.getTime() - jQuery.cookie("rst_cart_time_<?php echo $showid?>");

				if (diff > 600000) {
					jQuery.cookie("rst_cart_<?php echo $showid?>", null);
				}

			}

			jQuery('#showprview').block({

				message: '<?php echo $event_seat_processing;?>',
				css: { border: '3px solid #a00' }

			});

			jQuery.post("<?php echo RSTAJAXURL?>",
				{
					action: 'booking',
					details: id,
					redirecturl: document.getElementById('redirecturl').value,
					cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>"),
					offline: (regtype == 'offline') ? 'offline' : ''
				},

				function (msg) {

					jQuery("#showprview").html((msg));

					jQuery('#showprview').unblock();

					document.getElementById('return').value = document.getElementById('redirecturl').value;

					jQuery(".seatplan .showseats").each(function (i) {

						if (jQuery(this).attr("rel") == "Y") {

							// seat onclick ----->
							jQuery(this).click(function () {
								getupdatedshow(jQuery(this).attr("id"));
							});
							// <----- seat onclick
						}

						if (jQuery(this).attr("rel") == "H") {

							jQuery(this).click(function () {

								id = jQuery(this).attr("id");

								jConfirm('<?php echo $rst_h_msg;?>', 'Wheelchair Access', function (r) {

									if (r == true) {
										getupdatedshow(id);
									}
									else {
									}
								});
							});
						}
					});
				});
		}       
		function refreshshow(id) {

			jQuery.post('<?php echo RSTAJAXURL?>',
				{
					action: 'refresh',
					details: id,
					redirecturl: document.getElementById('redirecturl').value,
					cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
				},

				function (msg) {

					document.getElementById('return').value = document.getElementById('redirecturl').value;

					resp = jQuery(msg);

					chart = resp.filter('.seatplan');

					jQuery(".seatplan").html((chart));

					jQuery(".seatplan .showseats").each(function (i) {

						if (jQuery(this).attr("rel") == "Y") {

							// seat onclick ----->
							jQuery(this).click(function () {
								getupdatedshow(jQuery(this).attr("id"));
							});
							// <----- seat onclick
						}

						if (jQuery(this).attr("rel") == "H") {

							jQuery(this).click(function () {

								id = jQuery(this).attr("id");

								jConfirm('<?php echo $rst_h_msg;?>', 'Wheelchair Access', function (r) {

									if (r == true) {
										getupdatedshow(id);
									}
									else {
									}
								});
							});
						}
					});
				});
		}
<?php
if($rst_options['rst_refresh_time'])
{
$refresh_time=(int)$rst_options['rst_refresh_time']*1000;
if($refresh_time<=0)
{
$refresh_time=5000;
}
} else {
$refresh_time=5000;
}

?>
		jQuery(document).ready(function () {
			getupdatedshow("<?php echo $showid?>");
			var interval = setInterval(increment, <?php echo $refresh_time?>);
		});

		function releaseseats() {
			if (document.getElementById('startedcheckout').value == '') {
				releasenow("<?php echo $showid?>");
			}
		}

		releasenow("<?php echo $showid?>");

		function releasenow(id) {

			action = 'releasenow';

			jQuery.post('<?php echo RSTAJAXURL?>',
				{
					action: 'releasenow',
					details: id,
					redirecturl: document.getElementById('redirecturl').value,
					cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
				},

				function (msg) {
					if (msg == 'no') {
					} else {
						jQuery.cookie("rst_cart_<?php echo $showid?>", null);
						window.location.reload();
						//exit();
					}
				});

			var interval = setInterval(releaseseats, 300000);
		}

		function increment() {
			if (document.getElementById('startedcheckout').value == '') {
				refreshshow("<?php echo $showid?>");
			}
		}
//Javascript function to format currency - start

function formatCurrency(num) {
num = num.toString().replace(/\$|\,/g, '');
if (isNaN(num)) num = "0";
sign = (num == (num = Math.abs(num)));
num = Math.floor(num * 100 + 0.50000000001);
cents = num % 100;
num = Math.floor(num / 100).toString();
if (cents < 10) cents = "0" + cents;
for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
return (((sign) ? '' : '-') + '' + num + '.' + cents);
}
//Javascript function to format currency - end


function savebookingcustom()

{

<?php



	
if($rst_options['rst_enable_special_pricing']=="on" and row_seats_special_pricing_verification())
{

?>  
	//Sending special price to ajax call for saving.... 
	var totalitems=document.getElementById('totalrecords').value;
	var mycartproducts;
	for (var i=0; i<totalitems; i++)
	{
	var dropboxvalue=document.getElementById('special_pricing'+i).value;
	if(i==0)
	{
	mycartproducts=dropboxvalue;
	}else{
	mycartproducts=mycartproducts+"__"+dropboxvalue;
	}
	}

<?php }else{?>

var mycartproducts;

<?php } ?>

				document.getElementById('couponprogress').innerHTML = '<img src="<?php echo RSTPLN_URL;?>images/couponwait.gif" width="20" style="border:none !important;"/>';
				jQuery('.row_seats_loading').show();

				if (regtype == 'offline') {
					regstatus = 'offline_registration';
				} else if (regtype == 'zero') {
					regstatus = 'free_booking';
				}
				else {
					regstatus = 'pending_paypal';
				}



				jQuery.post('<?php echo RSTAJAXURL?>',
					{
						action: 'savebooking',
						name: document.getElementById('contact_name').value,
						email: document.getElementById('contact_email').value,
						phone: document.getElementById('contact_phone').value,
						bookingid: document.getElementById('bookingid').value,
						status: regstatus,
						myproducts: mycartproducts,
						redirecturl: document.getElementById('redirecturl').value,
						cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
					},

					function (rmsg) {
						var finalstring;
						
						var index = rmsg.indexOf("error");
						if (index != -1)
						{
						var pieces = rmsg.split(/[\s_]+/);
						var npieces = pieces[pieces.length-1];
						alert("<?php echo $event_double_booking;?> "+npieces);
						window.location.reload();
						return false;   
						
						}                       
						
						
						document.getElementById('x_invoice_num').value = rmsg;  
						document.getElementById('item_number').value = rmsg;    
						document.getElementById('bookingid').value = rmsg;
							if (document.getElementById('statusofcouponapply').value == 'success')
								finalstring = rmsg + '__' + document.getElementById('couponcode').value + '__' + document.getElementById('coupondiscount').value + '__' + document.getElementById('numberoffreecoupons').value + '__' + document.getElementById('rst_fees').value;
							else
								finalstring = rmsg + '__'+' '+'__0__0__' + document.getElementById('rst_fees').value;   
						   document.getElementById('x_custom').value = finalstring;
					  jQuery.cookie("rst_cart_<?php echo $showid?>", null);  
					  jQuery('#rsbuynow').click();                         
		  
		  return;
			
					});
			
			

}


	function savecheckoutdata(id) {
var mycartproducts; 
<?php
	
if($rst_options['rst_enable_special_pricing']=="on" and row_seats_special_pricing_verification())
{

?>  
	//Sending special price to ajax call for saving.... 
	var totalitems=document.getElementById('totalrecords').value;
	
	for (var i=0; i<totalitems; i++)
	{
	var dropboxvalue=document.getElementById('special_pricing'+i).value;
	if(i==0)
	{
	mycartproducts=dropboxvalue;
	}else{
	mycartproducts=mycartproducts+"__"+dropboxvalue;
	}
	}

<?php }else{?>

var mycartproducts;

<?php } ?>

	

			if (document.getElementById('contact_name').value == "") {

				alert('please enter your name');

				return false;

			}

			if ((document.getElementById('contact_name').value).length < 4) {

				alert('Name should have minimum 4 characters..');

				return false;

			}


			filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if (filter.test(document.getElementById('contact_email').value)) {

			}
			else {
				alert('please enter proper email address');
				return false;
			}

			if ((document.getElementById('contact_phone').value) == "") {

				alert('Please enter your contact phone number');

				return false;

			}

			if ((document.getElementById('contact_phone').value).length < 7) {

				alert('Phone number should have minimum 7 characters..');

				return false;
			}

			if ((document.getElementById('rstterms').checked) == false) {

				alert('please agree the terms and conditions');

				return false;
			}
			
	

			if (id == 'placeordernew') {

				document.getElementById('couponprogress').innerHTML = '<img src="<?php echo RSTPLN_URL;?>images/couponwait.gif" width="20" style="border:none !important;"/>';

			   
		   //jQuery(".QTPopup").css('display', 'none');

				jQuery('#showprview').block({

					message: '<?php echo $event_seat_processing;?>',
					css: { border: '3px solid #a00' }

				});
				if (regtype == 'offline') {
					regstatus = 'offline_registration';
				} else if (regtype == 'zero') {
					regstatus = 'free_booking';
				}
				else {
					regstatus = 'pending_paypal';
				}



				jQuery.post('<?php echo RSTAJAXURL?>',
					{
						action: 'savebooking',
						name: document.getElementById('contact_name').value,
						email: document.getElementById('contact_email').value,
						phone: document.getElementById('contact_phone').value,
						status: regstatus,
						myproducts: mycartproducts,
						redirecturl: document.getElementById('redirecturl').value,
						cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
					},

					function (msg) {
			
			//document.getElementById('stripe_code').value =msg;
			alert('Successfully Booked! eTicket Sent To Your Email.');
			return;
					});
return;     
}           

			if (id == 'placeorder') {

				document.getElementById('couponprogress').innerHTML = '<img src="<?php echo RSTPLN_URL;?>images/couponwait.gif" width="20" style="border:none !important;"/>';

				jQuery(".QTPopup").css('display', 'none');

				jQuery('#showprview').block({

					message: '<?php echo $event_seat_processing;?>',
					css: { border: '3px solid #a00' }

				});
				if (regtype == 'offline') {
					regstatus = 'offline_registration';
				} else if (regtype == 'zero') {
					regstatus = 'free_booking';
				}
				else {
					regstatus = 'pending_paypal';
				}



				jQuery.post('<?php echo RSTAJAXURL?>',
					{
						action: 'savebooking',
						name: document.getElementById('contact_name').value,
						email: document.getElementById('contact_email').value,
						phone: document.getElementById('contact_phone').value,
						status: regstatus,
						myproducts: mycartproducts,
						redirecturl: document.getElementById('redirecturl').value,
						cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
					},

					function (msg) {

						document.getElementById('return').value = document.getElementById('redirecturl').value;

						if (msg != '' && msg != 0) {

							if (document.getElementById('statusofcouponapply').value == 'success')
								document.getElementById('custom').value = msg + '__' + document.getElementById('couponcode').value + '__' + document.getElementById('coupondiscount').value + '__' + document.getElementById('numberoffreecoupons').value + '__' + document.getElementById('rst_fees').value;
							else
								document.getElementById('custom').value = msg;


							if (regtype != 'offline' && regtype != 'zero') {
								jQuery.cookie("rst_cart_<?php echo $showid?>", null);
								document.checkoutform.submit();
							}
							else if (regtype == 'zero') {
								jQuery.post('<?php echo RSTAJAXURL?>',
									{
										action: 'zerobooking',
										bookingid: document.getElementById('custom').value,
										name: document.getElementById('contact_name').value,
										email: document.getElementById('contact_email').value,
										phone: document.getElementById('contact_phone').value,
										cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
									},

									function (msg) {
										jQuery.cookie("rst_cart_<?php echo $showid?>", null);
										alert('Successfully Booked! eTicket Sent To Your Email.');
										window.location.reload();
									});
							}
							else if (regtype == 'offline') {
								jQuery.post('<?php echo RSTAJAXURL?>',
									{
										action: 'offlinereg',
										bookingid: document.getElementById('custom').value,
										name: document.getElementById('contact_name').value,
										email: document.getElementById('contact_email').value,
										phone: document.getElementById('contact_phone').value,
										freeseats: document.getElementById('numberoffreecoupons').value,
										cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
									},

									function (msg) {
										jQuery.cookie("rst_cart_<?php echo $showid?>", null);

										alert('Successfully Booked! eTicket Sent To Your Email.');
										if (offlineAdmin === 'admin') {
											window.location = '<?php echo get_option('siteurl')?>/wp-admin/admin.php?page=rst-off-reg';
										} else {
											window.location.reload()/* = '<?php //echo get_option('siteurl')?>/wp-admin/admin.php?page=rst-off-reg'*/;
										}
									});
							}
						} else {
							alert("Something Went wrong errorcode:".msg);
						}
					});
			} else {
				document.getElementById('numberoffreecoupons').value = '';
				var isChecked = jQuery('#rstmem').attr('checked') ? true : false;
				if (( document.getElementById('couponcode').value) == "" && !isChecked) {

					alert('please enter couponcode');
					return false;

				}
				if (( document.getElementById('couponcode').value) == "Enter Member ID" || (( document.getElementById('couponcode').value) == '' && isChecked )) {

					alert('please enter member id');
					return false;

				}

				if (( document.getElementById('couponcode').value) == document.getElementById('appliedcoupon').value && document.getElementById('statusofcouponapply').value == 'success') {

					document.getElementById('coupondiscount').value = '';
					return false;

				}

				document.getElementById('couponprogress').innerHTML = '<img src="<?php echo RSTPLN_URL;?>images/couponwait.gif" width="20" style="border:none !important;"/>';
				if (isChecked) {
					jQuery.post('<?php echo RSTAJAXURL?>',
						{
							action: 'applymember',
							memberid: document.getElementById('couponcode').value,
							showid:<?php echo $showid?>,
							cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
						}, function (msg) {
							document.getElementById('couponprogress').innerHTML = '';

							var couponresult = msg.split('_');

							if (couponresult[0] == 'error') {

								document.getElementById('amount').value = document.getElementById('totalbackup').value;

								jQuery('#aftercoupongrand').hide();

								jQuery('#aftercoupondis').hide();

								document.getElementById('couponmsg').innerHTML = couponresult[1];

								document.getElementById('appliedcoupon').value = document.getElementById('couponcode').value;

								document.getElementById('coupondiscount').value = '';

								document.getElementById('statusofcouponapply').value = 'fail';

							} else {
								if (couponresult[1] == '0.00') {
									regtype = 'zero';
									document.getElementById('numberoffreecoupons').value = couponresult[3];
								} else if (regtype != 'offline') {
									regtype = 'applyedfreecoupons';
									document.getElementById('numberoffreecoupons').value = couponresult[3];

								} else if (regtype == 'offline') {
									document.getElementById('numberoffreecoupons').value = couponresult[3];
								}

								document.getElementById('couponmsg').innerHTML = '';

								document.getElementById('couponprogress').innerHTML = '';

								document.getElementById('appliedcoupon').value = document.getElementById('couponcode').value;

								document.getElementById('statusofcouponapply').value = 'success';

								document.getElementById('coupondiscount').value = couponresult[2];

								document.getElementById('discountamount').innerHTML = couponresult[2];

								document.getElementById('Grandtotal').innerHTML = '<strong>' + couponresult[1] + '</strong>';

								jQuery('#aftercoupongrand').show();

								jQuery('#aftercoupondis').show();

								document.getElementById('amount').value = couponresult[1];

							}
						});
				} else {
					jQuery.post('<?php echo RSTAJAXURL?>',
						{
							action: 'applycoupon',
							email: document.getElementById('contact_email').value,
							couponcode: document.getElementById('couponcode').value,
							showid:<?php echo $showid?>,
							total: document.getElementById('amount').value
						},

						function (msg) {

							document.getElementById('couponprogress').innerHTML = '';

							var couponresult = msg.split('_');

							if (couponresult[0] == 'error') {

								document.getElementById('amount').value = document.getElementById('totalbackup').value;

							   // jQuery('#aftercoupongrand').hide();

								jQuery('#aftercoupondis').hide();

								document.getElementById('couponmsg').innerHTML = couponresult[1];

								document.getElementById('appliedcoupon').value = document.getElementById('couponcode').value;

								document.getElementById('coupondiscount').value = '';

								document.getElementById('statusofcouponapply').value = 'fail';

							} else {

								document.getElementById('couponmsg').innerHTML = '';

								document.getElementById('couponprogress').innerHTML = '';

								document.getElementById('appliedcoupon').value = document.getElementById('couponcode').value;

								document.getElementById('statusofcouponapply').value = 'success';

								document.getElementById('coupondiscount').value = couponresult[2];

								document.getElementById('discountamount').innerHTML = couponresult[2];

								document.getElementById('Grandtotal').innerHTML = '<strong>' + couponresult[1] + '</strong>';

								jQuery('#aftercoupongrand').show();

								jQuery('#aftercoupondis').show();

								document.getElementById('amount').value = couponresult[1];
							}
						});
				}
			}
		}

		function deleteitem(obj) {

			action = 'deletebooking';

			if (obj.id == 'deleteall') {
				action :'deleteall';
			}

			jQuery.post('<?php echo RSTAJAXURL?>',
				{
					action: action,
					details: obj.id,
					redirecturl: document.getElementById('redirecturl').value,
					cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
				},

				function (msg) {

					jQuery("#showprview").html((msg));

					document.getElementById('return').value = document.getElementById('redirecturl').value;

					jQuery(".seatplan .showseats").each(function (i) {

						if (jQuery(this).attr("rel") == "Y") {

							jQuery(this).click(function () {
								getupdatedshow(jQuery(this).attr("id"));
							});

						}

						if (jQuery(this).attr("rel") == "H") {

							jQuery(this).click(function () {

								id = jQuery(this).attr("id");

								jConfirm('<?php echo $rst_h_msg;?>', 'Wheelchair Access', function (r) {

									if (r == true) {
										getupdatedshow(id);
									}
									else {
									}
								});
							});
						}
					});
				});
		}

		function deleteitemall(obj) {

			jQuery.post('<?php echo RSTAJAXURL?>',
				{
					action: 'deleteall',
					details: obj.id,
					redirecturl: document.getElementById('redirecturl').value,
					cartiterms: jQuery.cookie("rst_cart_<?php echo $showid?>")
				},

				function (msg) {

					jQuery.cookie("rst_cart_<?php echo $showid?>", null);

					jQuery("#showprview").html((msg));

					document.getElementById('return').value = document.getElementById('redirecturl').value;

					jQuery(".seatplan .showseats").each(function (i) {

						if (jQuery(this).attr("rel") == "Y") {

							jQuery(this).click(function () {
								getupdatedshow(jQuery(this).attr("id"));
							});
						}

						if (jQuery(this).attr("rel") == "H") {

							jQuery(this).click(function () {

								id = jQuery(this).attr("id");

								jConfirm('<?php echo $rst_h_msg;?>', 'Wheelchair Access', function (r) {

									if (r == true) {
										getupdatedshow(id);
									}
									else {
									}
								});
							});
						}
					});
				});
		}

		function checkformember(obj) {
			var isChecked = jQuery('#rstmem').attr('checked') ? true : false;
			if (isChecked) {
				jQuery('#couponapplybtn').html('<?php echo $coupon_apply_memberid;?>');
				jQuery('#couponcode').val('<?php echo $coupon_enter_memberid;?>');
			} else {
				jQuery('#couponapplybtn').html('<?php echo $coupon_apply_coupon;?>');
				jQuery('#couponcode').val('');
			}
		}
		</script>

		<?php

		$html .= '</div></div>'; //asd

		return $html;

	}

}

/*
 * Creates handlers for AJAX requests
 */
function vh_rst_ajax_callback() {
	global $wpdb; // this is how you get access to the database

	if (isset($_POST['action'])) {
		switch ($_POST['action']) {
			case 'applycoupon':
				$couponcode = $_POST['couponcode'];
				$email = $_POST['email'];
				$total = $_POST['total'];
				$showid = $_POST['showid'];
				$data1 = validatecoupon($couponcode, $email, $total, $showid);

				$return = '';
				if ($data1['error'] != '') {
					$return .= 'error_' . $data1['error'];
				} else {
					$return .= 'success_' . $data1['total'] . '_' . $data1['discount'];
				}

				echo  $return;
				break;

			case 'applymember':
				$memberid = $_POST['memberid'];
				$cartitems = $_POST['cartiterms'];
				$showid = $_POST['showid'];
				$data1 = validatemember($memberid, $cartitems);

				$return = '';
				if ($data1['error'] != '') {
					$return .= 'error_' . $data1['error'];
				} else {
					$return .= 'success_' . $data1['total'] . '_' . $data1['discount'] . '_' . $data1['freeseats'];
				}

				echo  $return;
				break;

			case 'savebooking': // {
				$details = base64_decode($_POST['cartiterms']);
				$bookingid = rst_shows_operations('savebooking', $_POST, $details);
				echo $bookingid;

				break;

			case 'deleteall': // {
				$details = $_POST['cartiterms'];
				$details = base64_decode($_POST['cartiterms']);
				$currentcart = unserialize($details);
				$showid = rst_shows_operations('deleteall', $currentcart, '');

				$data['id'] = $showid;

				echo vh_gettheseatchartAjax($data, $_POST['redirecturl'], array());
				exit();
				break;

			case 'releasenow': // {
				$showid = $_POST['details'];
				$currentcart = $_POST['cartiterms'];
				$currentcart = base64_decode($currentcart);
				$currentcart = unserialize($currentcart);
				$currentcart = rst_shows_operations('releaseall', $showid, $currentcart);
				$data['id'] = $showid;
				if ($currentcart['released'] == 'true') {
					echo vh_gettheseatchartAjax($data, $_POST['redirecturl'], $currentcart['cartitems']);
					exit();
				}
				echo 'no';


				break;

			case 'releasecurrentcart':
				$showid = $_POST['details'];
				$currentcart = $_POST['cartiterms'];
				$currentcart = base64_decode($currentcart);
				$currentcart = unserialize($currentcart);
				$currentcart = rst_shows_operations('releasecurrentcart', $showid, $currentcart);
				$data['id'] = $showid;
				echo vh_gettheseatchartAjax($data, $_POST['redirecturl'], $currentcart);

				exit();
				break;

			case 'deletebooking': // {

				$details = $_POST['details'];

				$data1 = explode('_', $details);
				if (count($data1) == 1 && $_POST['cartiterms'] == null) {
					echo vh_gettheseatchartAjax($data1[0]);

					exit();
				} else if ($_POST['cartiterms'] != '' && count($data1) == 1) {
					$currentcart = $_POST['cartiterms'];
					$currentcart = base64_decode($currentcart);
					$currentcart = unserialize($currentcart);
					$showid['id'] = $_POST['details'];

					echo vh_gettheseatchartAjax($showid, $_POST['redirecturl'], $currentcart);
					exit();
				}
				$currentcart = $_POST['cartiterms'];

				$bookingtodelete = rst_shows_operations('deletebooking', $_POST, $currentcart);
				$cartplusbooking = rst_shows_set_session($bookingtodelete, 'delete', $currentcart);
				$showid['id'] = $data1[1];
				echo vh_gettheseatchartAjax($showid, $_POST['redirecturl'], $cartplusbooking);
				exit();
				break;

			case 'refresh': // {

				if ($_POST['cartiterms'] != null) {
					$currentcart = $_POST['cartiterms'];
					$currentcart = base64_decode($currentcart);

				} else {
					$currentcart = array();
				}
				$details = $_POST['details'];
				$data1 = explode('_', $details);
				echo vh_gettheseatchartAutoRefresh($data1[0], $_POST['redirecturl'], $currentcart);
				exit();
				break;

			case 'booking': // {
				$details = $_POST['details'];

				$data1 = explode('_', $details);
				if (count($data1) == 1 && $_POST['cartiterms'] == null) {
					$showid['id'] = $data1[0];
					echo vh_gettheseatchartAjax($showid, '', array(), $_POST['offline']);
					exit();

				} else if ($_POST['cartiterms'] != '' && count($data1) == 1) {
					
					$currentcart = $_POST['cartiterms'];
					$currentcart = base64_decode($currentcart);
					$currentcart = unserialize($currentcart);

					$showid['id'] = $_POST['details'];

					echo vh_gettheseatchartAjax($showid, $_POST['redirecturl'], $currentcart, $_POST['offline']);
					exit();
				}

				$currentcart = $_POST['cartiterms'];
				

				$bookings = rst_shows_operations('booking', $_POST, $currentcart);
				$cartplusbooking = rst_shows_set_session($bookings, 'add', $currentcart);

				$showid['id'] = $data1[1];
				echo vh_gettheseatchartAjax($showid, $_POST['redirecturl'], $cartplusbooking, $_POST['offline']);
				exit();
				break;

			case 'save': // {
				echo rst_shows_operations('insert', $_POST, '');
				
				exit();

				break;

			case 'update': // {
				return rst_shows_operations('update', $_POST, '');

				break;

			case 'delete': // {
				return rst_shows_operations('delete', $_POST);

				break;

			case 'get_events_back':

				$arr = array();
				$data = rst_shows_operations('list', '', '');
				for ($i = 0; $i < count($data); $i++) {
					$arr[] = array(
						'id' => $data[$i]['id'],
						'title' => $data[$i]['show_name'],
						'start' => date('Y-m-d H:i:s', strtotime($data[$i]['show_start_time'])),
						'end' => date('Y-m-d H:i:s', strtotime($data[$i]['show_end_time'])),
						'allday' => false,
						'orient' => $data[$i]['orient'],
						'body' => $data[$i]['venue']
					);
				}
				echo json_encode($arr);
				exit;
				break;
				
			case 'get_events':              
				$arr = array();

				
				$data = rst_shows_operations('list', '', '');
				for ($i = 0; $i < count($data); $i++) { 

				if($data[$i]['allday']==1)
				{
				$allday1=true;
				}else{
				$allday1=false;             
				}       
				$arr[]=array('id'=>$data[$i]['id'],'title'=>addslashes($data[$i]['show_name']),'start'=>date('Y-m-d H:i:s', strtotime($data[$i]['show_start_time'])),'end'=>date('Y-m-d H:i:s', strtotime($data[$i]['show_end_time'])),'allDay'=>$allday1,'orient'=>$data[$i]['orient'],'body'=>addslashes($data[$i]['venue']));
				}
				echo json_encode($arr);
				exit;
				break;
				

			default:
				break;
		}
	}

	die();
}

/*
 * Generates seat chart html-content that is used to auto refresh chart via Ajax request
 */
function vh_gettheseatchartAutoRefresh($showid, $data, $currentcart) {

global $screenspacing,$wpdb;
	$rst_paypal_options = get_option(RSTPLN_PPOPTIONS);
	$rst_options = get_option(RSTPLN_OPTIONS);

	


	$wplanguagesoptions = get_option(RSTLANGUAGES_OPTIONS);
	$event_seat=__("Seat", "vh");
	$event_price=__("Price-", "vh");
	$event_seat_available=__("Available", "vh");
	$event_seat_booked=__("Booked", "vh");
	$event_seat_handicap=__("Wheelchair Access", "vh");
	$event_stall=__("STALL", "vh");
	$event_balcony=__("BALCONY", "vh");
	$event_circle=__("CIRCLE", "vh");
	$event_seat_blocked=__("Blocked", "vh");
	
	if($wplanguagesoptions['rst_enable_languages']=="on")
	{
		if($wplanguagesoptions['languages_event_seat'])
		{
			$event_seat=$wplanguagesoptions['languages_event_seat'];
		}
		if($wplanguagesoptions['languages_event_price'])
		{
			$event_price=$wplanguagesoptions['languages_event_price'];
		}   
		if($wplanguagesoptions['languages_event_seat_available'])
		{
			$event_seat_available=$wplanguagesoptions['languages_event_seat_available'];
		}
		if($wplanguagesoptions['languages_event_seat_blocked'])
		{
			$event_seat_blocked=$wplanguagesoptions['languages_event_seat_blocked'];
		}       
		if($wplanguagesoptions['languages_event_seat_booked'])
		{
			$event_seat_booked=$wplanguagesoptions['languages_event_seat_booked'];
		}   
		if($wplanguagesoptions['languages_event_seat_handicap'])
		{
			$event_seat_handicap=$wplanguagesoptions['languages_event_seat_handicap'];
		}   
		if($wplanguagesoptions['languages_event_stall'])
		{
			$event_stall=$wplanguagesoptions['languages_event_stall'];
		}           
		if($wplanguagesoptions['languages_event_balcony'])
		{
			$event_balcony=$wplanguagesoptions['languages_event_balcony'];
		}
		if($wplanguagesoptions['languages_event_circle'])
		{
			$event_circle=$wplanguagesoptions['languages_event_circle'];
		}       
	}


	
	

	$symbol = $rst_paypal_options['currencysymbol'];
	
$symbol = get_option('rst_currencysymbol');
	$symbols = array(
		"0" => "$",
		"1" => "&pound;",
		"2" => "&euro;",
		"3" => "&#3647;",
		"4" => "&#8362;",
		"5" => "&yen;",
		"6" => "&#8377;",
		"7" => "R$",
		"8" => "kr",
		"9" => "zł",
		"10" => "Ft",
		"11" => "Kč",
		"12" => "&#1088;&#1091&#1073;",
		"13" => "&#164;",
		"14" => "&#x20B1;",
		"15" => "Fr",
		"16" => "RM");

	$symbol = $symbols[$symbol];

	//$showid = $showid['id'];

	$data = getshowbyid($showid);
	$showorder = $data[0]['orient'];

	if ($showorder == 0 || $showorder == '') {
		$seats = rst_seats_operations('list', '', $showid);
	} else {
		$seats = rst_seats_operations('reverse', '', $showid);
	}
$seatsize=$wpdb->get_var("SELECT LENGTH( seatno ) AS fieldlength FROM rst_seats where show_id='".addslashes($showid)."' ORDER BY fieldlength DESC LIMIT 1 ");
//print "<br>9-".$seatsize;
if($seatsize>2)
{
$seatsize=5*($seatsize-2);
}else
{
$seatsize=0;
}
	$divwidth = (($seats[0]['total_seats_per_row']) + 2) * (24+$seatsize);
	 $divwidth=$divwidth * $rst_options['rst_zoom'];

	$mindivwidth = 640;
	if ($divwidth < $mindivwidth) {
		$divwidth = $mindivwidth;
	}    
	if($rst_options['rst_fixed_width'])
	{
	$divwidth =$rst_options['rst_fixed_width'];
	}    
	$showname = addslashes($data[0]['show_name']);

	$rst_bookings = $currentcart;

	$sessiondata = $rst_bookings;

	$sessiondata = base64_encode($sessiondata);

	$rst_bookings = unserialize($rst_bookings);

	$html = '<div class="seatplan" id="showid_' . $showid . '" style="width:' . $divwidth . 'px;">';

	$nextrow = '';

	$dicount = 0;

	for ($i = 0; $i < count($seats); $i++) {

		$data = $seats[$i];
		$nofsets = $data['total_seats_per_row'];
		$nofsets = floor($nofsets / 2);
		
//print "----------------------".strlen($event_stall);
//$event_stall=strrev($event_stall);
for ($z=0;$z<strlen($event_stall);$z++) {
$stall[$nofsets+$z]=$event_stall[$z];
}
		
		//$stall[$nofsets] = 'S';
		//$stall[$nofsets + 1] = 'T';
		//$stall[$nofsets + 2] = 'A';
	   // $stall[$nofsets + 3] = 'L';
	   // $stall[$nofsets + 4] = 'L';
		///

		if ($showorder != 0) {
$event_stall=strrev($event_stall);
for ($z=0;$z<strlen($event_stall);$z++) {
$stall[$nofsets+$z]=$event_stall[$z];
}       
		
			//$stall[$nofsets] = 'L';
			//$stall[$nofsets + 1] = 'L';
			//$stall[$nofsets + 2] = 'A';
			//$stall[$nofsets + 3] = 'T';
			//$stall[$nofsets + 4] = 'S';
		}
//$event_stall=strrev($event_stall);
for ($z=0;$z<strlen($event_balcony);$z++) {
$balcony[$nofsets+$z]=$event_balcony[$z];
}   
		
		//$balcony[$nofsets] = 'B';
	   // $balcony[$nofsets + 1] = 'A';
		//$balcony[$nofsets + 2] = 'L';
		//$balcony[$nofsets + 3] = 'C';
	   // $balcony[$nofsets + 4] = 'O';
	   // $balcony[$nofsets + 5] = 'N';
	   // $balcony[$nofsets + 6] = 'Y';
		if ($showorder != 0) {
		
$event_balcony=strrev($event_balcony);
for ($z=0;$z<strlen($event_balcony);$z++) {
$balcony[$nofsets+$z]=$event_balcony[$z];
}           
		   // $balcony[$nofsets] = 'Y';
			//$balcony[$nofsets + 1] = 'N';
			//$balcony[$nofsets + 2] = 'O';
			//$balcony[$nofsets + 3] = 'C';
			//$balcony[$nofsets + 4] = 'L';
			//$balcony[$nofsets + 5] = 'A';
			//$balcony[$nofsets + 6] = 'B';
		}
		//
//$event_balcony=strrev($event_balcony);
for ($z=0;$z<strlen($event_circle);$z++) {
$circle[$nofsets+$z]=$event_circle[$z];
}           
		//$circle[$nofsets] = 'C';
	   // $circle[$nofsets + 1] = 'I';
	   // $circle[$nofsets + 2] = 'R';
	   // $circle[$nofsets + 3] = 'C';
	   // $circle[$nofsets + 4] = 'L';
	   // $circle[$nofsets + 5] = 'E';
		if ($showorder != 0) {
$event_circle=strrev($event_circle);
for ($z=0;$z<strlen($event_circle);$z++) {
$circle[$nofsets+$z]=$event_circle[$z];
}       
			//$circle[$nofsets] = 'E';
			//$circle[$nofsets + 1] = 'L';
		   // $circle[$nofsets + 2] = 'C';
			//$circle[$nofsets + 3] = 'R';
		   // $circle[$nofsets + 4] = 'I';
		   // $circle[$nofsets + 5] = 'C';
		}

		$rowname = $data['row_name'];

		$seatno = $data['seatno'];

		$seatcost = $data['seat_price'];

		$seatdiscost = $data['discount_price'];

		if ($i == 0) {

			if ($rowname == '') {
				$html .= '<div style="float:left;"><ul class="r"><li class="stall showseats">' . $rowname . '</li>';
			} else {
				$html .= '<div style="float:left;"><ul class="r"><li class="ltr">' . $rowname . '</li>';
			}
		}
		if ($nextrow != $rowname && $i != 0) {
			if ($rowname == '') {
				$html .= '<li class="ltr">' . $nextrow . '</li></ul></div><div style="float:left;"><ul class="r"><li class="stall showseats">' . $rowname . '</li>';
			} else {
				if ($nextrow == '') {
					$html .= '<li class="stall showseats">' . $nextrow . '</li></ul></div><div style="float:left;"><ul class="r"><li class="ltr">' . $rowname . '</li>';
				} else {
					$html .= '<li class="ltr">' . $nextrow . '</li></ul></div><div style="float:left;"><ul class="r"><li class="ltr">' . $rowname . '</li>';
				}

			}

		}
		$rst_options = get_option(RSTPLN_OPTIONS);

		$dicount = $rst_options['rst_h_disc'];

		if ($dicount != '') {

			$dicount = $seatcost - ($seatcost * ($dicount / 100));

			$dicount = round($dicount, 2);

		} else {

			$dicount = $seatcost;

		}

		$seats_avail_per_row = unserialize($data['seats_avail_per_row']);

		$otherscart = false;


		$cssclassname="notbooked";
		$cssclassname=apply_filters('row_seats_color_selection_css_name',$cssclassname,$data['seatcolor']);
		
		
		if ($data['seattype'] == 'N') {

			$html .= '<li class="un showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="'.$event_seat.' ' . $rowname . ($seatno) . ' Unavailable" rel="' . $data['seattype'] . '"></li>';

		} else if ($data['seattype'] == 'Y') {

			$html .= '<li class="'.$cssclassname.' showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="'.$event_seat.' ' . $rowname . ($seatno) . ' '.$event_price.' ' . $symbol . $seatcost . ' '.$event_seat_available.'" rel="' . $data['seattype'] . '">' . ($seatno) . '<span></span></li>';

		} else if ($data['seattype'] == 'H') {

			$html .= '<li class="handy showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="'.$event_seat.' ' . $rowname . ($seatno) . ' '.$event_seat_handicap.' ' . $symbol . $dicount . ' " rel="' . $data['seattype'] . '">' . $seatno . '<span></span></li>';

		} else if ($data['seattype'] == 'B') {

			$html .= '<li class="booked showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="'.$event_seat.' ' . $rowname . ($seatno) . ' '.$event_seat_booked.'" rel="' . $data['seattype'] . '">' . $seatno . '</li>';

		} else if ($data['seattype'] == 'T') {

			for ($o = 0; $o < count($rst_bookings); $o++) {

				if ($rst_bookings[$o]['row_name'] == $rowname && $rst_bookings[$o]['seatno'] == $seatno) {

					$otherscart = true;

				}

			}

			if ($otherscart) {

				$html .= '<li class="blocked showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="'.$event_seat.' ' . $rowname . ($seatno) . '" rel="' . $data['seattype'] . '">' . $seatno . '</li>';

			} else {

				$html .= '<li class="b showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="'.$event_seat.' ' . $rowname . ($seatno) . '  '.$event_seat_blocked.'" rel="' . $data['seattype'] . '">' . $seatno . '</li>';

			}

		} else if ($data['seattype'] == 'S')

			$html .= '<li class="s showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '" title="" rel="">' . $stall[$seatno] . '</li>';

		else if ($data['seattype'] == 'L')

			$html .= '<li class="l showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '" title="" rel="">' . $balcony[$seatno] . '</li>';

		else if ($data['seattype'] == 'C')

			$html .= '<li class="c showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '" title="" rel="">' . $circle[$seatno] . '</li>';

		else {

			$html .= '<li class="un showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '_' . $seatno . '" title="" rel=""></li>';

		}

		$nextrow = $rowname;

	}

	$html .= '<li class="ltr">' . $nextrow . '</li></ul></div>';
$html = apply_filters('row_seats_generel_admission_block_seatchart', $html);
	return $html;

}

/*
 * Generates seat chart html-content. This function is called via Ajax request.
 */
function vh_gettheseatchartAjax($showid, $currenturl, $bookings, $offline = '') {

global $screenspacing,$wpdb;

			if ( is_user_logged_in() ) {
				global $current_user;
				get_currentuserinfo();
				$user_name=$current_user->user_firstname.' '.$current_user->user_lastname;  
				$user_email=$current_user->user_email;  
				$user_phone=$current_user->phone;                   
			
			} else {            
				$user_name='';  
				$user_email=''; 
				$user_phone='';             
			}     


	  
	$wplanguagesoptions = get_option(RSTLANGUAGES_OPTIONS);

	$event_seat_available=__("Available seats", "vh");
	$event_seat_inyourcart=__("Your reserved seats", "vh");
	$event_seat_inotherscart=__("Other&#39;s reserved seats", "vh");
	$event_seat_booked=__("Booked seats", "vh");
	$event_seat_handicap=__("Handicap Accomodation", "vh");
	$event_itemsincart=__("Items in cart", "vh");
	$event_item_cost=__("Cost", "vh");
	$event_item_total=__("Total", "vh");
	$event_item_grand=__("Total amount", "vh");
	$event_item_checkout=__("Checkout", "vh");
	$event_item_clearcart=__("Remove all", "vh");
	$event_bookingdetails=__("Booking details ", "vh");
	$event_customer_name=__("Name", "vh");
	$event_customer_email=__("Email", "vh");
	$event_customer_phone=__("Phone", "vh");
	$event_terms=__("I agree to terms & conditions", "vh");
	$cart_is_empty=__("Cart is empty", "vh");
	$event_seat=__("Seat", "vh");
	$event_seat_row=__("Row", "vh");
	$event_item_cost=__("Cost", "vh");
	$button_continue=__("Place order", "vh");
	$languages_added=__("Added", "vh");
	$event_stall=__("STALL", "vh");
	$event_balcony=__("BALCONY", "vh");
	$event_circle=__("CIRCLE", "vh"); 
	$event_seat_stage=__("Screen", "vh");  
	$coupon_vip_member=__("I am a VIP Member", "vh");

	
	if($wplanguagesoptions['rst_enable_languages']=="on")
	{
		if($wplanguagesoptions['languages_event_seat_row'])
		{
			$event_seat_row=$wplanguagesoptions['languages_event_seat_row'];
		}
		
		if($wplanguagesoptions['languages_event_seat_available'])
		{
			$event_seat_available=$wplanguagesoptions['languages_event_seat_available'];
		}
		if($wplanguagesoptions['languages_event_seat_inyourcart'])
		{
			$event_seat_inyourcart=$wplanguagesoptions['languages_event_seat_inyourcart'];
		}   
		if($wplanguagesoptions['languages_event_seat_inotherscart'])
		{
			$event_seat_inotherscart=$wplanguagesoptions['languages_event_seat_inotherscart'];
		}   
		if($wplanguagesoptions['languages_event_seat_booked'])
		{
			$event_seat_booked=$wplanguagesoptions['languages_event_seat_booked'];
		}   
		if($wplanguagesoptions['languages_event_seat_handicap'])
		{
			$event_seat_handicap=$wplanguagesoptions['languages_event_seat_handicap'];
		}   
		if($wplanguagesoptions['languages_event_itemsincart'])
		{
			$event_itemsincart=$wplanguagesoptions['languages_event_itemsincart'];
		}           
		if($wplanguagesoptions['languages_event_item_cost'])
		{
			$event_item_cost=$wplanguagesoptions['languages_event_item_cost'];
		}   
		if($wplanguagesoptions['languages_event_item_total'])
		{
			$event_item_total=$wplanguagesoptions['languages_event_item_total'];
		}
		if($wplanguagesoptions['languages_event_item_grand'])
		{
			$event_item_grand=$wplanguagesoptions['languages_event_item_grand'];
		}       
		if($wplanguagesoptions['languages_event_item_checkout'])
		{
			$event_item_checkout=$wplanguagesoptions['languages_event_item_checkout'];
		}
		if($wplanguagesoptions['languages_event_item_clearcart'])
		{
			$event_item_clearcart=$wplanguagesoptions['languages_event_item_clearcart'];
		}
		if($wplanguagesoptions['languages_event_bookingdetails'])
		{
			$event_bookingdetails=$wplanguagesoptions['languages_event_bookingdetails'];
		}           
		if($wplanguagesoptions['languages_event_customer_name'])
		{
			$event_customer_name=$wplanguagesoptions['languages_event_customer_name'];
		}           
		if($wplanguagesoptions['languages_event_customer_email'])
		{
			$event_customer_email=$wplanguagesoptions['languages_event_customer_email'];
		}           
		if($wplanguagesoptions['languages_event_customer_phone'])
		{
			$event_customer_phone=$wplanguagesoptions['languages_event_customer_phone'];
		}           
		if($wplanguagesoptions['languages_event_customer_terms'])
		{
			$event_terms=$wplanguagesoptions['languages_event_customer_terms'];
		}           
		 if($wplanguagesoptions['languages_cart_is_empty'])
		{
			$cart_is_empty=$wplanguagesoptions['languages_cart_is_empty'];
		}   
		if($wplanguagesoptions['languages_event_seat'])
		{
			$event_seat=$wplanguagesoptions['languages_event_seat'];
		}           
		if($wplanguagesoptions['languages_event_item_cost'])
		{
			$event_item_cost=$wplanguagesoptions['languages_event_item_cost'];
		}   
		if($wplanguagesoptions['languages_button_continue'])
		{
			$button_continue=$wplanguagesoptions['languages_button_continue'];
		}   
		if($wplanguagesoptions['languages_added'])
		{
			$languages_added=$wplanguagesoptions['languages_added'];
		}   
		if($wplanguagesoptions['languages_event_stall'])
		{
			$event_stall=$wplanguagesoptions['languages_event_stall'];
		}           
		if($wplanguagesoptions['languages_event_balcony'])
		{
			$event_balcony=$wplanguagesoptions['languages_event_balcony'];
		}
		if($wplanguagesoptions['languages_event_circle'])
		{
			$event_circle=$wplanguagesoptions['languages_event_circle'];
		}       
		if($wplanguagesoptions['languages_event_seat_stage'])
		{
			$event_seat_stage=$wplanguagesoptions['languages_event_seat_stage'];
		}   
		if($wplanguagesoptions['languages_coupon_vip_member'])
		{
			$coupon_vip_member=$wplanguagesoptions['languages_coupon_vip_member'];
		}           
}   



	?>

	<!-- OUR PopupBox DIV-->

	<?php

	$rst_options = get_option(RSTPLN_OPTIONS);

	$rst_paypal_options = get_option(RSTPLN_PPOPTIONS);

	$rst_tandc = $rst_options['rst_tandc'];

	$rst_email = $rst_options['rst_email'];

	$rst_etem = $rst_options['rst_etem'];

	$paypal_id = $rst_paypal_options['paypal_id'];

	$paypal_url = $rst_paypal_options['paypal_url'];

	$return_page = $rst_paypal_options['custom_return'];

	$symbol = $rst_paypal_options['currencysymbol'];
	$symbol = get_option('rst_currencysymbol');
	
	//print $symbol."------------".$rst_options['rst_currency'];

	$symbols = array(
		"0" => "$",
		"1" => "&pound;",
		"2" => "&euro;",
		"3" => "&#3647;",
		"4" => "&#8362;",
		"5" => "&yen;",
		"6" => "&#8377;",
		"7" => "R$",
		"8" => "kr",
		"9" => "zł",
		"10" => "Ft",
		"11" => "Kč",
		"12" => "&#1088;&#1091&#1073;",
		"13" => "&#164;",
		"14" => "&#x20B1;",
		"15" => "Fr",
		"16" => "RM");

	$symbol = $symbols[$symbol];

	$notifyURL = RST_PAYPAL_PAYMENT_URL . "ipn.php";

	if ($return_page == "") {

		$returnURL = get_option('siteurl') . "/?paypal_return='true'";

	} else {

		$returnURL = $return_page;

	}

	// Process

	// Send back the contact form HTML

	//  require_once('inc.checkout.form.php');

	?>


	<script type="text/javascript" language="javascript">

        jQuery(document).ready(function () {

            jQuery('.QTPopup').hide();

            jQuery(".contact").click(function () {

                <?php
                apply_filters('row_seats_seat_restriction_js_filter','');
                ?>

                document.getElementById('startedcheckout').value = "yes";

                jQuery('.vh_wrapper').addClass('blur');
                var bg = jQuery('body').css('background-image');
                var bg_pos = jQuery('body').css('background-position');
                jQuery('.vh_wrapper').css({
                    'background-image': bg,
                    'background-position': bg_pos,
                    'background-repeat': 'no-repeat'
                });
                jQuery('body').addClass('vh_noscroll');
                jQuery(".QTPopup").dialog({ 
                    modal: true, 
                    width: 671,
                    resizable: false,
                    dialogClass: "spotlight checkout",
                    position: { my: "center center", at: "center center" },
                    close: function() {
                        jQuery(this).dialog('destroy');
                        jQuery('.vh_wrapper').removeClass('blur');
                        jQuery('#event_dialog').remove();
                        jQuery('body').removeClass('vh_noscroll');
                        document.getElementById('startedcheckout').value = "";
                    } 
                });
            });

            jQuery(".handy").click(function () {
                jQuery('.vh_wrapper').addClass('blur');
                var bg = jQuery('body').css('background-image');
                var bg_pos = jQuery('body').css('background-position');
                jQuery('.vh_wrapper').css({
                    'background-image': bg,
                    'background-position': bg_pos,
                    'background-repeat': 'no-repeat'
                });
            });

            jQuery('#popup_cancel, #popup_ok').live( "click", function() {
                jQuery('.vh_wrapper').removeClass('blur');
                console.log('asd');
            });

        });

    </script>


	<?php

	$currenturl = $_REQUEST['redirecturl'];

	$rst_options = get_option(RSTPLN_OPTIONS);

	$rst_paypal_options = get_option(RSTPLN_PPOPTIONS);

	$rst_tandc = $rst_options['rst_tandc'];

	$rst_email = $rst_options['rst_email'];

	$rst_etem = $rst_options['rst_etem'];

	$paypal_id = $rst_paypal_options['paypal_id'];

	$paypal_url = $rst_paypal_options['paypal_url'];

	$return_page = $rst_paypal_options['custom_return'];
	if ($return_page != '') {
		$currenturl = $return_page;
	}
	$currency = $rst_paypal_options['currency'];

	$symbol = $rst_paypal_options['currencysymbol'];
	$symbol = get_option('rst_currencysymbol');

	$symbols = array(
		"0" => "$",
		"1" => "&pound;",
		"2" => "&euro;",
		"3" => "&#3647;",
		"4" => "&#8362;",
		"5" => "&yen;",
		"6" => "&#8377;",
		"7" => "R$",
		"8" => "kr",
		"9" => "zł",
		"10" => "Ft",
		"11" => "Kč",
		"12" => "&#1088;&#1091&#1073;",
		"13" => "&#164;",
		"14" => "&#x20B1;",
		"15" => "Fr",
		"16" => "RM");

	$symbol = $symbols[$symbol];

	$sesid = session_id();

	$notifyURL = RST_PAYPAL_PAYMENT_URL . "ipn.php";

	if ($return_page == "") {
		$returnURL = get_option('siteurl') . "/?paypal_return='true'";
	} else {
		$returnURL = $return_page;
	}

	?>

	<div class="vh_row_loading_effect"></div>

	<div class="QTPopup" title="<?php echo $event_bookingdetails;?>">

	<div id='elem'  class="QTPopupCntnr"   style="width: 750px; <?php echo apply_filters('row_seats_generel_admission_popupfix',$showid);?>">

	<div class="gpBdrLeftTop"></div>

	<div class="gpBdrRightTop"></div>

	<div class="gpBdrTop"></div>

	<div class="gpBdrLeft">

	<div class="gpBdrRight">

	<div class="caption">

		<?php echo $event_bookingdetails;?>

	</div>

	<a href="#" class="closeBtn" title="Close"></a>

	<div class="checkoutcontent">

	<form method='POST' id="checkout_main_form" action='' target="rsiframe"  onsubmit="row_seats_presubmit('<?php print $showid['id'];?>');"  enctype='multipart/form' name="checkoutform">
 <div class="row_seats_signup_form" id="rssignup_form">
    <table class="checkout_footer" width="100%" cellpadding="0" cellspacing="0">

    <tr>
    <div class="tableft">

        <div class="checkout_price">
<?php
		$totalitems= count($bookings);

if($rst_options['rst_enable_special_pricing']=="on" and row_seats_special_pricing_verification())
{   
		
?>
<script language="javascript">
function updateprice()
{
	var totalitems=document.getElementById('totalrecords').value;
	var total=0;
	var gtotal=0;
	var htmlstring;
	for (var i=0; i<totalitems; i++)
	{
	var dropboxvalue=document.getElementById('special_pricing'+i).value;
	var dropboxvalues = dropboxvalue.split('#');
		document.getElementById("price"+i).innerHTML=""+dropboxvalues[1];
		total=parseFloat(total)+parseFloat(dropboxvalues[1]);
	}
	document.getElementById("total").innerHTML=formatCurrency(total);
	document.getElementById('amount').value=total;
	gtotal=total;

	if(document.getElementById('rst_fees').value!='')
	{
		gtotal=parseFloat(gtotal) + parseFloat(document.getElementById('rst_fees').value);
		document.getElementById('aftercoupongrand').style.visibility="visible";
	}

	if(document.getElementById('coupondiscount').value!='')
	{
		gtotal=parseFloat(gtotal) - parseFloat(document.getElementById('coupondiscount').value);
		document.getElementById('discountamount').innerHTML=document.getElementById('coupondiscount').value;
		document.getElementById('aftercoupondis').style.visibility="visible";
		document.getElementById('aftercoupongrand').style.visibility="visible";
	}
	document.getElementById('Grandtotal').innerHTML=formatCurrency(gtotal);
	document.getElementById('amount').value=gtotal;

}
</script>

			<?php
			
}           

			$rst_bookings = $bookings;
		//print_r($bookings);
			$mycartitems = serialize($bookings);
			$description = $rst_bookings;

			$total = 0;

			$totalseats = 0;
				if($rst_options['rst_enable_special_pricing']=="on" and row_seats_special_pricing_verification())
				{               
		$rst_options['rst_special_pricing_count']=row_seats_special_number_of_special_price($_SESSION['views']);
		$totalspecialpricing=$rst_options['rst_special_pricing_count']+1;
		if(!$rst_options['rst_special_pricing_count'])
		$totalspecialpricing=1;
		}

		   for ($i = 0; $i < count($rst_bookings); $i++) {

				$rst_booking = $rst_bookings[$i];
				//creating special price dropdown
				if($rst_options['rst_enable_special_pricing']=="on" and row_seats_special_pricing_verification())
				{           
					for($j=1;$j<$totalspecialpricing;$j++){
						$special_pricing_array=array();
						$special_pricing_array=row_seats_special_special_price_array($_SESSION['views'],$rst_booking['price']);
					}   
				}   
				$seattitle=$rst_booking['row_name'] . $rst_booking['seatno'];
				$seattitle = apply_filters('row_seats_generel_admission_hideticketnumber', $seattitle,$i+1,$_SESSION['views']);
		?>


                <div class="checkout_ticket">
                    <div><?php echo __('Seat', 'vh') . ' ' . $rst_booking['row_name'] . $rst_booking['seatno'] . ' ' . $symbol . $rst_booking['price'];?></div>

                        <?php
                        //creating special price dropdown
                        if($rst_options['rst_enable_special_pricing']=="on" and row_seats_special_pricing_verification()) { ?>
                            <div class="special_select">
                                <select name="special_pricing<?php echo $i;?>" id="special_pricing<?php echo $i;?>" onchange="updateprice();">      
                                    <option value="normal#<?php echo $rst_booking['price'];?>">Normal</option>
                                    <?php
                                    foreach($special_pricing_array as $key=>$value){
                                        print "<option value='".$key."#".$value."'>".$key."           ".$symbol.$value."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                    <?php } ?>

                </div>


				<?php $total = $total + $rst_booking['price'];

				$total = number_format($total, 2, '.', '');

			}

			?>


			<div class="cart_total_container">

		

			<?php
			$wpfeeoptions = get_option(RSTFEE_OPTIONS);
			$sercharge = 0;
			// print_r($wpfeeoptions);
			if ($wpfeeoptions['rst_enable_fee'] == 'on' && /*fees-----*/
				apply_filters('rst_fee_plugin_filter', '') /*-----fees*/
			) {
				if ($wpfeeoptions['rst_fee_type'] == 'flate') {
					$gtotal = $wpfeeoptions['fee_amt'] + $total;
					$gtotal = number_format($gtotal, 2, '.', '');
					$sercharge = number_format($wpfeeoptions['fee_amt'], 2, '.', '');
				} else {
					$sercharge = number_format((($wpfeeoptions['fee_amt'] * $total) / 100), 2, '.', '');
					$gtotal = number_format(($sercharge + $total), 2, '.', '');
				}
			} else {
				$gtotal = $total;
			}
			?>

			<?php if ($wpfeeoptions['rst_enable_fee'] == 'on') { ?>

				<?php
				/* fees ----- */
				apply_filters('rst_fee_fields_filter', '', $wpfeeoptions, $symbol, $sercharge, $gtotal);
				$fee_name=$wpfeeoptions['fee_name'];
				/* ----- fees */
				?>
				
			<div>
                <div width="50%"><?php echo $fee_name . $symbol;?>
                    <span style="color: green;font-size: larger;" id="fee_name"><?php echo esc_attr($sercharge); ?></span>
                </div>
            </div>               

            <?php } ?>


            <div id="aftercoupondis" style="display: none;">
                <div><?php echo __('Discount', 'vh') . ': ' . $symbol;?>
                    <span id="discountamount"></span>
                </div>
            </div>

            <div id="aftercoupongrand" class="carttotclass">
                <div><?php echo $event_item_grand . ': ' . $symbol . $gtotal;?></div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
    </div>
   <div class="tabright" width="60%">

   
        <div>
		
		<?php 
			$row='Before Name';
			$contact_field = apply_filters('row_seats_custom_fieldname',$row);
			?>

			<div>
                <div class="checkout_name">
                    <input type='text' id='contact_name' class='contact-input' name='contact_name' value='<?php echo $user_name;?>' placeholder="<?php echo $event_customer_name; ?>"/>
                    <div class="name_error_msg"><?php _e("Enter your name, please","vh"); ?></div>
                </div>
            </div>

			<?php 
			$row='After Name';
			$contact_field = apply_filters('row_seats_custom_fieldname',$row);
			 
			$row='Before Email';
			$contact_field = apply_filters('row_seats_custom_fieldname',$row);
			?>  

			<div class="checkout_email">
                <input type='text' id='contact_email' class='contact-input' name='contact_email' value='<?php echo $user_email;?>' placeholder="<?php echo $event_customer_email; ?>"/>
                <div id="email_error_msg" class="email_error_msg"><?php _e("Enter your email, please","vh"); ?></div>
            </div>

			<?php 
			$row='After Email';
			$contact_field = apply_filters('row_seats_custom_fieldname',$row);
			 
			$row='Before Phone';
			$contact_field = apply_filters('row_seats_custom_fieldname',$row);
			?>  

			<div class="checkout_phone">
                <input type='text' id='contact_phone' class='contact-input' name='contact_phone' value='<?php echo $user_phone;?>' placeholder="<?php echo $event_customer_phone; ?>"/>
                <div class="phone_error_msg"><?php _e("Enter your phone, please","vh"); ?></div>
            </div>

			 <?php 
			$row='After Phone';
			$contact_field = apply_filters('row_seats_custom_fieldname',$row);
			?>

			<script>
                jQuery('.checkout_terms .termsclass').click(function() {
                    jQuery('.checkout_terms_text').css('display', 'inline-block').animate({
                        height: "100%",
                    }, 300, function() {
                        jQuery('.checkout_terms_text .icon-cancel-circled-outline').show();
                    });
                });
                jQuery('.checkout_terms_text .icon-cancel-circled-outline').click(function(e) {
                    e.preventDefault();
                    jQuery('.checkout_terms_text').animate({
                        height: "0%",
                    }, 300, function() {
                        jQuery('.checkout_terms_text').hide();
                    });
                });
                jQuery('.checkout_terms .fake_checkbox').click(function() {
                    var checkbox = jQuery('.checkout_terms #rstterms');
                    if ( !checkbox.prop("checked") ) {
                        jQuery(this).addClass('checked');
                    } else {
                        jQuery(this).removeClass('checked');
                    };
                    checkbox.prop("checked", !checkbox.prop("checked"));
                });
                jQuery('.checkout_vip .fake_checkbox').click(function() {
                    var checkbox = jQuery('.checkout_vip #rstmem');
                    if ( !checkbox.prop("checked") ) {
                        jQuery(this).addClass('checked');
                    } else {
                        jQuery(this).removeClass('checked');
                    };
                    checkbox.prop("checked", !checkbox.prop("checked"));
                });
                jQuery('#rssubmit').click(function(e) {
                    e.preventDefault();
                    var name = jQuery('.checkout_name input');
                    var email = jQuery('.checkout_email input');
                    var phone = jQuery('.checkout_phone input');
                    var terms = jQuery('.checkout_terms input').prop("checked");
                    name.removeClass('error');
                    email.removeClass('error');
                    phone.removeClass('error');
                    jQuery('.checkout_terms .fake_checkbox').removeClass('error');
                    jQuery('.checkout_terms .termsclass').removeClass('error');
                    jQuery('.name_error_msg').hide();
                    jQuery('.email_error_msg').hide();
                    jQuery('.phone_error_msg').hide();

                    if ( name.val() == '' ) {
                        name.addClass('error');
                        jQuery('.name_error_msg').show();
                        return;
                    } else if ( email.val() == '' ) {
                        email.addClass('error');
                        jQuery('.email_error_msg').show();
                        return;
                    } else if ( phone.val() == '' ) {
                        phone.addClass('error');
                        jQuery('.phone_error_msg').show();
                        return;
                    } else if ( terms == false ) {
                        jQuery('.checkout_terms .termsclass').addClass('error');
                        jQuery('.checkout_terms .fake_checkbox').addClass('error');
                        return;
                    } else {
                        jQuery('#checkout_main_form').submit();
                    }
                });
            </script>

            <div class="checkout_terms">
                <div>
                    <div class="fake_checkbox"></div>
                    <input type='checkbox' id='rstterms' class='contact-input' name='rstterms'/>
                    <div class='termsclass'><?php echo $event_terms;?></div>
                </div>
            </div>
            <div class="checkout_terms_text"><?php echo stripslashes($rst_tandc); ?><a href="javascript:void(0);" class="icon-cancel-circled-outline"/></div>


			<!--            members and coupons ----- -->

			<?php $members = apply_filters('rst_apply_member_filter', ''); ?>

			<?php $coupons = apply_filters('rst_apply_coupon_filter', ''); ?>

			<?php
			if ($members && $coupons) {
				echo "
                <div class='checkout_vip'>
                    <div class='fake_checkbox'></div>
                    <input type='checkbox' id='rstmem' class='contact-input' name='rstmem' onclick=\"checkformember(this);\"/>
                    <div class='termsclass'> ".$coupon_vip_member.":</div>
                </div>
                ";
				echo $coupons;
			} elseif ($members) {
				echo $members;
			} elseif ($coupons) {
				echo $coupons;
			}
			?>

			<!--                    ----- members and coupons -->


			<tr>
				<td colspan='2'>


					<!--                    memberapplybtn and couponapplybtn ----- -->

					<?php $membersBtn = apply_filters('rst_apply_member_btn_filter', ''); ?>

					<?php $couponsBtn = apply_filters('rst_apply_coupon_btn_filter', ''); ?>

					<?php
					if ($members && $coupons) {
						echo $couponsBtn;
					} elseif ($members) {
						echo $membersBtn;
					} elseif ($coupons) {
						echo $couponsBtn;
					}
					?>

					<!--                    ----- memberapplybtn and couponapplybtn -->


					<span id="couponprogress" style="color: #51020B;padding-left:10px;"></span><br/>


				</td>
			</tr>

			<tr>
				<td colspan='2'>&nbsp; </td>
			</tr>
		 <tr>
				<td colspan='2'>
<?php
$active_payment_methods = apply_filters('row_seats_active_payment_methods', array());
//print_r($active_payment_methods);
$available_payment_methods = apply_filters('row_seats_available_payment_methods', array());
//print_r($available_payment_methods);
$activecurrency = get_option('rst_currency');
//print $activecurrency;
$payment_methods = apply_filters('row_seats_currency_payment_methods', $active_payment_methods, $activecurrency);
//print_r($payment_methods);



			if(current_user_can('contributor') || current_user_can('administrator'))    
{
//print "Inside-------------";
			$form .= '<input type="hidden" value="offlinepayment_force" name="payment_method">';

}           
			elseif (sizeof($payment_methods) > 0) {

				$form .= '

				<div class="rst_form_row">';

				$checked = ' checked="checked"';

				foreach ($payment_methods as $key => $method) {

					$form .= '

					<div style="background: transparent url('.$method['logo'].') 25px '.$method['logo_vertical_shift'].'px no-repeat; height: 45px; width: '.($method['logo_width']+25).'px; float: left; margin-right: 30px;">

                        <input type="radio" value="'.$key.'" name="payment_method" style="margin: 4px 0px;"'.$checked.'>

                    </div>';

					$checked = '';

				}

				$form .= '

				</div>';

			} else {
			$form .= '<input type="hidden" value="offlinepayment_force" name="payment_method">';
			
			}
			
			print $form;

?>      
		
		</td>
			</tr>    
		
			<!--added class-->
            <div class="required_fields"><?php _e('Required field', 'vh'); ?></div>
            <div class="checkout_submit">
                <a href="javascript:void(0);" id="rssubmit" class="row_seats_submit icon-credit-card hover_right"><?php echo $button_continue;?></a>
                <img id="rsloading" class="row_seats_loading" src="<?php echo plugins_url('/images/loading.gif', __FILE__);?>" alt="">          
            </div>

			<input type="hidden" name="cmd" value="_xclick"/>

			<input type="hidden" name="notify_url" value="<?php echo $notifyURL; ?>"/>
			<input type="hidden" name="action" value="wp_row_seats-signup" />

			<input type="hidden" name="return" id="return" value="<?php echo $return_page ?>"/>

			<input type="hidden" name="business" value="<?php echo $paypal_id; ?>"/>

			<input type="hidden" name="amount" id="amount" value="<?php echo esc_attr($gtotal); ?>"/>


			<input type="hidden" id="item_name" name="item_name" value="Seats Booking"/>
		 <input type="hidden" id="bookingid" name="bookingid" value=""/>

			<input type="hidden" name="custom" id="custom" value=""/>

			<input type="hidden" name="no_shipping" value="0"/>
			<input type="hidden" name="currency_code" value="<?php echo $currency ?>"/>
		<input type="hidden" name="mycartitems"  id="mycartitems" value="<?php echo $mycartitems; ?>"/>
		
		

		</table>
		<div id="rsmessage5" class="row_seats_message"></div>
		<iframe id="rsiframe" name="rsiframe" class="row_seats_iframe" onload="row_seats_load();"></iframe>
	
	

	

	</div>
	</tr>

	</table>
	</div>
	<input type="hidden" name="appliedcoupon" id="appliedcoupon" value=""/>

	<input type="hidden" name="totalbackup" id="totalbackup" value="<?php echo esc_attr($gtotal); ?>"/>

	<input type="hidden" name="statusofcouponapply" id="statusofcouponapply" value=""/>

	<input type="hidden" name="totalrecords" id="totalrecords" value="<?php echo count($bookings);?>"/>
	
	<input type="hidden" name="coupondiscount" id="coupondiscount" value=""/>
	<input type="hidden" name="rst_fees" id="rst_fees" value="<?php echo esc_attr($sercharge); ?>"/>
	<input type="hidden" name="fee_name" id="fee_name" value="<?php echo esc_attr($fee_name); ?>"/>

	</form>
	<div class="row_seats_confirmation_container" id="rsconfirmation_container2"></div> 



	</div>

	</div>

	</div>

	<div class="gpBdrLeftBottom"></div>

	<div class="gpBdrRightBottom"></div>

	<div class="gpBdrBottom"></div>

	</div>

	</div>


	<?php
	
	


	$html = '';

	$showid = $showid['id'];

	//print_r($seats);

	$data = getshowbyid($showid);

	$showorder = $data[0]['orient'];

	if ($showorder == 0 || $showorder == '') {
		$seats = rst_seats_operations('list', '', $showid);
	} else {
		$seats = rst_seats_operations('reverse', '', $showid);
	}
	$seatsize=$wpdb->get_var("SELECT LENGTH( seatno ) AS fieldlength FROM rst_seats where show_id='".addslashes($showid)."' ORDER BY fieldlength DESC LIMIT 1 ");
	//print "<br>12-".$seatsize;
	if($seatsize>2)
	{
	$seatsize=5*($seatsize-2);
	}else
	{
	$seatsize=0;
	}
	$divwidth = (($seats[0]['total_seats_per_row']) + 2) * (24+$seatsize);
	 $divwidth=$divwidth * $rst_options['rst_zoom'];
	 
	$mindivwidth = 640;
	if ($divwidth < $mindivwidth) {
		$divwidth = $mindivwidth;
	}
	if($rst_options['rst_fixed_width'])
	{
	$divwidth =$rst_options['rst_fixed_width'];
	}
	
	$showname = $data[0]['show_name'];

	$html .= '';
	$seat_help='<div style="display:inline-block;"><span class="handy showseats" ></span> <span class="show-text">'.$event_seat_handicap.'  </span></div>';
	if($rst_options['rst_seat_help']=="disable")
	{
	$seat_help='';
	
	
	}
$colorchat=apply_filters('row_seats_color_selection_css2',$colorchat,$showid);
	


    $html .= '<div id="currentcart"><div style="width: 100%">'.$colorchat.'
            <div style="display:inline-block;"><span class="notbooked showseats" ></span><span class="show-text">'.$event_seat_available.'  </span></div>
            <div style="display:inline-block;"><span class="blocked showseats" ></span> <span class="show-text">'.$event_seat_inyourcart.'  </span></div>
            <div style="display:inline-block;"><span class="un showseats" ></span> <span class="show-text">'.$event_seat_inotherscart.'  </span></div>
            <div style="display:inline-block;"><span class="booked showseats" ></span> <span class="show-text">'.$event_seat_booked.'  </span></div>'.$seat_help.'<br/><br/>';

$topheader="";
if($rst_options['rst_stage_alignment']=="top" or !$rst_options['rst_stage_alignment'])
{
$topheader='<div class="stage-hdng" style="width:' . $divwidth . 'px; border:1px solid;border-radius:5px;box-shadow: 5px 5px 2px #888888;" >'.$event_seat_stage.'</div>';
}       
	$html .= '</div></div>'.$topheader;

	$rst_bookings = $bookings;

	$sessiondata = base64_encode(serialize($rst_bookings));

	if ($sessiondata != "") {

		?>


		<script>
			jQuery.cookie("rst_cart_<?php echo $showid?>", '<?php echo $sessiondata;?>');
		</script>


	<?php

	}

	$foundcartitems = 0;

	$html .= '<div class="main seatplan" id="showid_' . $showid . '" style="width:100%  !important;" >';

	$nextrow = '';

	$dicount = 0;

	for ($i = 0; $i < count($seats); $i++) {

		$data = $seats[$i];

		$nofsets = $data['total_seats_per_row'];
		$nofsets = floor($nofsets / 2);
//$event_stall=strrev($event_stall);
for ($z=0;$z<strlen($event_stall);$z++) {
$stall[$nofsets+$z]=$event_stall[$z];
}

		//$stall[$nofsets] = 'S';
		//$stall[$nofsets + 1] = 'T';
		//$stall[$nofsets + 2] = 'A';
		//$stall[$nofsets + 3] = 'L';
	   // $stall[$nofsets + 4] = 'L';
		///

		if ($showorder != 0) {
		
$event_stall=strrev($event_stall);
for ($z=0;$z<strlen($event_stall);$z++) {
$stall[$nofsets+$z]=$event_stall[$z];
}
		
			//$stall[$nofsets] = 'L';
			//$stall[$nofsets + 1] = 'L';
			//$stall[$nofsets + 2] = 'A';
		   // $stall[$nofsets + 3] = 'T';
			//$stall[$nofsets + 4] = 'S';
		}
//$event_balcony=strrev($event_balcony);
for ($z=0;$z<strlen($event_balcony);$z++) {
$balcony[$nofsets+$z]=$event_balcony[$z];
}
		//$balcony[$nofsets] = 'B';
		//$balcony[$nofsets + 1] = 'A';
		//$balcony[$nofsets + 2] = 'L';
		//$balcony[$nofsets + 3] = 'C';
	   // $balcony[$nofsets + 4] = 'O';
	   // $balcony[$nofsets + 5] = 'N';
	   // $balcony[$nofsets + 6] = 'Y';
		if ($showorder != 0) {
$event_balcony=strrev($event_balcony);
for ($z=0;$z<strlen($event_balcony);$z++) {
$balcony[$nofsets+$z]=$event_balcony[$z];
}       
			//$balcony[$nofsets] = 'Y';
		   // $balcony[$nofsets + 1] = 'N';
		   // $balcony[$nofsets + 2] = 'O';
		   // $balcony[$nofsets + 3] = 'C';
		   // $balcony[$nofsets + 4] = 'L';
		   // $balcony[$nofsets + 5] = 'A';
		   // $balcony[$nofsets + 6] = 'B';
		}
		//


//$event_circle=strrev($event_circle);
for ($z=0;$z<strlen($event_circle);$z++) {
$circle[$nofsets+$z]=$event_circle[$z];
}       
		//$circle[$nofsets] = 'C';
		//$circle[$nofsets + 1] = 'I';
	   // $circle[$nofsets + 2] = 'R';
	   // $circle[$nofsets + 3] = 'C';
		//$circle[$nofsets + 4] = 'L';
		//$circle[$nofsets + 5] = 'E';
		if ($showorder != 0) {


$event_circle=strrev($event_circle);
for ($z=0;$z<strlen($event_circle);$z++) {
$circle[$nofsets+$z]=$event_circle[$z];
}       
			//$circle[$nofsets] = 'E';
		   // $circle[$nofsets + 1] = 'L';
		   // $circle[$nofsets + 2] = 'C';
		   // $circle[$nofsets + 3] = 'R';
		   // $circle[$nofsets + 4] = 'I';
			//$circle[$nofsets + 5] = 'C';
		}

		$rowname = $data['row_name'];

		$seatno = $data['seatno'];

		$seatcost = $data['seat_price'];

		$seatdiscost = $data['discount_price'];

		if ($i == 0) {

			if ($rowname == '') {
                $html .= '<div class="seatplan_row" style="float:left;"><ul class="r"><li class="stall showseats">' . $rowname . '</li>';
            } else {
                $html .= '<div class="seatplan_row" style="float:left;"><ul class="r"><li class="ltr">' . $rowname . '</li>';
            }
		}
		if ($nextrow != $rowname && $i != 0) {
			if ($rowname == '') {
                $html .= '<li class="ltr">' . $nextrow . '</li></ul></div><div class="seatplan_row" style="float:left;"><ul class="r"><li class="stall showseats">' . $rowname . '</li>';
            } else {
                if ($nextrow == '') {
                    $html .= '<li class="stall showseats">' . $nextrow . '</li></ul></div><div class="seatplan_row" style="float:left;"><ul class="r"><li class="ltr">' . $rowname . '</li>';
                } else {
                    $html .= '<li class="ltr">' . $nextrow . '</li></ul></div><div class="seatplan_row" style="float:left;"><ul class="r"><li class="ltr">' . $rowname . '</li>';
                }

            }

		}

		$rst_options = get_option(RSTPLN_OPTIONS);

		$dicount = $rst_options['rst_h_disc'];

		if ($dicount != '') {

			$dicount = $seatcost - ($seatcost * ($dicount / 100));

			$dicount = round($dicount, 2);


		} else {

			$dicount = $seatcost;

		}

		$dicount = number_format($dicount, 2, '.', '');

		$seats_avail_per_row = unserialize($data['seats_avail_per_row']);

		$otherscart = false;
		

		$cssclassname="notbooked";
		$cssclassname=apply_filters('row_seats_color_selection_css_name',$cssclassname,$data['seatcolor']);

		
		

		if ($data['seattype'] == 'N') {

			$html .= '<li class="un showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="Seat ' . $rowname . ($seatno) . ' Unavailable" rel="' . $data['seattype'] . '"></li>';

		} else if ($data['seattype'] == 'Y') {

			$html .= '<li class="'.$cssclassname.' showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="Seat ' . $rowname . ($seatno) . ' Price ' . $symbol . $seatcost . ' Available" rel="' . $data['seattype'] . '">' . ($seatno) . '<span></span></li>';

		} else if ($data['seattype'] == 'H') {

			$html .= '<li class="handy showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="Seat ' . $rowname . ($seatno) . ' Discount Price ' . $symbol . $dicount . ' " rel="' . $data['seattype'] . '">' . $seatno . '<span></span></li>';

		} else if ($data['seattype'] == 'B') {

			$html .= '<li class="booked showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="Seat ' . $rowname . ($seatno) . ' Booked" rel="' . $data['seattype'] . '">' . $seatno . '</li>';

		} else if ($data['seattype'] == 'T') {

			for ($o = 0; $o < count($rst_bookings); $o++) {

				if ($rst_bookings[$o]['row_name'] == $rowname && $rst_bookings[$o]['seatno'] == $seatno) {

					$otherscart = true;

				}

			}

			if ($otherscart) {

				$foundcartitems++;

				$html .= '<li class="blocked showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="Seat ' . $rowname . ($seatno) . '" rel="' . $data['seattype'] . '">' . $seatno . '</li>';

			} else {

				$html .= '<li class="b showseats" id="' . $showname . '_' . $showid . '_' . $rowname . '_' . $seatno . '_' . $seatno . '" title="Seat ' . $rowname . ($seatno) . '  Blocked" rel="' . $data['seattype'] . '">' . $seatno . '</li>';

			}

		} else if ($data['seattype'] == 'S')

			$html .= '<li class="s showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '" title="" rel="">' . $stall[$seatno] . '</li>';

		else if ($data['seattype'] == 'L')

			$html .= '<li class="l showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '" title="" rel="">' . $balcony[$seatno] . '</li>';

		else if ($data['seattype'] == 'C')

			$html .= '<li class="c showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '" title="" rel="">' . $circle[$seatno] . '</li>';

		else {

			$html .= '<li class="un showseats" id="' . $showname . '' . $showid . $rowname . $seatno . '_' . $seatno . '" title="" rel=""></li>';

		}

		$nextrow = $rowname;

	}

	if ($foundcartitems == 0) {

		?>

		<script>
			jQuery.cookie("rst_cart_<?php echo $showid?>", null);
		</script>


	<?php

	}
	
	
	$html .= '<li class="ltr">' . $nextrow . '</li></ul></div>';

	
	$html .= '</div>';
//$html="";
$html = apply_filters('row_seats_generel_admission_block_seatchart', $html);
	// cartitems ----->
$bottomheader="";
if($rst_options['rst_stage_alignment']=="bottom")
{
$bottomheader='<br><br><br><br><div class="stage-hdng" style="width:' . $divwidth . 'px; border:1px solid;border-radius:5px;box-shadow: 5px 5px 2px #888888;clear:both;float:center;" >'.$event_seat_stage.'</div><br>';
}
	$html .= '<div id="gap" style="clear:both;float:left;">&nbsp;</div>'.$bottomheader.'<a NAME="view_cart"></a>
		<div class="cartitems" style="width:100%; border:1px solid;border-radius:5px;box-shadow: 5px 5px 2px #888888;">
			<h1>'.$event_itemsincart.'</h1>
			<div class="clearfix"></div>';

	if ($rst_bookings != '' && count($rst_bookings) > 0) {

		$total = $tickets = 0;

		for ($i = 0; $i < count($rst_bookings); $i++) {

			$rst_booking = $rst_bookings[$i];

			$rst_booking['price'] = number_format($rst_booking['price'], 2, '.', '');
			$seattitle=$event_seat_row.' ' . $rst_booking['row_name'] .' - '.$event_seat.' '. ($rst_booking['seatno']) ;
			
			$seattitle = apply_filters('row_seats_generel_admission_hideticketnumber', $seattitle,$i+1,$showid);

			$html .= '
            <div class="tickets">
                <div class="ticket_info">' . __('Seat', 'vh') . ' ' . $rst_booking['row_name'] . ($rst_booking['seatno']) . ' ' . $symbol . $rst_booking['price'] . '
                    <a href="javascript:void(0);" class="deleteitems icon-cancel-circled-outline" id="' . $showname . '_' . $showid . '_' . $rst_booking['row_name'] . '_' . ($rst_booking['seatno']) . '" onclick="deleteitem(this);" style="cursor:pointer;border:none!important"></a>
                </div>
            </div>';

			$total = $total + $rst_booking['price'];
			$tickets++;
		}
		
		    if ( $tickets < 2 ) {
	            $ticket_text = __('ticket', 'vh');
	        } else {
	            $ticket_text = __('tickets', 'vh');
	        }
		
			$html = apply_filters('row_seats_seat_restriction_check_filter',$html,$rst_bookings,$showid);           

		    $html .= '
            <div class="clear_button">
                <a class="remove" href="javascript:void(0);"  id="' . $sessiondata . '" onclick="deleteitemall(this);">'.$event_item_clearcart.'</a>
            </div>
            <div class="checkout_button"><a class="contact icon-credit-card hover_right" href="javascript:void(0);" >' . __('Buy', 'vh') . ' ' . $tickets . ' ' . $ticket_text . ' ' . __('for', 'vh') . ' ' . $symbol . number_format($total, 2, '.', '') . ' ' . __('total', 'vh') . '</a></div>
            </div>
            </div>';

	} else {

		$html .= '<div class="cart_text icon-basket">'.$cart_is_empty.'</div></div>';

	}
	// <----- cartitems

	return $html;

}

remove_action('wp_ajax_nopriv_releasenow',             'rst_ajax_callback');
remove_action('wp_ajax_releasenow',                    'rst_ajax_callback');
remove_action('wp_ajax_nopriv_refresh',                'rst_ajax_callback');
remove_action('wp_ajax_refresh',                       'rst_ajax_callback');
remove_action('wp_ajax_nopriv_booking',                'rst_ajax_callback');
remove_action('wp_ajax_booking',                       'rst_ajax_callback');
remove_action('wp_ajax_save',                          'rst_ajax_callback');
remove_action('wp_ajax_update',                        'rst_ajax_callback');
remove_action('wp_ajax_delete',                        'rst_ajax_callback');
remove_action('wp_ajax_get_events',                    'rst_ajax_callback');
remove_action('wp_ajax_savebooking',                   'rst_ajax_callback');
remove_action('wp_ajax_nopriv_savebooking',            'rst_ajax_callback');
remove_action('wp_ajax_deleteall',                     'rst_ajax_callback');
remove_action('wp_ajax_nopriv_deleteall',              'rst_ajax_callback');
remove_action('wp_ajax_deletebooking',                 'rst_ajax_callback');
remove_action('wp_ajax_nopriv_deletebooking',          'rst_ajax_callback');
remove_action('wp_ajax_releasecurrentcart',            'rst_ajax_callback');
remove_action('wp_ajax_nopriv_releasecurrentcart',     'rst_ajax_callback');

add_action('wp_ajax_nopriv_releasenow',             'vh_rst_ajax_callback');
add_action('wp_ajax_releasenow',                    'vh_rst_ajax_callback');
add_action('wp_ajax_nopriv_refresh',                'vh_rst_ajax_callback');
add_action('wp_ajax_refresh',                       'vh_rst_ajax_callback');
add_action('wp_ajax_nopriv_booking',                'vh_rst_ajax_callback');
add_action('wp_ajax_booking',                       'vh_rst_ajax_callback');
add_action('wp_ajax_save',                          'vh_rst_ajax_callback');
add_action('wp_ajax_update',                        'vh_rst_ajax_callback');
add_action('wp_ajax_delete',                        'vh_rst_ajax_callback');
add_action('wp_ajax_get_events',                    'vh_rst_ajax_callback');
add_action('wp_ajax_savebooking',                   'vh_rst_ajax_callback');
add_action('wp_ajax_nopriv_savebooking',            'vh_rst_ajax_callback');
add_action('wp_ajax_deleteall',                     'vh_rst_ajax_callback');
add_action('wp_ajax_nopriv_deleteall',              'vh_rst_ajax_callback');
add_action('wp_ajax_deletebooking',                 'vh_rst_ajax_callback');
add_action('wp_ajax_nopriv_deletebooking',          'vh_rst_ajax_callback');
add_action('wp_ajax_releasecurrentcart',            'vh_rst_ajax_callback');
add_action('wp_ajax_nopriv_releasecurrentcart',     'vh_rst_ajax_callback');

function vh_wp_row_seats_signup_call() {
	$rst_options = get_option(RSTPLN_OPTIONS);

	$rst_paypal_options = get_option(RSTPLN_PPOPTIONS);
	
	$wplanguagesoptions = get_option(RSTLANGUAGES_OPTIONS);
	$event_warning_message=__("Attention! Please correct the errors below and try again.", "vh");
	$event_enter_name=__("Please enter name", "vh");
	$event_enter_email=__("Please enter email", "vh");
	$event_enter_phone=__("Please enter phone", "vh");
	$event_enter_terms=__("Please agree to our Terms and Conditions to continue", "vh");
	$event_customer_name=__("Name", "vh");
	$event_customer_email=__("Email", "vh");
	$event_customer_phone=__("Phone", "vh");
	$event_seat=__("Seat", "vh");
	$event_item_cost=__("Cost", "vh");
	$offline_purchase=__("Purchase", "vh");
	$offline_edit_info=__("Edit info", "vh");
	
	if($wplanguagesoptions['rst_enable_languages']=="on")
	{
		if($wplanguagesoptions['languages_event_enter_name'])
		{
			$event_enter_name=$wplanguagesoptions['languages_event_enter_name'];
		}
		if($wplanguagesoptions['languages_event_enter_email'])
		{
			$event_enter_email=$wplanguagesoptions['languages_event_enter_email'];
		}
		if($wplanguagesoptions['languages_event_enter_phone'])
		{
			$event_enter_phone=$wplanguagesoptions['languages_event_enter_phone'];
		}
		if($wplanguagesoptions['languages_event_enter_terms'])
		{
			$event_enter_terms=$wplanguagesoptions['languages_event_enter_terms'];
		}
		if($wplanguagesoptions['languages_event_customer_name'])
		{
			$event_customer_name=$wplanguagesoptions['languages_event_customer_name'];
		}           
		if($wplanguagesoptions['languages_event_customer_email'])
		{
			$event_customer_email=$wplanguagesoptions['languages_event_customer_email'];
		}           
		if($wplanguagesoptions['languages_event_customer_phone'])
		{
			$event_customer_phone=$wplanguagesoptions['languages_event_customer_phone'];
		}       
		if($wplanguagesoptions['languages_event_warning_message'])
		{
			$event_warning_message=$wplanguagesoptions['languages_event_warning_message'];
		}   
		if($wplanguagesoptions['languages_event_seat'])
		{
			$event_seat=$wplanguagesoptions['languages_event_seat'];
		}           
		if($wplanguagesoptions['languages_event_item_cost'])
		{
			$event_item_cost=$wplanguagesoptions['languages_event_item_cost'];
		}
		if($wplanguagesoptions['languages_offline_purchase'])
		{
			$offline_purchase=$wplanguagesoptions['languages_offline_purchase'];
		}
		if($wplanguagesoptions['languages_offline_edit_info'])
		{
			$offline_edit_info=$wplanguagesoptions['languages_offline_edit_info'];
		}
			
	}   
	
	
	$symbol = $rst_paypal_options['currencysymbol'];
	$symbol = get_option('rst_currencysymbol');
	$currency = get_option('rst_currency');
	$symbols = array(
		"0" => "$",
		"1" => "&pound;",
		"2" => "&euro;",
		"3" => "&#3647;",
		"4" => "&#8362;",
		"5" => "&yen;",
		"6" => "&#8377;",
		"7" => "R$",
		"8" => "kr",
		"9" => "zł",
		"10" => "Ft",
		"11" => "Kč",
		"12" => "&#1088;&#1091&#1073;",
		"13" => "&#164;",
		"14" => "&#x20B1;",
		"15" => "Fr",
		"16" => "RM");

	$symbol = $symbols[$symbol];
	//proccess the form offline if there is no active payment modules available 
	if(isset($_POST['action']) && $_POST['action']=="row_seats_default_offlinepayment") {
		vh_offline_payment_form_process();
		exit;
	}

	if(isset($_POST['action'])&&$_POST['action']=="wp_row_seats-signup")
	{

		header ('Content-type: text/html; charset=utf-8');
		print "<html><body>";
		$errors = array();
		$customfield_data= apply_filters('row_seats_custom_field_data',$_REQUEST['parameter']);
		if(!$_POST['contact_name'])     {
			$errors['enter_name'] = '<li>'.__($event_enter_name, 'row_seats').'</li>';      }
		if(!$_POST['contact_email'])
		{
			$errors['contact_email'] = '<li>'.__($event_enter_email, 'row_seats').'</li>';
		}
if (!filter_var($_POST['contact_email'], FILTER_VALIDATE_EMAIL)) {
   // echo "This ($email_a) email address is considered valid.";
	$errors['contact_email'] = '<li>'.__('Please enter a valid email', 'row_seats').'</li>';
}

		
		if(!$_POST['contact_phone'])
		{
			$errors['contact_phone'] = '<li>'.__($event_enter_phone, 'row_seats').'</li>';
		}
$errors= apply_filters('row_seats_custom_field_error',$errors);
		
		if(!$_POST['rstterms'])
		{
			$errors['rstterms'] = '<li>'.__($event_enter_terms, 'row_seats').'</li>';
		}
		
		if(count($errors)>0)
		{
			print "
			<div class='row_seats_error_message'>".__($event_warning_message, 'row_seats')."
				<ul class='row_seats_error_messages'>".implode('', $errors)."</ul>
			</div>";

		}else{ 

			print "<div class='row_seats_confirmation_info'>";
			$payment_method = trim(stripslashes($_POST["payment_method"]));
			$data=array();
			foreach( $_POST as $key=>$value)
			{
			$data[$key]=$value;
			}   
			
			$data['currency']=$currency;
					$checkout_summary = array(                  
						'contact_name' => array(
							'title' => __($event_customer_name, 'row_seats'),
							'value' => $_POST["contact_name"]
						),
						'contact_email' => array(
							'title' => __($event_customer_email, 'row_seats'),
							'value' => $_POST["contact_email"]
						),

						'contact_phone' => array(
							'title' => __($event_customer_phone, 'row_seats'),
							'value' => $_POST["contact_phone"]
						)
					);  
					
			$checkout_summary= apply_filters('row_seats_custom_field_preview',$checkout_summary);       
			//Select offline mode if Admin or if there is no active payment     
			if($_POST['payment_method']=="offlinepayment_force")
			{   
						$checkout_summary['payment_method'] = array(
							'title' => __('Payment Gateway', 'rst'),
							'value' => 'Offline payment'
						);                          
			}else{

						$checkout_summary['payment_method'] = array(
							'title' => __('Payment Gateway', 'rst'),
							'value' => apply_filters('row_seats_payment_logo', '', $payment_method)
						);  


			}           
			//Fetching cart products
			$cartitems = unserialize(base64_decode($_POST['mycartitems']));
//print "<br><br><br>";
			//print_r($cartitems);
			//print "<br><br><br>";
			
	$showid = $cartitems[0]['show_id'];
	$showdata1['vmid'] = $showid;
	$showdata1 = rst_shows_operations('byid', $showdata1, '');

	$showdata1 = $showdata1[0];
	$eventname1 = $showdata1['show_name'];
	$mytseats=array();
	$myitems=array();
	
			$subtotal=0;        
			for ($i = 0; $i < count($cartitems); $i++) {
				$seattitle = $cartitems[$i]['row_name'] . $cartitems[$i]['seatno'];
				$seattitle = apply_filters('row_seats_generel_admission_hideticketnumber', $seattitle,$i+1,$showid);
				$name ="Seat:".$seattitle;
				$mytseats[]=$cartitems[$i]['row_name'] . $cartitems[$i]['seatno'];
				$price=$cartitems[$i]['price'];
				if($rst_options['rst_enable_special_pricing']=="on" and row_seats_special_pricing_verification())
				{
					$myproductsarraytemp=split("#",$_POST['special_pricing'.$i]);
					$name.=" - ".$myproductsarraytemp[0];
					$price=$myproductsarraytemp[1];
				}
$itesmname=$eventname1." Seat:".$cartitems[$i]['row_name'] . $cartitems[$i]['seatno'];      
$myitems[]=array('name'=>$itesmname,'price'=>$price);           
	
				$subtotal+=$price;
				$price=$price;
				$checkout_summary['cartproducts'.$i] = array(
											'title' => __($name, 'row_seats'),
											'value' => $symbol.number_format($price, 2, ".", "")
										);
			}
$data['myitems']=$myitems;          
		$data['event_name_display']=$eventname1." ".implode(",",$mytseats);
		
					if($_POST['fee_name'] && $_POST['rst_fees'])    
			{
			$data['feeifany']=$_POST['rst_fees'];
			$data['feeifany_name']=$_POST['fee_name'];
			}
			if($_POST['coupondiscount'] && $_POST['appliedcoupon'] && $_POST['statusofcouponapply']=="success") 
			{
			 $data['discountifany']=$_POST['coupondiscount'];
			}           
			

			echo '<div class="row_seats__confirmation_table">';
            echo '<div class="checkout_confirmation_left">';
            foreach($checkout_summary as $key => $info) {
                if ( strpos($key,'cartproducts') === false ) {
                    echo '<div class="checkout_item">
                            <div class="row_seats__confirmation_title">'.$info['title'].':</div>
                            <div class="row_seats__confirmation_data">'.$info['value'].'</div>
                        </div>';
                }
            }
            echo '</div>';

            echo '<div class="checkout_confirmation_right">';
			foreach($checkout_summary as $key => $info) {
                if ( strpos($key,'cartproducts') !== false ) {
                    echo '<div class="checkout_item">
                        <div class="row_seats__confirmation_title">'.$info['title'].':</div>
                        <div class="row_seats__confirmation_data">'.$info['value'].'</div>
                    </div>';
                }
            }

			if($_POST['fee_name'] && $_POST['rst_fees'])    
			{
				echo '  <div class="checkout_item">
                        <div class="row_seats__confirmation_title">'.$_POST['fee_name'].':</div>
                        <div class="row_seats__confirmation_data">'.$symbol.number_format($_POST['rst_fees'], 2, ".", "").'</div>
                    </div>';

			}
			if($_POST['coupondiscount'] && $_POST['appliedcoupon'] && $_POST['statusofcouponapply']=="success") 
			{
				echo '  <div class="checkout_item">
                        <div class="row_seats__confirmation_title">' . __('Coupon', 'vh') . '('.$_POST['appliedcoupon'].'):</div>
                        <div class="row_seats__confirmation_data">'.$symbol.number_format($_POST['coupondiscount'], 2, ".", "").'</div>
                    </div>';

			}
			if($_POST['amount'] && $_POST['amount'])    
			{
				echo '   <div class="checkout_item">
                        <div class="row_seats__confirmation_title">' . __('Grand Total', 'vh') . ':</div>
                        <div class="row_seats__confirmation_data">'.$symbol.number_format($_POST['amount'], 2, ".", "").'</div>
                    </div>';

			}           

			echo '</div>';                    
			//Force offline method on 3 conditions 1. If admin, 2. If there is no active payment gateway 3. If total amount is ZERO                 
			if($_POST['payment_method']=="offlinepayment_force" || $_POST['amount']==0)
			{
			$data['payment_method']="offlinepayment_force";
			offline_payment_form($data);
			}else{
			do_action('row_seats_echo_payment_form', $data);
			}           
			

			//Genrating checkout buttons
			$buttons = array(                   

				'purchase' => array(
					'title' => __($offline_purchase, 'row_seats'),
					'onclick' => "savebookingcustom();"
				),
				'edit' => array(
					'title' => __($offline_edit_info, 'row_seats'),
					'onclick' => "row_seats_edit();"
				)
			);

			echo '
            <div class="row_seats_signup_buttons">';
                    foreach($buttons as $key => $button) {
                        if ( $prefix.$key == 'edit' ) {
                            echo '<a href="javascript:void(0);" id="'.$prefix.$key.'" class="row_seats_submit icon-credit-card hover_left" '.(!empty($button['onclick']) ? ' onclick="'.$button['onclick'].'"' : '').'>'.esc_attr($button['title']).'</a>';
                        } else {
                            echo '<a href="javascript:void(0);" id="'.$prefix.$key.'" class="row_seats_submit icon-credit-card hover_right" '.(!empty($button['onclick']) ? ' onclick="'.$button['onclick'].'"' : '').'>'.esc_attr($button['title']).'</a>';
                        }
                    }
                    echo '<img id="'.$prefix.'loading2" class="row_seats_loading" src="'.plugins_url('/images/loading.gif', __FILE__).'" alt=""></div>';
            
            print "</div>";
        }
        print "</body></html>";
		exit;
	}
}

remove_action('plugins_loaded', 'wp_row_seats_signup_call');
add_action('plugins_loaded', 'vh_wp_row_seats_signup_call');

function vh_offline_payment_form_process() {

	global $row_seats, $wpdb;
//print_r($_POST);

	if(isset($_POST['action']) && $_POST['action'] == 'row_seats_default_offlinepayment') {

	$symbol = get_option('rst_currencysymbol');
	$currency = get_option('rst_currency');
	$symbols = array(
		"0" => "$",
		"1" => "&pound;",
		"2" => "&euro;",
		"3" => "&#3647;",
		"4" => "&#8362;",
		"5" => "&yen;",
		"6" => "&#8377;",
		"7" => "R$",
		"8" => "kr",
		"9" => "zł",
		"10" => "Ft",
		"11" => "Kč",
		"12" => "&#1088;&#1091&#1073;",
		"13" => "&#164;",
		"14" => "&#x20B1;",
		"15" => "Fr",
		"16" => "RM");

	$symbol = $symbols[$symbol];

	
		$gross_total = $_REQUEST['amount'];
		$first_name= $_REQUEST['first_name'];   
		$last_name= $_REQUEST['last_name'];
		$card_number = $_REQUEST['card-number'];                    
		$card_cvc = $_REQUEST['card-cvc'];
		$card_expiry = $_REQUEST['card-expiry-month'].$_REQUEST['card-expiry-year'];                
		$street = $_REQUEST['street'];
		$city = $_REQUEST['city'];
		$state = $_REQUEST['state'];
		$country = $_REQUEST['country'];
		$zip = $_REQUEST['zip'];
		$phone = $_REQUEST['phone'];
		$transaction_mode_offline = $_REQUEST['transaction_mode'];
		$api_version = '85.0';      
		$request_params = array
		(
			'PAYMENTACTION' => 'Sale',
			'TRANSACTIONMODE' => $transaction_mode_offline,
			'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
			'FIRSTNAME' => $first_name,
			'LASTNAME' => $last_name,
			'STREET' => $street,
			'CITY' => $city,
			'STATE' => $state,             
			'COUNTRYCODE' => $country,
			'ZIP' => $zip,
			'PHONE' => $phone,
			'AMT' => $gross_total,
			'CURRENCYCODE' => $currency,
			'DESC' => $campaign_title
		);

		$temp_array['address'] = array
		(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'address' => $street,
			'city' => $city,
			'state' => $state,             
			'country' => $country,
			'zip' => $zip,
			'phone' => $phone
		);  

		$paymentData="";
		foreach($request_params as $var=>$val)
		{
		   $paymentData.= '&'.$var.'='.urlencode($val);  
		}                   

		$payer_name =$first_name." ".$last_name;           
		$payer_name =$_POST['offlinepayment_payer_name'];
		$payer_offlinepayment   =$_POST['offlinepayment_payer_email'];
		if($_POST['x_invoice_num']) 
		{
			$inid=$_POST['x_invoice_num'];
			$mc_currency =  $currency;

			if(current_user_can('contributor') || current_user_can('administrator')) // If booking done by Admin/Contributer
			{
				$transaction_type = 'Admin';
				$payment_status = 'Completed';  
			}elseif($_POST['amount']==0){    // If booking amount is 0
				$transaction_type = 'Zero booking';     
				$payment_status = 'Completed';                  
			}else   // When there is no active payment gateway for customer
			{
				$transaction_type = 'Not Paid'; 
				$payment_status = 'Pending';
			}
			$sql = "select * from $wpdb->rst_bookings rstbk,$wpdb->rst_shows rsts 
			where   rsts.id = rstbk.show_id 
			and rstbk.booking_id =" . $_POST['x_invoice_num'];  
			//Below condition executes for customer check when there is not active payment gateway - Start
			if ($results = $wpdb->get_results($sql, ARRAY_A)) {
				$booking_details = $wpdb->get_results($sql, ARRAY_A);
				$data = $booking_details[0];
				
		   
		$payer_name =$booking_details[0]['name'];
		$payer_offlinepayment   =$booking_details[0]['email'];

		
				$show_name = addslashes($booking_details[0]['show_name']);
				$show_date= $booking_details[0]['show_date'];
				$booking_details = $booking_details[0]['booking_details'];
				$ticketno = $rst_options['rst_ticket_prefix'] . $_POST['x_invoice_num'];
				$booking_details = unserialize($booking_details);
				$ticket_seat_no=array();
				for ($row = 0; $row < count($booking_details); $row++) {
					$seats = $booking_details[$row]['seatno'];
					$showid = $booking_details[$row]['show_id'];
					$rowname = $booking_details[$row]['row_name'];
					$price = $booking_details[$row]['price'];
					$ticket_seat_no[]=$rowname . $seats;    
				}
				$ticket_seat_no=implode(",",$ticket_seat_no);
				//Preparing to send alert mail to customer to notify that payment for offline method is pending.
				if($transaction_type=="Not Paid")
				{
					$tags = array('{payer_name}', '{payer_email}', '{payment_status}', '{show_name}', '{show_date}', '{seats}','{amount}');
					$vals = array($payer_name, $payer_offlinepayment, $payment_status,$show_name ,$show_date,$ticket_seat_no,$gross_total );
					$body = str_replace($tags, $vals, get_option('rst_pending_email_body'));
					$mail_headers = "Content-Type: text/plain; charset=utf-8\r\n";
					$mail_headers .= "From: ".get_option('rst_from_name')." <".get_option('rst_from_email').">\r\n";
					$mail_headers .= "X-Mailer: PHP/".phpversion()."\r\n";
					wp_mail(/*$email*/$payer_offlinepayment, get_option('rst_pending_email_subject'), $body, $mail_headers);    
				}               

			}   
			//Below condition executes for customer check when there is not active payment gateway - End    


			$sql = "INSERT INTO rst_payment_transactions (
				tx_str, payer_name, payer_email, gross, currency, payment_status, transaction_type, details, created, deleted,custom,first_name,last_name,address,city,state,zip,country,phone,show_name,show_date,coupon_code,coupon_discount,special_fee,ticket_no,seat_numbers,seat_cost) VALUES (
				'".mysql_real_escape_string($inid)."',
				'".mysql_real_escape_string($payer_name)."',
				'".mysql_real_escape_string($payer_offlinepayment)."',
				'".floatval($gross_total)."',
				'".$mc_currency."',
				'".$payment_status."',
				'Offline Payment:".$transaction_type."',
				'".addslashes($paymentData)."',
				'".time()."', '0','".$_POST['x_custom']."',
					'".$first_name."',
					'".$last_name."',
					'".$street."',
					'".$city."',
					'".$state."',
					'".$zip."',
					'".$country."',
					'".$phone."',
					'".$show_name."',
					'".$show_date."',
					'',
					'0',
					'0',
					'',
					'',
					''
			)";

			$wpdb->query($sql) or die(mysql_error());
			$transaction_id=mysql_insert_id();
			$data = array(
			'txn_id' => "TXYN".$inid,
			'mc_gross' => $_POST['amount'],
			'custom' => $_POST['x_custom']
			);

			if($transaction_type=="Not Paid") {
			$data['sendemail']="no"; // Don't send ticket mail if payment is pending
			}
			rst_bookseatsfinal($data); // booking seats
			
			if($transaction_type!="Not Paid") {         
				$tags = array('{payer_name}', '{payer_email}', '{payment_status}', '{show_name}', '{show_date}', '{seats}','{amount}');
				$vals = array($payer_name, $payer_offlinepayment, $payment_status,$show_name ,$show_date,$ticket_seat_no,$gross_total );
				$body = str_replace($tags, $vals, get_option('rst_success_email_body'));

				$mail_headers = "Content-Type: text/plain; charset=utf-8\r\n";
				$mail_headers .= "From: ".get_option('rst_from_name')." <".get_option('rst_from_email').">\r\n";
				$mail_headers .= "X-Mailer: PHP/".phpversion()."\r\n";
				wp_mail($payer_offlinepayment, get_option('rst_success_email_subject'), $body, $mail_headers);              

			}           

		}

		$logMessages .= "Done.";
		//$wpdb->query("INSERT INTO $wpdb->rst_paypal_ipn_log (booking_time, booking_id, messages) VALUES (now(), '$inid', '$logMessages')");   

		//if(current_user_can('contributor') || current_user_can('administrator'))
		//{

        $_POST['return'] = get_bloginfo("wpurl")."/?p=".get_option('vh_thank_you_page')."&event_id=".$_GET['event_id']."&movie=".$_GET['movie']."&id=".$inid;

        wp_redirect($_POST['return']);  

		exit;

		//}else{

		//$_POST['return']=get_bloginfo("wpurl")."/thank-you?id=".$inid;

		//}
		//wp_redirect($_POST['return']);            

	}       
}

?>