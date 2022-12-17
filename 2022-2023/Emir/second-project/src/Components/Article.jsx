import styled from 'styled-components';
import { Link } from 'react-router-dom';

const Container = styled(Link)`
  text-align: center;
  border: solid 1px black;
  border-radius: 8px;
  width: 600px;
  text-decoration: none;
  color: black;

  &:hover {
    background-color: #dff0ff;
  }

  h1 {
    margin: 0;
    background-color: #bed2e4;
    border-radius: 8px 8px 0 0;
    margin-bottom: 16px;
    padding: 16px;
  }

  p {
    margin: 32px 48px;
  }
`;

export default function Article({ article }) {
  return (
    <Container to={'/article?id=' + article.id} state={article}>
      <h1>{article.title}</h1>
      <p>{article.content.slice(0, 280)}</p>
    </Container>
  );
}
