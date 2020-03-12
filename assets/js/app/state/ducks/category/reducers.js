import * as types from './types';

const initialState = {
    items: [],
    oneCategory: {},
    isFetching: false,
    isFetchingAll: false
};

const category = (state, action) => {
    if (typeof state === 'undefined') {
        return initialState
    }
    switch (action.type) {
        case types.GET_ALL_ITEMS: {
            let newState = {...state};
            action.payload.forEach((c) => {
                newState.items = [...newState.items, {id: c.id, name: c.name}]
            });
            return newState
        }
        case types.GET_ITEM: {
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

export default category;