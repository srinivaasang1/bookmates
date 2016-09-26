
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      //document.getElementById('status1').innerHTML = 'Please log ' +'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      //document.getElementById('status1').innerHTML = 'Please log ' +'into Facebook.';
        //window.location = "http://localhost:8888/gravityGittheme-wrk/index.php/Loginredirect"; /* Redirect browser */
      console.log(response);
      $('#loginbutton').text('Login');
//exit();
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '245770892439071',//'1061149990611913',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  /*function fb_login()
  {

    FB.login(function(response) {
   if (response.authResponse) {
     console.log('Welcome!  Fetching your information.... ');
                    window.location = "http://localhost:8888/gravityGittheme-wrk/index.php/AddEvent"; /* Redirect browser */

    /* FB.api('/me', function(response) {
       console.log('Good to see you, ' + response.name + '.');


       FB.logout(function(response) {
         console.log('Logged out.');
       });
     });
   } else {
     console.log('User cancelled login or did not fully authorize.');
   }
 }, {scope: 'email'});
  }*/

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{ locale: 'en_US', fields: 'name, email,first_name,last_name' }, function(response) {
      $('#loginbutton').text(response.first_name );//' '+ '\u25bc');
      //console.log('Successful login for: ' + response.name);
      //console.log(response);
      //document.getElementById('status1').innerHTML ='Thanks for logging in, ' + response.name + '!';
            //document.getElementById("reader_name").value = response.name;
            //document.getElementById("reader_email").value = response.email;
                  //console.log(response.email);
                  //window.location = "http://localhost:8888/gravityGittheme-wrk/index.php/AddEvent";
                  $('#myModal').modal('hide');
    });
  }
