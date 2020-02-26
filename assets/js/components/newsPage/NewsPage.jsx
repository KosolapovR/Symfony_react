import React, {useEffect} from 'react';
import {connect} from "react-redux";
import {getAllPosts} from "../../reducers/postReducer";

function NewsPage(props) {
    useEffect(() => {
        props.getPosts()
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
            getPosts: () => {
                dispatch(getAllPosts());
            }
        }
    }
;

export default connect(mapStateToProps, mapDispatchToProps)(NewsPage);

