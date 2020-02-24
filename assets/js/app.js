import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from 'react-router-dom';
import '../css/app.css';
import Home from './components/Home';
import Template from "./components/Template";

ReactDOM.render(< Router> < Template/> < /Router>, document.getElementById('root'));