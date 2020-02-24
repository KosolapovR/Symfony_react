import React, {Component} from 'react';

import {Box, Paper, Typography} from "@material-ui/core";
import {makeStyles} from "@material-ui/core/styles";

const useStyles = makeStyles({
    root: {
        height: '200px',
        backGround: 'red'
    }
});

let Home = () => {

    const classes = useStyles();
    return (
        <Box className={classes.root}>
            <Paper className={classes.root}>
                <Typography>
                    Hello mui1
                </Typography>
            </Paper>
        </Box>
    )
}

export default Home;