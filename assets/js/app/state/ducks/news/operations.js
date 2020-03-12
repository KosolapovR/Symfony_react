import axios from "axios";
import * as actions from "./actions";

const addComment = (text, user_id, post_id) => {
    return (dispatch) => {
        let config = {
            headers: {'Access-Control-Allow-Origin': '*'}
        };
        let response = axios.post('https://127.0.0.1:8000/api/comment', {text, user_id, post_id}, config);
        response.then((data) => {
            console.log(data);
        });
    }
}

const getAllNews = () => {
    return (dispatch) => {
        dispatch(actions.showLoaderAllAC());
        let response = axios.get('https://127.0.0.1:8000/api/post');
        response.then((response) => {
            dispatch(actions.getAllNewsAC(response.data));
            dispatch(actions.hideLoaderAllAC());
        })
    }
};

const getOneNews = (id) => {
    return (dispatch) => {
        dispatch(actions.showLoaderAC());
        let response = axios.get(`https://127.0.0.1:8000/api/post/${id}`);
        response.then((response) => {
            dispatch(actions.getNewsAC(response.data));
            dispatch(actions.hideLoaderAC());
        })
    }
};

export {
    getAllNews,
    getOneNews,
    addComment
}