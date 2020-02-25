import {GET_ALL_POSTS, GET_POST} from "../constants";
import axios from 'axios';

const initialState = {
    posts: []
};

const postReducer = (state, action) => {
    if (typeof state === 'undefined') {
        return initialState
    }
    switch (action.type) {
        case GET_ALL_POSTS: {
            let newState = {...state};
            action.payload.forEach((p) => {
                newState.posts = [...newState.posts, {id: p.id, title: p.title, text: p.text, date: p.date_at}]
            });
            console.log(newState);
            return newState
        }
        case GET_POST: {
            return {...state}
        }
        default:
            return state
    }
};

export default postReducer;

const getAllPostsAC = (payload) => {
    return {type: GET_ALL_POSTS, payload}
};

/*const getPostAC = (payload) => {
    return {type: GET_POST, payload}
};*/

export const getAllPosts = () => {
    return (dispatch) => {
        let response = axios.get('https://127.0.0.1:8000/api/post');
        response.then((response) => {
            dispatch(getAllPostsAC(response.data));
        })
    }
};