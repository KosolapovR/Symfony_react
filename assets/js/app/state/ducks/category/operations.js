import axios from "axios";
import * as actions from './actions';

const getCategory = (id) => {
    return (dispatch) => {
        dispatch(actions.showLoaderAC());
        let response = axios.get(`https://127.0.0.1:8000/api/category/${id}`);
        response.then((response) => {
            dispatch(actions.getCategoryAC(response.data));
            dispatch(actions.hideLoaderAC());
        })
    }
};

const getAllCategory = () => {
    return (dispatch) => {
        dispatch(actions.showLoaderAllAC());
        let response = axios.get('https://127.0.0.1:8000/api/category');
        response.then((response) => {
            dispatch(actions.getAllCategoryAC(response.data));
            dispatch(actions.hideLoaderAllAC());
        })
    }
};

export {
    getCategory,
    getAllCategory
}