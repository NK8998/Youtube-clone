<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyD_qWadOXn0U1UHae7xHhzARsLYwmliguk",
    authDomain: "yt-db-7a472.firebaseapp.com",
    databaseURL: "https://yt-db-7a472-default-rtdb.firebaseio.com",
    projectId: "yt-db-7a472",
    storageBucket: "yt-db-7a472.appspot.com",
    messagingSenderId: "193352771010",
    appId: "1:193352771010:web:0fbbf0a6cbed07b503e25b",
    measurementId: "G-4XRVX485WM"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>