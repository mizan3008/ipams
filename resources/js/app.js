import React from 'react'
import { render } from 'react-dom'
import { createInertiaApp } from '@inertiajs/inertia-react'
import 'jquery/dist/jquery';
import 'bootstrap/dist/js/bootstrap';

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props }) {
        render(<React.StrictMode><App {...props} /></React.StrictMode>, el)
    },
})