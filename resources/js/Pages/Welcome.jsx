import React from 'react'
import Layout from '../Shared/Layout';


function Welcome(props) {
    return (
        <React.Fragment>
            <h1 className="mt-5">Welcome to {props.app.name}</h1>
            <hr/>
            <p className="lead">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
        </React.Fragment>
    );
}

Welcome.layout = page => <Layout children={page} title="Welcome" />

export default Welcome;