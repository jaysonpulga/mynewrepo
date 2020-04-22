<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>


<script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
<script async defer src="https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js"></script>






<div 
class="fb-messengermessageus" 
messenger_app_id="2230078753719065"  
page_id="302128473786839" 
color="blue" 
size="large" 
></div>

 


<div class="fb-send-to-messenger" 
  messenger_app_id="2230078753719065" 
  page_id="302128473786839" 
  data-ref="" 
  color="blue" 
  size="large">
</div>




<script>
	var finished_rendering = function() {
  console.log("finished rendering plugins");
}

  window.fbAsyncInit = function() {
    FB.init({
      appId            : '2230078753719065',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.2'
    });
	
	  FB.Event.subscribe('send_to_messenger', function(e) {
      // callback for events triggered by the plugin
				console.log('testko');
      });

		FB.Event.subscribe('send_to_messenger', finished_rendering);
	
  };
</script>






<!--
<div class="fb-messenger-checkbox"  
  origin="https://primzen.com"
  page_id="302128473786839"
  messenger_app_id="2230078753719065"
  user_ref="12345"
  allow_login="false"
  size="large"
  skin="dark"
  center_align="true">
</div>
-->


<?php $random_val=rand(100000,999999);?>

<script>




window.fbAsyncInit = function() {
    FB.init({
        appId      : '2230078753719065',
        xfbml      : true,
        version    : 'v2.6'
    });
	
	


    FB.Event.subscribe('messenger_checkbox', function(e) {
        console.log("messenger_checkbox event");
        console.log(e);

        if (e.event == 'rendered') {
            console.log("Plugin was rendered");
        } else if (e.event == 'checkbox') {
            var checkboxState = e.state;
            console.log("Checkbox state: " + checkboxState);
        } else if (e.event == 'not_you') {
            console.log("User clicked 'not you'");
        } else if (e.event == 'hidden') {
            console.log("Plugin was hidden");
        }
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk')
);





function confirmOptIn() {
	
	


	
	
	
    FB.AppEvents.logEvent('MessengerCheckboxUserConfirmation', finished_rendering, {
        'app_id':'2230078753719065',
        'page_id':'302128473786839',
        'ref':'facebook_messenger_api',
        'user_ref':'<?php echo $random_val?>'
    });
}
</script>      



<div class="fb-messenger-checkbox"
origin=https://primzen.com/azmproject/public/testkomunaito
page_id=302128473786839 
messenger_app_id=2230078753719065 
user_ref="<?php echo $random_val?>" 
prechecked="true" 
allow_login="true" 
size="large"> </div>









  <body>
    <input type="button" onclick="confirmOptIn()" value="Confirm Opt-in"/>
  </body>




<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2230078753719065',
      xfbml      : true,
      version    : 'v3.2'
    });

    FB.Event.subscribe('messenger_checkbox', function(e) {
      console.log("messenger_checkbox event");
      console.log(e);
      
      if (e.event == 'rendered') {
        console.log("Plugin was rendered");
      } else if (e.event == 'checkbox') {
        var checkboxState = e.state;
        console.log("Checkbox state: " + checkboxState);
      } else if (e.event == 'not_you') {
        console.log("User clicked 'not you'");
      } else if (e.event == 'hidden') {
        console.log("Plugin was hidden");
      }
      
    });
  }; 
</script>




<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="302128473786839">
</div>



<script>
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
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
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
      appId      : '2230078753719065', //2048079595212302
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.2' // The Graph API version to use for the call
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

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

</body>
</html>