import styled from 'styled-components';
import Articles from '../Components/Articles';

const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
`;

const Title = styled.h1`
  font-size: 48px;
  font-weight: bold;
  margin-top: 128px;
`;

export default function Home() {
  return (
    <Container>
      <Title>Welcome to Maxium</Title>
      <Articles />
    </Container>
  );
}
