import {types} from "../constants";
import axios from 'axios';

const initialState = {
    items: []
};

const postReducer = (state, action) => {
    if (typeof state === 'undefined') {
        return initialState
    }
    switch (action.type) {
        case types.GET_ALL_POSTS: {
            let newState = {...state};
            action.payload.forEach((p) => {
                newState.items = [...newState.items, {id: p.id, title: p.title, text: p.text, date: p.date_at}]
            });
            return newState
        }
        case types.GET_POST: {
            return {...state}
        }
        default:
            return state
    }
};

export default postReducer;

const getAllPostsAC = (payload) => {
    return {type: types.GET_ALL_POSTS, payload}
};

/*const getPostAC = (payload) => {
    return {type: types.GET_POST, payload}
};*/

export const getAllPosts = () => {
    return (dispatch) => {
        let response = axios.get('https://127.0.0.1:8000/api/post');
        response.then((response) => {
            dispatch(getAllPostsAC(response.data));
        })
    }
};