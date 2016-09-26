
<!--Display successful information after joining an event-->

<br><br><br><br>
<section id="successMsg" style="height: 100%">
<div class="alert alert-success" style="height:600px; background-color: transparent;border-color: transparent"><h2 style="color:cornflowerblue; text-align:center" > Welcome! You have successfully joined the reading event!</h2>
    <br><br>
    <?php header("refresh:3; url=".base_url()."index.php/ListEvent"); ?>

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


