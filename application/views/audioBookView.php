
<!--    <body data-spy="scroll" data-target=".main-nav">-->

<link href="<?php echo base_url(); ?>css/bootstrap3_player.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/bootstrap-image-gallery.min.css" rel="stylesheet">
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-image-gallery.min.js"></script>



<script src="<?php echo base_url(); ?>js/bootstrap3_player.js"></script>


<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">AUDIO BOOK</h2>

            </div>
        </div>
        <br/>
        <div class="row">
            <p align="justify">

                There are four important skills in language learning; reading, listening, writing and speaking. Participating in a BookMates event will help improve your reading, listening and speaking skills. We understand that it can be intimidating to read in front of a crowd, either big or small, especially when you are still in the early stages of learning the language. Practice is key when learning a new language. In order to help you improve, we have provided some materials you can use to practice.
            </p>

            <p align="justify">
                Listen to the audiobooks while following the read in the provided e-book. By doing this, you will know how each word is pronounced and the places to stop when reading. You will also learn how to read in a way that will engage your listeners by applying the correct intonations.

            </p>

        </div>
    </div>
</section>



<div class="container" id="ebooks">
<div class="row">
  <div class="col-md-2">
          <a href="http://service.overdrive.com/GUTENBERG/ebooks/mcgill/epub/730?flags=1">


          <img class="img-responsive" src="<?php echo base_url(); ?>img/olivertwist.jpg" title="Click here to download Oliver Twist ebook" >
      </a>


  </div>

    <div class="col-md-2">
       <h4> Oliver Twist </h4>
        <p >
            The story of Oliver Twist, a young orphan boy living in England. The second novel written by Charles Dickens.

        </p>




</div>



    <div class="col-md-2">



        <a href="http://service.overdrive.com/GUTENBERG/ebooks/mcgill/epub/1524?flags=1">

        <img class="img-responsive" src="<?php echo base_url(); ?>img/hamlet.jpg" title="Click here to download Hamlet ebook" >
        </a>


    </div>
    <div class="col-md-2">

     <h4>   Hamlet</h4>
        <p>
            A play written by William Shakespeare about the tragedy of the Prince of Denmark, Hamlet.

        </p>




    </div>


    <div class="col-md-2">
        <a href="http://service.overdrive.com/GUTENBERG/ebooks/mcgill/epub/580?flags=1">

        <img class="img-responsive" src="<?php echo base_url(); ?>img/pickwick.jpg" title="Click here to download The Pickwick Papers ebook" >

          </a>


        </div>

    <div class="col-md-2">
      <h4>  The Pickwick Papers</h4>
        <p >
            The first novel by Charles Dickens about the adventures of Mr Samuel Pickwick and members of the Pickwick Club.

        </p>





    </div>

</div>

    <div class="row">

        <div class="col-md-4">
            <audio controls>
                <source src="<?php echo base_url(); ?>audio/dickens_oliver_twist_01_64kb.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
            <br>


        </div>


        <div class="col-md-4">

            <audio controls>
            <source src="<?php echo base_url(); ?>audio/hamlet_act1_shakespeare_64kb.mp3" type="audio/mp3">
                Your browser does not support the audio element.

            </audio>
            <br>


        </div>


        <div class="col-md-4">

            <audio  controls>
            <source src="<?php echo base_url(); ?>audio/pickwickpapers_01_dickens_64kb.mp3" type="audio/mp3">
                Your browser does not support the audio element.

                </audio>
            <br>


        </div>


</div>

    </div>

<div class="container" id="hotbooks">

    <div class="col-lg-12 text-center">
        <h2 class="section-heading">HOT BOOKS</h2>

    </div>

    <div class="row">
        <p align="justify">
            Still don't know what to read? Check our hot books from <a href="https://data.sa.gov.au/data/dataset/top-40-book-club-reads-brisbane-city-council">Brisbane City Council</a>.

        </p>





        <div id="blueimp-gallery" class="blueimp-gallery">
            <!-- The container for the modal slides -->
            <div class="slides"></div>
            <!-- Controls for the borderless lightbox -->
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
            <!-- The modal dialog, which will be used to wrap the lightbox content -->
            <div class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body next"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left prev">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                                Previous
                            </button>
                            <button type="button" class="btn btn-primary next">
                                Next
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--<div class="row col-lg-6 col-lg-offset-3 text-center">-->
        <div class="row col-md-8 col-lg-offset-2" >

            <img src="<?php echo base_url(); ?>img/covers/allthatiam.jpg" title="All That I am" width="18%" class="img-responsive img-zoom">


            <img src="<?php echo base_url(); ?>img/covers/august.jpg" title="August" width="18%" class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/autumulaing.jpg" title="Autumu Laing" width="18%"class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/blackjesus.jpg" title="Black Jesus" width="18%" class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/beforeigotosleep.jpg" title="Before I Go To Sleep" width="18%"class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/catch22.jpg" title="Catch 22" width="18%" class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/fivebells.jpg" title="Five Bells" width="18%" class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/greatexpectations.jpg" title="Great Expectations" width="18%" class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/bereft.jpg" title="Bereft" width="18%" class="img-responsive img-zoom">
            <img src="<?php echo base_url(); ?>img/covers/delirium.jpg" title="Delirium" width="18%" class="img-responsive img-zoom">






            <!--                <img src="images/thumbnails/orange.jpg" alt="Orange">-->

</div>





    </div>



    </div>


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


<!--</body>-->

<script src="<?php echo base_url(); ?>js/facebook-login-home.js"></script>

<script type="text/javascript">
            $('#loginbutton').click(function(){
    //Some code
    $('#myModal').modal('show');
    
});

</script>

<script>
    $(document).ready(function(){
        $('.img-zoom').hover(function() {
            $(this).addClass('transition');

        }, function() {
            $(this).removeClass('transition');
        });
    });
</script>
