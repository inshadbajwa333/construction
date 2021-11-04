  // Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
  apiKey: "AIzaSyDdJ9TuNHgp6AcbNiEHsXWdXsusX14Deaw",
    authDomain: "s2r-app.firebaseapp.com",
    databaseURL: "https://s2r-app.firebaseio.com",
    projectId: "s2r-app",
    storageBucket: "s2r-app.appspot.com",
    messagingSenderId: "426111712801",
    appId: "1:426111712801:web:47c4975011082637eeed60",
    measurementId: "G-TXC0C9DKQX"

});

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});

