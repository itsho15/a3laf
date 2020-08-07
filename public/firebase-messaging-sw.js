/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyBvUmOtnTGD7EYTgCUkVufMdHm1fkOIy6I",
    authDomain: "a3laf-app.firebaseapp.com",
    databaseURL: "https://a3laf-app.firebaseio.com",
    projectId: "a3laf-app",
    storageBucket: "a3laf-app.appspot.com",
    messagingSenderId: "791431869550",
    appId: "1:791431869550:web:7060997d3fcacf1509e27f",
    measurementId: "G-C02RG5JT28"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});