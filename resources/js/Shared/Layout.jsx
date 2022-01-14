import { Head, usePage } from '@inertiajs/inertia-react';
import React from 'react'
import Footer from './Footer';
import Nav from "./Nav";

function Layout({ children, title }) {

    const { app } = usePage().props

    const myTitle = `${app.name}::${title}`;

    return (
        <React.Fragment>

            <Head title={myTitle} />

            <header>
                <Nav />
            </header>

            <main className="flex-shrink-0 pt-3">
                {children}
            </main>

            <Footer />

        </React.Fragment>
    );
}

export default Layout;