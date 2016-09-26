
<style>
        .error {
            color:red;
            font-size:13px;
            margin-bottom:-15px;
        }
        .scrollable-menu {
            height: auto;
            max-height: 200px;
            overflow-x: hidden;
        }
        .paraborder
        {
            background-color: #0077CC;
            color: white;
            border-radius: 8px;
            padding: 5px;
        }
        .bookdetails
        {
            display: none;
        }
        .bookdrop
        {
            display: none;
        }
    </style>
<link href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Bootstrap -->

    <script src="<?php echo base_url(); ?>js/placesearch.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.js"></script>


<!--<body data-spy="scroll" data-target=".main-nav">-->
<!-- Add Event form -->


<section id="addEvent">

    <h2 class="create-form-heading">PUBLISH AN EVENT</h2>
    <div class="form-center">
        <?php echo form_open('AddEvent/submission',array('id'=>'addForm')); ?>

 <div class="col-md-12 col-md-offset-2">

        <div class="form-group ">

            <label for="time" id="timeLabel">Event Time</label>

            <div class="row">
                <div class='col-sm-8'>
                    <!--                <input type="" name="time" id="time"/>-->
                    <input type='text' class="form-control" id='datetimepicker4' name="time" value=""/>

                </div>

            </div>

        </div>

        <div class="form-group">

            <label for="title" id="titleLabel">Book Title</label>
            <div class="row">
                <div class='col-sm-8' >
                    <div class="input-group">
                        <input type="text" class="form-control"  value="<?php echo set_value('title'); ?>" name="title" id="title" placeholder="Type a book title to search! "/>
                        <div class="error" id="mismatchedTitle"> </div>

            <span class="input-group-addon" type="search" id="search" >
                <i class="fa fa-search"></i>
            </span>
                    </div>

                </div>

            </div>

            <div id="result"></div>

            <div class="dropdown bookdrop" id="dropbook">
                <br/>
                <button style="display:none;" class="btn btn-primary dropdown-toggle" type="button" id ="selectbook" data-toggle="dropdown">Select the book
                    <span class="caret"></span></button>
                <ul class="dropdown-menu scrollable-menu" id="list1">
                </ul>
            </div>
            <br/>
            <div id="bookdet" class="bookdetails">

                <table>
                    <tr><td rowspan="4"><img id ="coverimg"src=""></td><td style="padding-left: 10px"><span>Title:</span><b><span id="titlep" ></span></b></td></tr>
                    <tr><td style="padding-left: 10px"><span>Author:</span><b><span id="authorp" ></span></b></td></tr>
                    <tr><td style="padding-left: 10px"><span>Publish Date:</span><b><span id="pubp" ></span></b></td></tr>
<!--                    <tr><td style="padding-left: 10px"><span>ISBN: &nbsp</span><span id="isbnp" ></span></td></tr>-->
                </table>
            </div>
            <input type="hidden" name="isbnName" id="hiddenisbn"/>
            <input type="hidden" name="titleName" id="hiddenTitle"/>
        </div>

        <div class="form-group">
            <div class="row">
                <div class='col-sm-8'>
                    <label for="name" id="nameLabel">Reader Name:</label>
                    <input type="text" class="form-control" value="<?php echo set_value('name'); ?>" name="name" id="reader_name" readonly="readonly"/>
                </div>

            </div>
        </div>



        <div class="form-group">
            <div class="row">
                <div class='col-sm-8'>

                    <label for="email" id="emailLabel">Reader Email:</label>
                    <input type="email" class="form-control" value="<?php echo set_value('email'); ?>" name="email" id="reader_email" readonly="readonly"/>
                </div>

            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <div class='col-sm-8'>
                    <label for="location" id="locationLabel">Reading Event Venue:</label>
                    <input type="text" class="form-control" value="<?php echo set_value('location'); ?>" name="location" id="venue_addr"/>
                    <div class="error" id="mismatchedLocation"> </div>
                </div>

            </div>
            <div class="col-sm-4"><input type="hidden" name="locationName" id="hiddenLocation"/></div>
            <div class="col-sm-4"><input type="hidden" name="hiddenUserid" id="hiddenUserid"/></div>
        </div>
        <br>




        <div id="map" class="hidden-sm visible-lg" style="width:66%;height:380px;"></div>


        <br>


<!--        <div class="g-recaptcha" data-sitekey="6Lf8fBwTAAAAALzM4jjO91ZmSkL70WE45od4qNkl"></div>-->

        <!--    <div class="g-recaptcha" data-sitekey="6Lf8fBwTAAAAALzM4jjO91ZmSkL70WE45od4qNkl"></div>-->
        <!--    <br/>-->

        <button type="submit" class="btn btn-main btn-lg" id="submitEventBtn" value="Submit" >Publish</button>
        <h4 id="submitSuccess" style="color: #00a9fe"></h4>
        <br>
    </div>
    </div>
</section>





<br>

<!--    facebook login js import-->
    <script src="<?php echo base_url(); ?>js/facebook-login.js"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-572dc484ab78ed09"></script>


<!--AJAX for search book by title-->
<script type="text/javascript">
    // Ajax post search for book
    $(document).ready(function () {
        //prevent key press from repsonding to submission
        $('#title').keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        //get book detail by title query upon clicking search
        $("#search").click(function (event) {
            event.preventDefault();
            var booky = $("input#title").val().split(" ").join("");
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/AddEvent/user_data_submit",
                dataType: 'json',
                data: {booktitle1: booky},
                success: function (res) {
                    //$("div#people").html("");
                    $("#list1").html("");

                    if (res) {
                        for (var i = 0; i < res.length; i++) {
                            $("#list1").append('<li><table><tr><td><img id ="imglink" src="' + res[i]['volumeInfo']['imageLinks']['thumbnail'] + '" height="65px" width="65px"/></td><td style="padding-left: 10px"> Title: <span id ="tits1"> <b>' + res[i]['volumeInfo']['title'] +
                                '</b></span><br/>Publish Date: <span id="pubyearid"><b> '+res[i]['volumeInfo']['publishedDate']+'</b></span><span style="display:none;" id="isbnid"><b>' + res[i]['id'] + '</b></span><br/> Author: <span id="authorid"> <b>' + res[i]['volumeInfo']['authors'] + '</b></span></td></tr></table></li><br/>')
                        }
                    }
                }
            });
            $('.bookdrop').css("display","block");
        });
        $('#list1').on('click','li', function ()
        {
            $("#title").html("");
            //var selected = $(this).text();
            $('.bookdetails').css("display","block");

            var imgsrc = $(this).find("#imglink").attr('src');
            //alert("List Item: " + selected);
//            $("#titlelabel").text($(this).find("#tits1").text());
            $('#coverimg').attr('src',imgsrc);
            $("#titlep").text($(this).find("#tits1").text());
            $("#authorp").text($(this).find("#authorid").text());
            $("#pubp").text($(this).find("#pubyearid").text());
            $("#isbnp").text($(this).find("#isbnid").text());

            $('#hiddenisbn').val($(this).find("#isbnid").text());
            $('#hiddenTitle').val($(this).find("#tits1").text());
//           title input box
            $('#title').val( $(this).find("#tits1").text());

//
        });
    });
</script>


<!--This is the script to capture the selected book title and display it in the title text box -->

<script>
    //clear the text
    function clearErrorMsg(){
        $('.error').html("");
    }
    //ajax submit form validation
    $(document).ready(function(){
        $('#addForm').submit(function(){
//
            $.ajax({
                url:'<?php echo base_url();?>index.php/AddEvent/submission',
                type:'POST',
                data:$(this).serialize(),
                dataType:'json',
                success:function(data){
                    clearErrorMsg();
                    var json = data;

                    if(json['time'] !=null){
                        $('#timeLabel').append("<h4>"+json['time']+"</h4>");
                        $('#titleLabel').append("<h4>"+json['title']+"</h4>");
                        $('#locationLabel').append("<h4>"+json['location']+"</h4>");
                        $('#nameLabel').append("<h4>"+json['name']+"</h4>");
                        $('#emailLabel').append("<h4>"+json['email']+"</h4>");
                        return false;

                    }else{
                        //test if title matches the title selected from catalogue
                        var hiddenTitle = $('#hiddenTitle').val();
                        var title=$('#title').val();
                        var hiddenLocation = $('#hiddenLocation').val();
                        var location = $('#venue_addr').val();
                        if(hiddenTitle.trim()!=title.trim()){
                            $('#mismatchedTitle').text('The book title you type in must be consistent with the one you selected!');
                            return false;
                        }
                        //test if location matches the location selected from google map list
                        if(hiddenLocation.trim()!==location.trim()){
                            $('#mismatchedLocation').text("Opps! Please type in a valid address in Australia!");
                            return false;
                        }
//                        clearInputText();
//                        $('#submitSuccess').html("<h4>"+json['success']+"</h4>");
                        window.location.href = "<?php echo base_url(); ?>index.php/SuccessMessage";
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

<!--Get date picker-->
<script type="text/javascript">
    $(function () {
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(),nowDate.getMonth(),nowDate.getDate(),nowDate.getHours(),nowDate.getMinutes(),0,0,0,0,0,0);
        $('#datetimepicker4').datetimepicker(
            {
                sideBySide: true,
                format : 'YYYY-MM-DD HH:mm',
                minDate:today,
                useCurrent:false
            }
        );
    });
</script>

<!--Trigger drop down list by clicking search book title-->
<script type="text/javascript">

    $(document).ready(function() {
        $("#search").bind("click", (function () {
            setTimeout(function () {
            $("#selectbook").trigger("click");

            }, 10);
        }));
    });
</script>


<!--login detail-->
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
       <!-- <img src="<?php echo base_url(); ?>img/facebook-login-button.png" onclick="fb_login()" />-->

      </div>
      <div class="modal-footer" id="modalfooter">
      <a href="<?php echo base_url();?>"><button type="button" class="btn btn-default">Back to Home</button></a>
      </div>
    </div>

  </div>
</div>


<!--<script async defer-->
<!--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5TakWG01jiw1zbX45fpO28EnmJWtMoR8&libraries=&callback=initMap"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5TakWG01jiw1zbX45fpO28EnmJWtMoR8&libraries=places&callback=initMap"
        async defer></script>


<!--</body>-->
