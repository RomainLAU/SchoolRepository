import { useEffect, useState } from "react";
import { useSearchParams } from "react-router-dom";
import styled from "styled-components";

const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
`;

export default function DetailedArticle() {
  const [article, setArticle] = useState([]);
  const [searchParams, setSearchParams] = useSearchParams();

  const id = searchParams.get("id");

  const fetchArticle = () => {
    fetch(`http://edu.project.etherial.fr/articles/${id}`).then((response) => {
      response.json().then((json) => {
        setArticle(json.data);
      });
    });
  };

  useEffect(() => {
    fetchArticle();
  }, []);

  return (
    <Container>
      {article && article.User ? (
        <div>
          <h1>{article.title}</h1>
          <p>{article.content}</p>
          <i>
            Written by: {article.User.firstname}
            {article.User.lastname}
          </i>
        </div>
      ) : (
        <p>Loading...</p>
      )}
    </Container>
  );
}
