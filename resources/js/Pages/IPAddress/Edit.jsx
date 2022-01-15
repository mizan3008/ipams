import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-react';
import React, { useState } from 'react'
import Layout from '../../Shared/Layout';

function Edit(props) {

    const [label, setLabel] = useState(props.ip_address.data.label);
    // const [ip_address, setIPAddress] = useState(props.ip_address.data.ip_address);

    function handleSubmit(event) {
        event.preventDefault();

        Inertia.put("/ip-address/" + props.ip_address.data.id, {
            'id': props.ip_address.data.id,
            'label': label,
            'ip_address': props.ip_address.data.ip_address
        });
    }

    function handleLabelInput(event) {
        setLabel(event.target.value);
        event.preventDefault();
    }

    return (
        <React.Fragment>
            <h1 className="mt-5">Edit IP Address</h1>
            <hr />

            <div className="row justify-content-md-center">
                <div className="col col-md-2"></div>
                <div className="cold col-md-8">
                    <form onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label className="control-label" htmlFor="label">Label</label>
                            <input type="text" name="label" value={label} onChange={handleLabelInput} className="form-control" placeholder="Label" />
                            <small className="text-danger">{props.errors.label}</small>
                        </div>
                        <div className="form-group pt-3">
                            <label className="control-label" htmlFor="ip_address">IP Address</label>
                            <input type="text" name="ip_address" value={props.ip_address.data.ip_address} className="form-control" disabled placeholder="IP Address" />
                            <small className="text-danger">{props.errors.ip_address}</small>
                        </div>

                        <div className="form-group pt-3">
                            <button className="btn btn-primary" type="submit">Save</button>
                            <Link className="btn btn-secondary" href="/ip-address">Back to the list</Link>
                        </div>
                    </form>
                </div>
                <div className="col col-md-2"></div>
            </div>
        </React.Fragment>
    )
}

Edit.layout = page => <Layout children={page} title="IP Address Edit" />

export default Edit;