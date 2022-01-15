import { Link } from '@inertiajs/inertia-react';
import React, { useEffect, useState } from 'react'
import Layout from '../../Shared/Layout';

function View(props) {

    return (
        <React.Fragment>
            <h1 className="mt-5">Audit Logs View</h1>
            <hr />
            <table className="table table-sm caption-top">
                <thead>
                    <tr>
                        <th width="5%" className="text-center">ID</th>
                        <th width="10%">Event</th>
                        <th className="text-left">Data</th>
                        <th width="10%" className="text-left">Created At</th>
                    </tr>
                </thead>
                <tbody>

                    {
                        props.ip_address.data.audit_logs.length > 0 ? (
                            props.ip_address.data.audit_logs.map((audit_log, index) => (
                                <tr key={index}>
                                    <td className="text-center">{audit_log.id}</td>
                                    <td>{audit_log.event}</td>
                                    <td>{audit_log.data}</td>
                                    <td>{audit_log.created_at}</td>
                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td colSpan="4">Nothing found</td>
                            </tr>
                        )
                    }

                </tbody>
            </table>
            <Link href='/ip-address' className="btn btn-secondary">Back to the list</Link>
        </React.Fragment>
    );
}

View.layout = page => <Layout children={page} title="Audit Logs View" />

export default View;