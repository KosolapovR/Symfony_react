import React from 'react';
import {Box, Paper, Typography, Button} from "@material-ui/core";
import {makeStyles} from "@material-ui/core/styles";

const useStyles = makeStyles({
    root: {
        padding: '10px',
        marginTop: '20px'
    },
    button: {
        marginTop: '20px'
    }
});

const MainPage = () => {

    const  classes = useStyles();

    return (
        <Box>
            <Paper className={classes.root} elevation={3}>
                <Typography variant={'h5'}>
                    Записаться сейчас!
                </Typography>
                <Typography variant={'body'}>
                    Вы можете записаться на прием к интересующему Вас специалисту уже сейчас!
                </Typography>
            </Paper>

            <Button className={classes.button} variant={"contained"} color={'primary'} size={'large'}>
                Записаться
            </Button>
        </Box>
    );
};

export default MainPage;