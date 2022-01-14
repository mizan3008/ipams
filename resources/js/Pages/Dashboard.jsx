import React from 'react'
import Layout from '../Shared/Layout';


function Dashbaord(props) {
    return (
        <React.Fragment>
            <h1 className="mt-5">Dashbaord</h1>
            <hr/>
            <p className="lead">
                Welcome to dashboard!
            </p>
        </React.Fragment>
    );
}

Dashbaord.layout = page => <Layout children={page} title="Dashbaord" />

export default Dashbaord;