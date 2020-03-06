import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';
import '../css/app.css';
import Template from "./modules/Template";
import Login from "./modules/Login";
import Registration from "./modules/Registration";
import {Provider} from 'react-redux'
import {applyMiddleware, combineReducers, createStore} from "redux";
import thunk from "redux-thunk";
import newsReducer from "./reducers/newsReducer";
import categoryReducer from "./reducers/categoryReducer";

const store = createStore(combineReducers({news: newsReducer, categories: categoryReducer}), applyMiddleware(thunk));
ReactDOM.render(<Provider store={store}>
        < Router>
            <Switch>
                <Route path={'/login'}><Login /></Route>
                <Route path={'/registration'}><Registration /></Route>
                <Route path={'/'}>< Template/></Route>
            </Switch>
        </Router>
    </Provider>
    , document.getElementById('root'));