import {types} from "../constants";
import axios from 'axios';

const initialState = {
    items: []
};

const categoryReducer = (state, action) => {
    if (typeof state === 'undefined') {
        return initialState
    }
    switch (action.type) {
        case types.GET_ALL_CATEGORY: {
            let categories = [];
            let newState = {...state};
            action.payload.forEach((c) => {
                categories = [...categories, {id: c.id, name: c.name}]
            });
            newState.items = categories;
            console.log(newState);
            return newState
        }
        case types.GET_CATEGORY: {
            return {...state}
        }
        default:
            return state
    }
};

export default categoryReducer;

const getAllCategoryAC = (payload) => {
    return {type: types.GET_ALL_CATEGORY, payload}
};

/*const getPostAC = (payload) => {
    return {type: types.GET_POST, payload}
};*/

export const getAllCategory = () => {
    return (dispatch) => {
        let response = axios.get('https://127.0.0.1:8000/api/category');
        response.then((response) => {
            dispatch(getAllCategoryAC(response.data));
        })
    }
};