import React from 'react';
import Button from '@material-ui/core/Button';
import TextField from '@material-ui/core/TextField';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';
import AddCommentIcon from '@material-ui/icons/AddComment';
import {Icon, TextareaAutosize} from "@material-ui/core";
import Box from "@material-ui/core/Box";
import {makeStyles} from "@material-ui/core/styles";

const useStyle = makeStyles({
    textArea: {
        width: '100%'
    }
});

export default function CommentDialog(props) {
    const [open, setOpen] = React.useState(false);

    const [textValue, setTextValue] = React.useState('');

    const classes = useStyle();

    const handleChangeText = (e) => {
        setTextValue(e.target.value);
    };

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const sendComment = () => {
        props.addComment(textValue, props.userId, props.postId)
    };

    return (
        <div>
            <Box variant={"text"} color="action" onClick={handleClickOpen}>
                <Icon>
                    <AddCommentIcon/>
                </Icon>
            </Box>
            <Dialog open={open} onClose={handleClose} aria-labelledby="form-dialog-title">
                <DialogTitle id="form-dialog-title">Комментарий</DialogTitle>
                <DialogContent>
                    <DialogContentText>
                        Оставьте Ваш комментарий.
                    </DialogContentText>
                    <TextareaAutosize onChange={handleChangeText}
                        className={classes.textArea}
                        autoFocus
                        margin="dense"
                        id="comment"
                        label="Комментарий"
                        type="text"
                        rowsMin={3}
                        rowsMax={5}
                    />
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose} color="primary">
                        Выйти
                    </Button>
                    <Button onClick={sendComment} color="primary">
                        Отправить
                    </Button>
                </DialogActions>
            </Dialog>
        </div>
    );
}