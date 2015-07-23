/**
 * User: Vedran Stankovic <email@vedranstankovic.com>
 * Date: 2012.12.01
 * Time: 10:56
 */


 // Additional JS functions here
 window.fbAsyncInit = function() {
 FB.init({
 appId      : '146722825539088', // App ID
 channel : true, // Channel File
// channelUrl : '//www.trendbal.loc/channel.html', // Channel File
 channelUrl : '/fballow.php', // Channel File
 status     : true, // check login status
 cookie     : true, // enable cookies to allow the server to access the session
 xfbml      : true,  // parse XFBML

 frictionlessRequests: true,
 init: true,
 //level: "debug",
 signedRequest: null,
 status: true,
 trace: false,
 version: "mu",
 viewMode: "website",
 autoRun: true
 });

 // Additional init code here

 };

 // Load the SDK Asynchronously
 (function(d){
 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement('script'); js.id = id; js.async = true;
 js.src = "//connect.facebook.net/en_US/all.js";
 ref.parentNode.insertBefore(js, ref);
 }(document));

 function login() {
     FB.login(function(response) {
         if (response.authResponse) {
             // connected
             proceed2site();
         } else {
            // cancelled
             alert('You\'ve canceled facebook registration/login.');
         }
     }, {scope: 'email,user_birthday'});
 }
 function proceed2site() {
     FB.api('/me', function(response) {
         
         $.post('/welcome/loginfb',
             response
             , function(data){
             	 /*
                 console.log(data);
                 if(data='ok') {
                     location.reload();
                 }else{
                     alert('An error occured during registration. Please try again.');
                 }
                 */
                 //window.location.reload(true);
                 alert('Good to see you, ' + response.name + '. You are now logged in.');
				 //console.log(response);
				 location.reload();       
             }, 'json');
             
          
         
     });
 }
 
  var fblogin =  document.getElementById('fb-login');
  if (typeof(fblogin) != 'undefined' && fblogin != null)
  {
    fblogin.onclick = function() {
	     FB.getLoginStatus(function(response) {
	         if (response.status === 'connected') {
	         // connected
	             login();
	         } else if (response.status === 'not_authorized') {
	             // not_authorized
	             login();
	         } else {
	             // not_logged_in
	             login();
	         }
	     });
	 };
  }
 
 var fbregister =  document.getElementById('fb-register');
 if (typeof(fbregister) != 'undefined' && fbregister != null)
 {
	fbregister.onclick = function() {
	 	 alert('This would register new user in real life application. It would store information in db.')
	     FB.getLoginStatus(function(response) {
	         if (response.status === 'connected') {
	         // connected
			 	login(); //removed in real life application
	         } else if (response.status === 'not_authorized') {
	             // not_authorized
	             login();
	         } else {
	             // not_logged_in
	             login();
	         }
	     });
	 };	 
 }
 
 
