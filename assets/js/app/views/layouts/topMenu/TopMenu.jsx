import React from 'react';
import {makeStyles} from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import IconButton from '@material-ui/core/IconButton';
import MenuIcon from '@material-ui/icons/Menu';
import AccountCircle from '@material-ui/icons/AccountCircle';
import MenuItem from '@material-ui/core/MenuItem';
import Menu from '@material-ui/core/Menu';
import {Collapse} from "@material-ui/core";
import {Link} from "react-router-dom";

const useStyles = makeStyles(theme => ({
    root: {
        flexGrow: 1,
    },
    menuButton: {
        marginRight: theme.spacing(2),
    },
    title: {
        flexGrow: 1,
    },
}));

export default function MenuAppBar() {
    const classes = useStyles();
    const [auth, setAuth] = React.useState(true);
    const [anchorEl, setAnchorEl] = React.useState(null);
    const open = Boolean(anchorEl);
    const [expand, setExpand] = React.useState(false);

    const handleMenu = () => {
        setExpand(!expand);
    };

    const handleMenuProfile = event => {
        setAnchorEl(event.currentTarget);
    };

    const handleClose = () => {
        setAnchorEl(null);
    };

    return (
        <div className={classes.root}>
            <AppBar position="static">
                <Toolbar>
                    <IconButton onClick={handleMenu} edge="start" className={classes.menuButton} color="inherit"
                                aria-label="menu">
                        <MenuIcon/>
                    </IconButton>
                    <Typography variant="h6" className={classes.title}>
                        <Link onClick={() => {
                            if (expand) handleMenu()
                        }} to='/news'>Новости</Link>
                    </Typography>
                    {auth && (
                        <div>
                            <IconButton
                                aria-label="account of current user"
                                aria-controls="menu-appbar"
                                aria-haspopup="true"
                                onClick={handleMenuProfile}
                                color="inherit"
                            >
                                <AccountCircle/>
                            </IconButton>
                            <Menu
                                id="menu-appbar"
                                anchorEl={anchorEl}
                                anchorOrigin={{
                                    vertical: 'top',
                                    horizontal: 'right',
                                }}
                                keepMounted
                                transformOrigin={{
                                    vertical: 'top',
                                    horizontal: 'right',
                                }}
                                open={open}
                                onClose={handleClose}
                            >
                                <MenuItem onClick={handleClose}>Профиль</MenuItem>
                                <MenuItem onClick={handleClose}>Настройки</MenuItem>
                            </Menu>
                        </div>
                    )}
                </Toolbar>
                <Collapse in={expand} timeout={'auto'} unmountOnExit={true}>
                    <Toolbar><Link to='/category' onClick={handleMenu}>Врачи</Link></Toolbar>
                    <Toolbar>О клинике</Toolbar>
                    <Toolbar>Контакты</Toolbar>
                </Collapse>
            </AppBar>
        </div>
    );
}
