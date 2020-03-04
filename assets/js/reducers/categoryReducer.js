import {types} from "../constants";
import axios from 'axios';

const initialState = {
    items: [],
    oneCategory: {},
    isFetching: false,
    isFetchingAll: false
};

const categoryReducer = (state, action) => {
    if (typeof state === 'undefined') {
        return initialState
    }
    switch (action.type) {
        case types.GET_ALL_CATEGORY: {
            let newState = {...state};
            action.payload.forEach((c) => {
                newState.items = [...newState.items, {id: c.id, name: c.name}]
            });
            return newState
        }
        case types.GET_CATEGORY: {
            return {
                ...state,
                oneCategory: {id: action.payload.id, name: action.payload.name, users: {...action.payload.users}}
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

export default categoryReducer;

const getAllCategoryAC = (payload) => {
    return {type: types.GET_ALL_CATEGORY, payload}
};

const getCategoryAC = (payload) => {
    return {type: types.GET_CATEGORY, payload}
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

export const getCategory = (id) => {
    return (dispatch) => {
        dispatch(showLoaderAC());
        let response = axios.get(`https://127.0.0.1:8000/api/category/${id}`);
        response.then((response) => {
            dispatch(getCategoryAC(response.data));
            dispatch(hideLoaderAC());
        })
    }
};

export const getAllCategory = () => {
    return (dispatch) => {
        dispatch(showLoaderAllAC());
        let response = axios.get('https://127.0.0.1:8000/api/category');
        response.then((response) => {
            dispatch(getAllCategoryAC(response.data));
            dispatch(hideLoaderAllAC());
        })
    }
};