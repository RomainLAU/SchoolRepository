import styled from "styled-components";
import { Link } from "react-router-dom";

const Container = styled(Link)`
  text-align: center;
  border: solid 1px black;
  border-radius: 8px;
  padding: 8px;
  width: 600px;
`;

export default function Article({ article }) {
  return (
    <Container to={"/article?id=" + article.id} state={article}>
      <p>
        <b>{article.title}</b>
      </p>
      <p>{article.content}</p>
    </Container>
  );
}
