import React, {useEffect} from 'react';
import {connect} from "react-redux";
import {getAllNews} from "../../state/ducks/news/operations";
import {Card, CardContent, CardHeader, CircularProgress} from "@material-ui/core";
import {withRouter} from "react-router";
import {Link} from "react-router-dom";
import Grid from "@material-ui/core/Grid";
import {makeStyles} from "@material-ui/core/styles";

const useStyles = makeStyles({
    container: {
        height: '100%'
    }
});

function NewsPage({match, location, history, ...props}) {

    const classes = useStyles();

    useEffect(() => {
        !props.news.length ? props.getAllNews() : null
    }, []);

    let news = props.news.map((n) => <Card key={n.id}>
        <Link to={`/news/${n.id}`}><CardHeader title={`Новость ${n.id}`} subheader={n.date}/></Link>
        <CardContent>{n.text}</CardContent>
    </Card>)

    if (props.isFetching) {
        return <Grid className={classes.container} container justify="center" alignItems='center'><Grid
            item><CircularProgress/></Grid></Grid>;
    } else {
        return (
            <div>{news}</div>
        );
    }
}


const mapStateToProps = (state) => ({
    news: state.news.items,
    isFetching: state.news.isFetchingAll
});

export default connect(mapStateToProps, {getAllNews})(withRouter(NewsPage));

