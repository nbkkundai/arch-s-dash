import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries


// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBZdcbfJg6Kib_UMA0kgLDZARHpeC7o0rQ",
  authDomain: "my-database-a18a7.firebaseapp.com",
  databaseURL: "https://my-database-a18a7-default-rtdb.firebaseio.com",
  projectId: "my-database-a18a7",
  storageBucket: "my-database-a18a7.appspot.com",
  messagingSenderId: "1026970590237",
  appId: "1:1026970590237:web:e208d0f615aa79e8c3baf4",
  measurementId: "G-X3Z0G2RVSQ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
