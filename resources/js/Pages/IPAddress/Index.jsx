import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-react';
import React, { useEffect, useState } from 'react'
import AlertMessage from '../../Shared/AlertMessage';
import Layout from '../../Shared/Layout';
import Paginator from '../../Shared/Paginator';

function Index(props) {

    const [search, setSearch] = useState(props.filters.search ?? '');
    const [alert_show, setAlertShow] = useState(false);
    const [alert_class, setAlertClass] = useState('success');
    const [alert_message, setAlertMessage] = useState('');

    function handleSearchInput(event) {
        event.preventDefault();
        setSearch(event.target.value);
        Inertia.get('/ip-address', { search: event.target.value }, { preserveState: true });
    }

    useEffect(() => {
        if (props.flash.status !== null) {
            setAlertShow(true);
            setAlertClass(props.flash.status.class);
            setAlertMessage(props.flash.status.message);
        }
    });

    return (
        <React.Fragment>
            <h1 className="mt-5">IP Address</h1>
            <hr />

            {
                alert_show === true ? (
                    <AlertMessage alert_class={alert_class} alert_message={alert_message} />
                ) : (
                    ""
                )
            }

            <div className='row pb-3'>
                <div className='col-md-12'>
                    <Link className="btn btn-danger" href='/ip-address/create'><i className='fa fa-plus-circle'></i> Create New</Link>
                </div>
            </div>
            <div className='row pb-3'>
                <div className='col-md-12'>
                    <div className="input-group mb-3">
                        <input type='text' name='search' onChange={handleSearchInput} value={search} placeholder='Search IP by label or ip address...' className='form-control' />
                        <Link className="btn btn-outline-secondary" href='/ip-address'>Reset</Link>
                    </div>
                </div>
            </div>
            <table className="table table-sm caption-top">
                <thead>
                    <tr>
                        <th width="5%" className="text-center">ID</th>
                        <th>Label</th>
                        <th width="15%" className="text-left">IP</th>
                        <th width="10%" className="text-left">Owner</th>
                        <th width="10%" className="text-left">Created At</th>
                        <th width="15%" className="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    {
                        props.ipAddresses.data.length > 0 ? (
                            props.ipAddresses.data.map((ip, index) => (
                                <tr key={ip.id}>
                                    <td width="5%" className="text-center">{ip.id}</td>
                                    <td>{ip.label}</td>
                                    <td width="15%" className="text-left">{ip.ip_address}</td>
                                    <td width="10%" className="text-left">{ip.user.name}</td>
                                    <td width="10%" className="text-left">{ip.created_at}</td>
                                    <td width="15%" className="text-center">
                                        <div className="btn-group" role="group">
                                            <Link href={`/ip-address/${ip.id}/edit`} className="btn btn-info btn-sm"><i className="fa fa-edit"></i></Link>
                                            <Link href={`/ip-address/${ip.id}`} className="btn btn-danger btn-sm"><i className="fa fa-file"></i></Link>
                                        </div>
                                    </td>
                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td colSpan="6">Nothing found</td>
                            </tr>
                        )
                    }
                </tbody>
                <tfoot>
                    <tr>
                        <td colSpan="2"></td>
                        <td colSpan="4">
                            <Paginator links={props.ipAddresses.meta.links} />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </React.Fragment>
    );
}

Index.layout = page => <Layout children={page} title="IP Address List" />

export default Index;