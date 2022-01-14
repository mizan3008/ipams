import React from 'react'
import { Link, usePage } from '@inertiajs/inertia-react'

function Nav(props) {

    const { app, auth } = usePage().props

    return (
        <React.Fragment>
            <nav className="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div className="container-fluid">
                    <Link className="navbar-brand" href="/">{app.name}</Link>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarCollapse">
                        {
                            (auth.user === null) ? (
                                <div className="text-end">
                                    <Link href='/login' className="btn btn-outline-light me-2">Login</Link>
                                </div>
                            ) : (
                                <>
                                    <ul className="navbar-nav me-auto mb-2 mb-md-0">
                                        <li className="nav-item">
                                            <Link className="nav-link" href='/dashboard'>Dashboard</Link>
                                        </li>
                                        <li className="nav-item">
                                            <Link className="nav-link" href='/ip-address'>IP Address</Link>
                                        </li>
                                    </ul>
                                    <div className="text-end">
                                        <Link href='/logout' className="btn btn-outline-light me-2">Logout</Link>
                                    </div>
                                </>
                            )
                        }
                    </div>
                </div>
            </nav>
        </React.Fragment>
    );
}

export default Nav;