import { Inertia } from "@inertiajs/inertia";
import React, { useState } from "react";
import Layout from "../../Shared/Layout";

function Login(props) {

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    function handleEmailInput(event) {
        event.preventDefault();
        setEmail(event.target.value);
    }

    function handlePasswordInput(event) {
        event.preventDefault();
        setPassword(event.target.value);
    }

    function handleSubmit(event) {
        event.preventDefault();

        const data = {
            'email': email,
            'password': password,
            'remember': 0
        };

        Inertia.post('/authenticate', data);
    }

    return (
        <React.Fragment>
            <h1 className="mt-5">Login</h1>
            <hr />

            <div className="row justify-content-md-center">
                <div className="col col-md-2"></div>
                <div className="cold col-md-8">
                    <form onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label className="control-label" htmlFor="email">Email</label>
                            <input type="email" name="email" onChange={handleEmailInput} className="form-control" placeholder="Email" />
                            <small className="text-danger">{props.errors.email}</small>
                        </div>
                        <div className="form-group pt-3">
                            <label className="control-label" htmlFor="password">Password</label>
                            <input type="password" name="password" onChange={handlePasswordInput} className="form-control" placeholder="Password" />
                            <small className="text-danger">{props.errors.password}</small>
                        </div>

                        <div className="form-group pt-3">
                            <button className="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
                </div>
                <div className="col col-md-2"></div>
            </div>
        </React.Fragment>
    );
}

Login.layout = page => <Layout children={page} title="Login" />

export default Login;