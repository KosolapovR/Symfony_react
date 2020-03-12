import * as types from "./types";

const getAllNewsAC = (payload) => {
    return {type: types.GET_ALL_ITEMS, payload}
};

const getNewsAC = (payload) => {
    return {type: types.GET_ITEM, payload}
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

export {
    getAllNewsAC,
    getNewsAC,
    showLoaderAllAC,
    showLoaderAC,
    hideLoaderAllAC,
    hideLoaderAC
}