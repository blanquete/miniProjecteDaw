import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-analytics.js";

const firebaseConfig = {
  apiKey: "AIzaSyAtX1hJLVhwH1rGqkrhxzUOYVcBvjslxoU",
  authDomain: "teacher-help-8cb3b.firebaseapp.com",
  databaseURL: "https://teacher-help-8cb3b-default-rtdb.europe-west1.firebasedatabase.app",
  projectId: "teacher-help-8cb3b",
  storageBucket: "teacher-help-8cb3b.appspot.com",
  messagingSenderId: "3470680706",
  appId: "1:3470680706:web:79c5205a6aa6e8ce928a9b",
  measurementId: "G-004RSLKK8W"
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);