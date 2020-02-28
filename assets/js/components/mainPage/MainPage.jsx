import React, {useEffect} from 'react';
import {Box, Paper, Typography, Button} from "@material-ui/core";
import {makeStyles} from "@material-ui/core/styles";
import {connect} from 'react-redux';

const useStyles = makeStyles({
    root: {
        padding: '10px',
        marginTop: '20px'
    },
    button: {
        marginTop: '20px'
    }
});

const MainPage = (props) => {

    //useEffect(() => {props.getPosts()}, []);

    //console.log(props);
    const classes = useStyles();

    return (
        <Box>
            <Paper className={classes.root} elevation={3}>
                <Typography variant={'h5'}>
                    Записаться сейчас!
                </Typography>
                <Typography variant={'body1'}>
                    Вы можете записаться на прием к интересующему Вас специалисту уже сейчас!
                </Typography>
            </Paper>

            <Button className={classes.button} variant={"contained"} color={'primary'} size={'large'}>
                Записаться
            </Button>
        </Box>
    );
};

const mapStateToProps = (state) => ({
    state
});

const mapDispatchToProps = (dispatch) => {
    return {
        getPosts: () => {
            dispatch(getAllPosts());
        }
    }
}
;

export default connect(mapStateToProps, mapDispatchToProps)(MainPage);