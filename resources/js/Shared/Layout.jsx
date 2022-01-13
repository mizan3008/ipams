import React from 'react'
import Footer from './Footer';
import Nav from "./Nav";

function Layout({ children }) {
    return (
        <React.Fragment>

            <header>
                <Nav />
            </header>

            <main className="flex-shrink-0">
                {children}
            </main>

            <Footer />

        </React.Fragment>
    );
}

export default Layout;