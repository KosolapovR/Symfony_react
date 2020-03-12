import * as types from './types';
import axios from 'axios';

const initialState = {
    items: [],
    oneNews: {},
    isFetching: false,
    isFetchingAll: false
};

const news = (state, action) => {
    if (typeof state === 'undefined') {
        return initialState
    }
    switch (action.type) {
        case types.GET_ALL_ITEMS: {
            let newState = {...state};
            action.payload.forEach((p) => {
                newState.items = [...newState.items, {id: p.id, title: p.title, text: p.text, date: p.date_at}]
            });
            return newState
        }
        case types.GET_ITEM: {
            let comments = action.payload.comments.map(c => ({
                id: c.id,
                text: c.text,
                date_at: c.date_at,
                user: c.user
            }));
            return {
                ...state,
                oneNews: {
                    id: action.payload.id,
                    date: action.payload.date_at,
                    text: action.payload.text,
                    comments,
                    like: [action.payload.like_mark]
                }
            }
        }
        case types.SHOW_LOADER: {
            return {
                ...state, isFetching: true
            }
        }
        case types.HIDE_LOADER: {
            return {
                ...state, isFetching: false
            }
        }
        case types.SHOW_LOADER_ALL: {
            return {
                ...state, isFetchingAll: true
            }
        }
        case types.HIDE_LOADER_ALL: {
            return {
                ...state, isFetchingAll: false
            }
        }
        default:
            return state
    }
};

export default news;


export const addComment = (text, user_id, post_id) => {
    return (dispatch) => {
        let config = {
            headers: {'Access-Control-Allow-Origin': '*'}
        };
        let response = axios.post('https://127.0.0.1:8000/api/comment', {text, user_id, post_id}, config);
        response.then((data) => {
            console.log(data);
        });
    }
};
