import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
// import './bootstrap.min.css';
import App from './App';
// import MyApp from './myApp';
import reportWebVitals from './reportWebVitals';
// import Mybutton from './mybutton';
// import MyState from './myState';
// import MyEffect from './myEffect';
// import MyTextForm from './myTextForm';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
    {/* <MyApp /> */}
    {/* <Mybutton /> */}
    {/* <MyState /> */}
    {/* <MyEffect /> */}
    {/* <MyTextForm /> */}
  </React.StrictMode>
);

// const myroot = ReactDOM.createRoot(document.getElementById('myroot'));
// root.render(
//   <React.StrictMode>
//     <myApp />
//   </React.StrictMode>
// );



// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
