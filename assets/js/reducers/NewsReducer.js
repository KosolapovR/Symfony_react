import {types} from "../constants";
import axios from 'axios';

const initialState = {
    items: []
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
            return {...state}
        }
        default:
            return state
    }
};

export default newsReducer;

const getAllNewsAC = (payload) => {
    return {type: types.GET_ALL_NEWS, payload}
};

/*const getNewsAC = (payload) => {
    return {type: types.GET_NEWS, payload}
};*/

export const getAllNews = () => {
    return (dispatch) => {
        let response = axios.get('https://127.0.0.1:8000/api/post');
        response.then((response) => {
            dispatch(getAllNewsAC(response.data));
        })
    }
};