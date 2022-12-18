import { useEffect, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import styled from 'styled-components';

const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  padding: 32px 128px;
  padding-top: 180px;
  background-color: ${(props) => props.theme.bgColor};
  color: ${(props) => props.theme.color};
  transition: all 0.1s ease-in-out;

  h1 {
    margin-bottom: 48px;
  }

  p {
    width: 800px;
    line-height: 26px;
    text-align: justify;
  }

  i {
    margin-top: 48px;
    margin-right: 64px;
    text-align: right;
    align-self: flex-end;
  }
`;

export default function DetailedArticle() {
  const [article, setArticle] = useState([]);
  const [searchParams] = useSearchParams();

  const id = searchParams.get('id');

  const fetchArticle = () => {
    fetch(`http://edu.project.etherial.fr/articles/${id}`).then((response) => {
      if (response.ok) {
        response.json().then((json) => {
          if (json.status === 200) {
            setArticle(json.data);
          }
        });
      } else {
        setArticle(null);
      }
    });
  };

  useEffect(() => {
    fetchArticle();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  return (
    <div>
      {article && article.User ? (
        <Container>
          <h1>{article.title}</h1>
          <p>{article.content}</p>
          <i>
            Written by: {article.User.firstname}
            {article.User.lastname}
          </i>
        </Container>
      ) : article === [] ? (
        <p style={{ textAlign: 'center', marginTop: '128px' }}>Loading...</p>
      ) : (
        <p style={{ textAlign: 'center', marginTop: '128px' }}>
          This article doesn't exist...
        </p>
      )}
    </div>
  );
}
