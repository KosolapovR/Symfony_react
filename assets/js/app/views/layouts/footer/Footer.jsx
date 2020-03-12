import React from 'react';
import {Container, Hidden, BottomNavigation, BottomNavigationAction} from "@material-ui/core";
import BottomNav from "./bottomNav/BottomNav";

const Footer = () => {
    return (
        <Container maxWidth={'lg'}>
            <Hidden smUp>
                <BottomNav/>
            </Hidden>
            <Hidden smDown>
                    DesctopFooter
            </Hidden>
        </Container>
    );
};

export default Footer;