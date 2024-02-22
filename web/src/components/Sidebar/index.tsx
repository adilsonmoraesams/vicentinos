import { Col, Nav } from "react-bootstrap";

const Sidebar = () => {
  return (
    <Col md={2} className="bg-dark flex-d text-light vh-100">
      <Nav
        activeKey=""
        defaultActiveKey=""
        variant="light"
        className="flex-column">
        <Nav.Link className='bg-dark text-light fs-6' href="#home">React-Bootstrap</Nav.Link>
        <hr />
        <Nav.Link className='text-light' >Reuniões</Nav.Link>
        <Nav.Link className='text-light' >Caixa</Nav.Link>
      </Nav>
    </Col>
  );
};

export default Sidebar;
