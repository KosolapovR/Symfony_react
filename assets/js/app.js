import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router} from 'react-router-dom';
import '../css/app.css';
import Template from "./components/Template";
import {Provider} from 'react-redux'
import {applyMiddleware, combineReducers, createStore} from "redux";
import thunk from "redux-thunk";
import newsReducer from "./reducers/NewsReducer";
import categoryReducer from "./reducers/categoryReducer";

const store = createStore(combineReducers({news: newsReducer, categories: categoryReducer}), applyMiddleware(thunk));
ReactDOM.render(<Provider store={store}>
        < Router>
            < Template/>
        </Router>
    </Provider>
    , document.getElementById('root'));