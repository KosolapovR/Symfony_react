import React, {useEffect} from 'react';
import {getAllCategory} from "../../reducers/categoryReducer";
import {connect} from "react-redux";

function CategoryPage(props) {
    useEffect(() => {
        props.getCategory()
    }, []);
    console.log(props);
    return (
        <div></div>
    );
}

const mapStateToProps = (state) => ({
    state
});

const mapDispatchToProps = (dispatch) => {
        return {
            getCategory: () => {
                dispatch(getAllCategory());
            }
        }
    }
;

export default connect(mapStateToProps, mapDispatchToProps)(CategoryPage);