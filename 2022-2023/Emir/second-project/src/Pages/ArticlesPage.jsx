import { useContext } from 'react';
import { ConnectionContext } from '../Providers/Connection';
import styled from 'styled-components';
import Articles from '../Components/Articles';
import MapPan from '../Components/MapPan';
import { NavLink } from 'react-router-dom';

const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 110vh;
`;

const Title = styled.h1`
  font-size: 48px;
  font-weight: bold;
  margin-top: 128px;
`;

export default function ArticlesPage({ setShow }) {
  const { user } = useContext(ConnectionContext);

  return (
    <Container>
      <Title>Welcome to Maxium</Title>
      <Articles setShow={setShow} />

      {user && (
        <NavLink to="/map">
          <MapPan />
        </NavLink>
      )}
    </Container>
  );
}
