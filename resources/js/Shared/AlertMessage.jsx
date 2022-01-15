import React from 'react'

function AlertMessage(props) {
    return (
        <React.Fragment>
            <div className={`alert alert-dismissible fade show alert-${props.alert_class}`} role="alert">
                {props.alert_message}
                <button type="button" className="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </React.Fragment>
    )
}

export default AlertMessage;