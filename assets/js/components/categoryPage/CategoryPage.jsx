import React, {useEffect} from 'react';
import {getAllCategory} from "../../reducers/categoryReducer";
import {connect} from "react-redux";
import {ListItem, List, ListSubheader, ListItemText} from "@material-ui/core";
import {Link} from "react-router-dom";

function CategoryPage(props) {

    useEffect(() => {
        !props.categories.length ?
            props.getCategory() : null
    }, []);

    let categories = props.categories.map((c) =>
        <ListItem key={c.id}>
            <ListItemText>
                <Link to={`/category/${c.id}`}>{c.name}</Link>
            </ListItemText>
        </ListItem>);

    return (
        <List component='nav' subheader={<ListSubheader component='div'>Наши
            специализации</ListSubheader>}>{categories}</List>
    );
}

const mapStateToProps = (state) => ({
    categories: state.categories.items
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