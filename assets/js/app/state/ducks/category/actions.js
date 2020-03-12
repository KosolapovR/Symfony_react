import * as types from './types';

export const getAllCategoryAC = (payload) => {
    return {type: types.GET_ALL_ITEMS, payload}
};

export const getCategoryAC = (payload) => {
    return {type: types.GET_ITEM, payload}
};

export const showLoaderAC = () => ({
    type: types.SHOW_LOADER
});

export const hideLoaderAC = () => ({
    type: types.HIDE_LOADER
});

export const showLoaderAllAC = () => ({
    type: types.SHOW_LOADER_ALL
});

export const hideLoaderAllAC = () => ({
    type: types.HIDE_LOADER_ALL
});