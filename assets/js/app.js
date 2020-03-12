import React from 'react';
import ReactDOM from 'react-dom';
import '../css/app.css';
import {Provider} from 'react-redux'

import configureStore from "./app/state/store";
import Layouts from "./app/views/layouts/Layouts";

const store = configureStore({});

ReactDOM.render(<Provider store={store}>
        <Layouts/>
    </Provider>
    , document.getElementById('root'));