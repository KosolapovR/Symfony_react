import React from 'react';
import {Box, Container, Button, AppBar, Grid, Typography, Toolbar, Hidden, TableFooter} from "@material-ui/core";
import {makeStyles} from "@material-ui/core/styles";
import Footer from "./footer/Footer";
import MainPage from "./mainPage/MainPage";
import IconButton from "@material-ui/core/IconButton";
import MenuIcon from '@material-ui/icons/Menu';
import TopMenu from "./topMenu/TopMenu";

const useStyles = makeStyles({
    root: {
        minHeight: 'calc(100vh - 56px)',
    },
    main: {
        minHeight: '100%',
    },
    l_bar: {
        backgroundColor: 'red',
        minHeight: 'calc(100% - 56px)'
    },
    r_bar: {
        backgroundColor: 'green',
        minHeight: 'calc(100% - 56px)'
    },
    content: {
        minHeight: 'calc(100vh - 112px)'
    },
    footer: {
        position: 'fixed',
        bottom: '0px',
        left: '0px'
    }
});

function Template(props) {

    const classes = useStyles();

    return (
        <Box className={classes.root}>
            <TopMenu/>
            <Container maxWidth={'lg'}>
                <Grid container justify={'space-between'} className={classes.main}>
                    <Hidden smDown>
                        <Grid className={classes.l_bar} item md={2}>
                            <Typography>
                                l_bar
                            </Typography>
                        </Grid>
                    </Hidden>
                    <Grid className={classes.content} item xs={12} md={6}>
                        <MainPage/>
                    </Grid>
                    <Hidden smDown>
                        <Grid className={classes.r_bar} item md={2}>
                            <Typography>
                                r_bar
                            </Typography>
                        </Grid>
                    </Hidden>
                </Grid>
            </Container>
            <Footer className={classes.footer}/>
        </Box>
    );
}

export default Template;