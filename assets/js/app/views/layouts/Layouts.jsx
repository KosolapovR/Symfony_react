import {BrowserRouter as Router, Route, Switch} from "react-router-dom";
import Login from "./login/Login";
import Registration from "./registration/Registration";
import Template from "./template/Template";
import React from "react";

const Layouts = () => {
    return (
        < Router>
            <Switch>
                <Route path={'/login'}><Login/></Route>
                <Route path={'/registration'}><Registration/></Route>
                <Route path={'/'}>< Template/></Route>
            </Switch>
        </Router>
    );
};

export default Layouts;