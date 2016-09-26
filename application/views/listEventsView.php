

<style>
			.error {
				color:red;
				font-size:13px;
				margin-bottom:-15px;
			}
			#totalRowNum{
				color:blue;
				font-size:20px;
				margin-bottom: -15px;;
			}
</style>

<!--		calendar setting -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
<!-- js -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.js"></script>
<!--	</head>-->
<!--	<body data-spy="scroll" data-target=".main-nav">-->
<!--		filter -->
				<section id="filter">
				</section>

		<section class="about" id="about">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2 class="create-form-heading">LIST OF EVENTS</h2>

						<?php echo form_open('ListEvent/searchWithCriteria', array('id'=>'searchForm')); ?>

						<div class="row mb90">
							<div class="col-md-2">
							</div>
							<div class="col-md-5">
								<div>
								<label><input type="checkbox" value="location" name="criteria[]" id="location"> Location</label>
									&nbsp <input type="text"  id="searchKeyword" name = "searchKeyword" value="<?php echo set_value('searchKeyword')?>" placeholder="Enter a location...">
									<br>
								<label><input type="checkbox" value="calendarDay" name="criteria[]" id="calendarDay">&nbsp;Date</label>
									<br><div id="errorShownForEmptySearch"  class="error"></div>
								</div>
								<div id="datetimepicker" name="timeConstraint" style="width: 50%; height: 40%"></div><br>
								 <span style="padding-left:10px"><input type="text" id="timecon" name="timecon" value="<?php echo set_value('timecon',$dayconstraint); ?>"/></span>
							</div>
							<div class="col-md-5">
								<input type="submit" id="searchBtn" class="btn btn-main btn-lg" value="Search" >
								<div id="totalRowNum"  style="display: none"> <?php echo $totalRow?> events are found!</div>
							</div>
						</div>
						<?php echo form_close(); ?>

						<?php
						if($eventList==false){?>
							<div style="color: red; font-size: 16px">
								<div class="col-md-5">
								</div>

								<div class="col-md-7">
									<b>No Events Found!</b>
								</div>
							</div>
							<?php
						}else{ ?>
							<?php
							foreach($eventList as $event){ ?>
								<?php
								$eventtimestamp = strtotime($event->event_datetime);
								$eventdate = date('l, M d,  Y', $eventtimestamp);
								$eventtime = date('h:i A',$eventtimestamp);
								?>

								<div class="row mb90">
									<div class="col-md-2"></div>
									<div class="col-md-3">
										<div class="cal-date" style="font-size: large"><?=$eventdate?></div><div class="cal-date" style="font-size:large"><?=$eventtime?></div>
										<br/>
										<a href="<?php echo base_url(); ?>index.php/EventDetail?event=<?php echo $event->event_id;?>"><button class="btn btn-main btn-lg" >Join us</button></a>
									</div>

									<div class="col-md-5">
										<div class="list-group">
											<a  class="list-group-item">
												<h4 class="list-group-item-heading"><?php echo $event->book_title; ?></h4>
											</a>
											<a  class="list-group-item">
												<h4 class="list-group-item-heading"> <?php echo $event->venue_address; ?></h4>
											</a>
											<a  class="list-group-item">
												<h4 class="list-group-item-heading"> <b style="color:dodgerblue;"><?php echo $event->listener_count; ?> </b> participants are going!</h4>
											</a>
										</div>
									</div>
									<div class="col-md-2"></div>

								</div>
								<?php
							}
						}
						?>


						<div id="pagination_div">

							<!-- Show pagination links -->

							<div style="color: red; font-size: 16px">


								<div class="col-md-5">
								</div>

								<div class="col-md-7">
									<b><?php echo $links; ?></b>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div> <input id="hiddenLocation" type="hidden"></div>
		</section>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login using Facebook</h4>
      </div>
      <div class="modal-body">
        <p>Login to access additional features</p>
      <fb:login-button size="large" scope="public_profile,email" autologoutlink="true" onlogin="checkLoginState();">
        </fb:login-button>

      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>


</body>

<script src="<?php echo base_url(); ?>js/facebook-login-home.js"></script>

<script type="text/javascript">
            $('#loginbutton').click(function(){
    //Some code
    $('#myModal').modal('show');
    
});

</script>

 <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-572dc484ab78ed09"></script>


<!--Java Script for search for location. The following code is adapted from google map sample code-->
<script>

	$(function(){
		$(window).keydown(function(e) {
			if (e.which == 13|| e.keyCode==13) {
				e.preventDefault();

				//test whether the address is valid
//				var hiddenLoc= $('#hiddenLocation').val();
//				var loc = $('#searchKeyword').val();
//				if(hiddenLoc.trim()!==loc.trim()){
//					$('#errorShownForEmptySearch').text("Opps! Please type in a valid address in Australia!");
//				}
				return false;
			}
		});

//		$( "#searchKeyword" ).blur(function() {
//			$('#errorShownForEmptySearch').empty();
//		});
	});



	function initMap() {
		var input = document.getElementById('searchKeyword');
		var autocomplete = new google.maps.places.Autocomplete(input,{componentRestrictions: {'country':'au'}});
		autocomplete.addListener('place_changed', function() {
			var placeChange = autocomplete.getPlace();
//			$('#hiddenLocation').val(placeChange.formatted_address);
			$('#searchKeyword').val(placeChange.formatted_address);
			if (!placeChange.geometry) {
//				$('#errorShownForEmptySearch').text('Opps! Please type in a valid address in Australia!');
				return;
			}
		});
	}
</script>

<script type="text/javascript">
	//The following function handles search results display functionality.
	$(function () {
	//search result
		<?php if(isset($_SESSION['isClicked'])){ ?>
			$("#totalRowNum").removeAttr("style");
		<?php
		} ?>

// date picker handler
		var nowDate = new Date();
		//var today = new Date(nowDate.getFullYear(),nowDate.getMonth(),nowDate.getDate(),nowDate.getHours(),nowDate.getMinutes(),0,0,0,0,0,0);

		$('#datetimepicker').datepicker({

			inline: true,
			sideBySide: true,
			format : 'YYYY-MM-DD',
			useCurrent:false,
			startDate : "today",
			todayHightlight:true

		}).on("changeDate", function (e) {
			var date = $('#datetimepicker').datepicker('getDate');
			var formatted = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() ;
			$('#timecon').val(formatted);
			$('#datetimepicker').hide();
		});

	});

	//initial setting of checkbox,calendar, and searchbox
	$('#datetimepicker').hide();
	$('#timecon').hide();
	$('#searchKeyword').hide();


	//calendar change
	//test whether the box is checked
	$('#calendarDay').change(function(){

		this.checked ? $('#datetimepicker').show() : $('#datetimepicker').hide();
		this.checked ? $('#timecon').show() : $('#timecon').hide();
	});
	$('#location').change(function(){
		this.checked ? $('#searchKeyword').show() : $('#searchKeyword').hide();
	});

	<!--test whether the box is ticked-->
	$('#searchBtn').click(function(){

		$('#errorShownForEmptySearch').empty();

		//test whether the address is valid
//		var hiddenLoc= $('#hiddenLocation').val();
//		var loc = $('#searchKeyword').val();
//		if(hiddenLoc.trim()!==loc.trim()){
//			$('#errorShownForEmptySearch').text("Opps! Please type in a valid address in Australia!");
//			return false;
//		}else{
//
//		}

		var isLocationChecked = $('#location').is(":checked");
		var isCalendarChecked = $('#calendarDay').is(":checked");
		console.log(isCalendarChecked+" cal- loc "+isLocationChecked);
		if(isCalendarChecked==false && isLocationChecked==false){
			$('#errorShownForEmptySearch').text("Please choose search criteria!");
//			alert("Please choose search criteria!");
			return false;
		}else if(isCalendarChecked && ($('#timecon').val().length===0 || $('#timecon').val()==="")&&isLocationChecked==false){
			$('#errorShownForEmptySearch').text("Please choose a day from calendar!");
			return false;
		}else if(isLocationChecked && ($('#searchKeyword').val().length==0 || $('#searchKeyword').val()==="")&& isCalendarChecked==false){
			$('#errorShownForEmptySearch').text("Please fill in an event location search key word!");
			return false;
		}else if(isLocationChecked && ($('#searchKeyword').val().length==0||$('#searchKeyword').val()==="") && isCalendarChecked && ($('#timecon').val().length==0|| $('#timecon').val()==="")){
			$('#errorShownForEmptySearch').text("Please fill in an event location and choose an event time to search for events!");
			return false;
		}else if(isLocationChecked&& isCalendarChecked && $('#searchKeyword').val().length==0){
			$('#errorShownForEmptySearch').text("Please fill in an event location search key word!");
			return false;
		} else if(isLocationChecked&& isCalendarChecked && $('#timecon').val().length==0){
			$('#errorShownForEmptySearch').text("Please choose a day from calendar!");
			return false;
		} else{
			<?php $_SESSION['isClicked']=true;?>
		}
	});
	//when input field is clicked calendar will pop up
	$( "#timecon" ).focus(function() {
		$('#datetimepicker').show();
	});



</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5TakWG01jiw1zbX45fpO28EnmJWtMoR8&libraries=places&callback=initMap"
		async defer></script>




