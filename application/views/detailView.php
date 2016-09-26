<style>
<style>
    .error {
        color:red;
        font-size:13px;
        margin-bottom:-15px;
    }
</style>

<!-- Add event section
================================================== -->
<section id="eventdetail"><br><br><br><br>
<h2 class="create-form-heading">Event detail</h2>
<div class="container">
    <div class="row">
        <div class="col-md-10 ">
        <?php echo form_open('EventDetail/joinBtnPressed',array('id'=>'joinEventForm')); ?>

            <div class="list-group">
                <a  class="list-group-item ">
                    <h4 class="list-group-item-heading">Event Time: &nbsp; <?php
                        $eventtimestamp = strtotime($event->event_datetime);
                        $eventdate = date('l, M  d', $eventtimestamp);
                        $eventtime = date('h:i A',$eventtimestamp);

                        echo $eventdate; echo "&nbsp;";
                        echo $eventtime;
                        ?></h4>


                </a>
                <a  class="list-group-item">
                    <h4 class="list-group-item-heading">Reader's Name:&nbsp; <?php echo $event->name;?> </h4>
                </a>
                <a  class="list-group-item">
                    <h4 class="list-group-item-heading">Book Title:&nbsp;<?php echo $event->book_title; ?></h4>
                </a>
                <a  class="list-group-item">
                    <h4 class="list-group-item-heading">Reading Event Location:&nbsp;<?php echo $event->venue_address; ?></h4>
                </a>
            </div>
            </form>
        </div>


        <div  class="col-md-2 text-center">
            <button id="join_event_button" type="submit" style="position: relative; left: 10px" class="btn btn-main btn-lg" >
                <span style="font-size: large">JOIN</span></button>
            <br />
            <br />
            <div id="error"></div>
        </div>
    </div>

<div>
    <div class="col-md-1"></div>
    <div id="map" class=" row col-md-10 hidden-sm visible-lg " style="height:380px;"></div>
    <div class="col-md-1"></div>
</div>





    <div><input type="hidden" id="hidden_userid" name="hidden_userid"/></div>
</div>

</section>

<!--facebook login-->

<script src="<?php echo base_url(); ?>js/facebook-login-join-detail.js"></script>

 <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-572dc484ab78ed09"></script>


<script type="text/javascript">
    $('#loginbutton').click(function(){
        //Some code
        $('#myModal').modal('show');
    });
</script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="modalheader">
                <h4 class="modal-title">Login using Facebook</h4>
            </div>
            <div class="modal-body">
                <p>Login to access additional features</p>
                <fb:login-button size="large" scope="public_profile,email" autologoutlink="true" onlogin="checkLoginState();">
                </fb:login-button>
                <!-- <img src="img/facebook-login-button.png" onclick="fb_login()" />-->

            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
            </div>
        </div>

    </div>
</div>

<!--Get the location detail and pin point it in google map according to the address stored in event object-->
<script>
    var geocoder, map;
    var address = "<?php echo $event->venue_address;?>";
    function codeAddress() {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var myOptions = {
                    zoom: 15,
                    center: results[0].geometry.location,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                map = new google.maps.Map(document.getElementById("map"), myOptions);

                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            }
        });
    }
</script>

<div class="loader hidden" >




</div>

<!--detect whether the user has already joined the event before, if yes, disable join button, otherwise do nothing-->
<script>
    function clearErrorMsg(){
        $('.error').html("");
    }
    //ajax submit form validation
    $(document).ready(function(){
        $('#join_event_button').click(function(){
            var userid= $('#hidden_userid').val();
            if(userid.length==0){
                userid="dummyuserid";
            }
            console.log(userid+"****user id");
            $.ajax({
                url:'<?php echo base_url();?>index.php/EventDetail/joinBtnPressed',
                type:'POST',
                data:{hidden_userid:$('#hidden_userid').val()},
                dataType:'json',
                success:function(data){
                    clearErrorMsg();
                    if(data['joinError']!=null){
                        $('#error').text(data['joinError']);
                        $('#error').addClass("alert alert-info text-center error");
                        return false;
                    }else{
                        //alert(data['joinSuccess']);
                        window.location.href = "<?php echo base_url(); ?>index.php/JoinSuccess";
                    }
                },
                error: function( jqXhr ) {
                    if( jqXhr.status == 400 ) { //Validation error or other reason for Bad Request 400
                        console.log("Something went wrong!")
                    }
                }
            });
            return false;
        });
    });
</script>



<script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC5TakWG01jiw1zbX45fpO28EnmJWtMoR8&callback=codeAddress"></script>
