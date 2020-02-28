import React, {useEffect} from 'react';
import {connect} from "react-redux";
import {getAllNews} from "../../reducers/NewsReducer";
import {Card, CardContent, CardHeader} from "@material-ui/core";
import {withRouter} from "react-router";
import {Link} from "react-router-dom";

function NewsPage({ match, location, history, ...props }) {
    useEffect(() => {
        !props.news.length ? props.getNews() : null
    }, []);

    console.log(match.params.newsId);

    let news = props.news.map((n) => <Card key={n.id}>
        <Link to={`/news/${n.id}`}><CardHeader title={`Новость ${n.id}`} subheader={n.date}/></Link>
        <CardContent>{n.text}</CardContent>
    </Card>)

    return (
        <div>{news}</div>
    );
}


const mapStateToProps = (state) => ({
    news: state.news.items
});

const mapDispatchToProps = (dispatch) => {
        return {
            getNews: () => {
                dispatch(getAllNews());
            }
        }
    }
;

export default connect(mapStateToProps, mapDispatchToProps)(withRouter(NewsPage));

