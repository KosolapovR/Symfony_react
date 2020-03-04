import {types} from "../constants";
import axios from 'axios';

const initialState = {
    items: [],
    oneNews: {},
    isFetching: false,
    isFetchingAll: false
};

const newsReducer = (state, action) => {
    if (typeof state === 'undefined') {
        return initialState
    }
    switch (action.type) {
        case types.GET_ALL_NEWS: {
            let newState = {...state};
            action.payload.forEach((p) => {
                newState.items = [...newState.items, {id: p.id, title: p.title, text: p.text, date: p.date_at}]
            });
            return newState
        }
        case types.GET_NEWS: {
            let comments = action.payload.comments.map(c => ({id: c.id, text: c.text, date_at: c.date_at, user: c.user}));
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

export default newsReducer;

const getAllNewsAC = (payload) => {
    return {type: types.GET_ALL_NEWS, payload}
};

const getNewsAC = (payload) => {
    return {type: types.GET_NEWS, payload}
};

const showLoaderAC = () => ({
  type: types.SHOW_LOADER
});

const hideLoaderAC = () => ({
    type: types.HIDE_LOADER
});

const showLoaderAllAC = () => ({
    type: types.SHOW_LOADER_ALL
});

const hideLoaderAllAC = () => ({
    type: types.HIDE_LOADER_ALL
});

export const getAllNews = () => {
    return (dispatch) => {
        dispatch(showLoaderAllAC());
        let response = axios.get('https://127.0.0.1:8000/api/post');
        response.then((response) => {
            dispatch(getAllNewsAC(response.data));
            dispatch(hideLoaderAllAC());
        })
    }
};

export const getOneNews = (id) => {
    return (dispatch) => {
        dispatch(showLoaderAC());
        let response = axios.get(`https://127.0.0.1:8000/api/post/${id}`);
        response.then((response) => {
            dispatch(getNewsAC(response.data));
            dispatch(hideLoaderAC());
        })
    }
};