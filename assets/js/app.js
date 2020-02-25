import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from 'react-router-dom';
import '../css/app.css';
import Template from "./components/Template";
import {Provider} from 'react-redux'
import {applyMiddleware, createStore} from "redux";
import thunk from "redux-thunk";
import postReducer from "./reducers/postReducer";

const store = createStore(postReducer, applyMiddleware(thunk));
ReactDOM.render(<Provider store={store}>
        < Router>
            < Template/>
        </Router>
    </Provider>
    , document.getElementById('root'));