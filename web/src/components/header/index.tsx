
import { AuthContext } from '@/pages/provider';
import { useContext } from 'react';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import { MdOutlineMessage } from "react-icons/md";

export function Header() {

    const { user } = useContext(AuthContext);

    return (
        <Navbar collapseOnSelect expand="lg" className="bg-body-tertiary">
            <Container fluid >
                <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                <Navbar.Collapse id="responsive-navbar-nav">
                    <Nav className="me-auto">
                        <Nav.Link href="#features">Features</Nav.Link>
                        <Nav.Link href="#pricing">Pricing</Nav.Link>
                        <NavDropdown title="Dropdown" id="collapsible-nav-dropdown">
                            <NavDropdown.Item href="#action/3.1">Action</NavDropdown.Item>
                            <NavDropdown.Item href="#action/3.2">
                                Another action
                            </NavDropdown.Item>
                            <NavDropdown.Item href="#action/3.3">Something</NavDropdown.Item>
                            <NavDropdown.Divider />
                            <NavDropdown.Item href="#action/3.4">
                                Separated link
                            </NavDropdown.Item>
                        </NavDropdown>
                    </Nav>
                    <Nav>
                        <Nav.Link href="#features"><MdOutlineMessage /></Nav.Link>
                        <NavDropdown title={user?.Nome} >
                            <NavDropdown.Item href="#action/3.1">Pefil</NavDropdown.Item>
                            <NavDropdown.Item href="#action/3.2">
                                Configurações
                            </NavDropdown.Item>
                            <NavDropdown.Divider />
                            <NavDropdown.Item href="/login">
                                Sair
                            </NavDropdown.Item>
                        </NavDropdown>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}


/*
import { signIn, signOut, useSession } from 'next-auth/react';
import Link from 'next/link';
import styles from './style.module.css';


export function Header() {

    const { data: session, status } = useSession();

    return (
        <header className={styles.header}>
            <section className={styles.content}>
                <nav className={styles.nav}>
                    <Link href="/">
                        <h1 className={styles.logo}>
                            Tarefas<span>+</span>
                        </h1>
                    </Link>
                    {session?.user && (
                        <Link href="/dashboard" className={styles.link}>
                            Meu Painel
                        </Link>
                    )}
                </nav>

                {status === "loading" ? (
                    <></>
                ) : session ? (
                    <button className={styles.loginButton} onClick={() => signOut()}>
                        Olá {session?.user?.name}
                    </button>
                ) :
                    (
                        <button className={styles.loginButton} onClick={() => signIn("google")}>
                            Acessar
                        </button>
                    )}

            </section>
        </header>
    );
}
*/