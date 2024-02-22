import Sidebar from '@/components/Sidebar';
import { Header } from '@/components/header';
import { Button, Col, Container, Row, Table } from 'react-bootstrap';
import { FaEdit, FaTrashAlt } from "react-icons/fa";



export default function Home() {
  return (
    <DashboardPage />
  )
}

// DashboardPage.js

const DashboardPage = () => {
  
  return (
    <>
      <Container fluid>
        <Row>
          <Sidebar />

          {/* Conteúdo Principal */}
          <Col cl>
            <Header />
            <p className='p-2'></p>
            <h2>Conteúdo do Dashboard</h2>

            {/* Tabela usando React-Bootstrap */}
            <Table striped bordered hover responsive>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th style={{ width: '120px' }}></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Usuário 1</td>
                  <td>usuario1@example.com</td>
                  <td className='text-center' >
                    <Button variant="secondary" size="sm">
                      <FaTrashAlt />
                    </Button>
                    {' '}
                    <Button variant="danger" size="sm">
                      <FaEdit />
                    </Button>
                  </td>
                </tr>
              </tbody>
            </Table>
          </Col>
        </Row>
      </Container>
    </>);
};


