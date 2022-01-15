import { Link } from '@inertiajs/inertia-react';
import React from 'react'

function Paginator(props) {
    return (
        <React.Fragment>
            <nav>
                <ul className="pagination">
                    {props.links.map((link, index) => (
                        <li key={index.toString()} className={`page-item ${link.url === null ? "disabled" : ""} ${link.active === true ? "active" : ""}`}>
                            <Link className="page-link" href={link.url+'#'}>{link.label}</Link>
                        </li>
                    ))}
                </ul>
            </nav>
        </React.Fragment>
    )
}

export default Paginator;