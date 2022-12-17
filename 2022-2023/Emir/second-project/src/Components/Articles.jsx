import { useContext } from 'react';
import { useEffect } from 'react';
import { useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import styled from 'styled-components';
import { ConnectionContext } from '../Providers/Connection';
import { StoreContext } from '../Providers/Store';
import Article from './Article';

const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 1em;
  width: 100%;
`;

const Paginator = styled.div`
  margin-top: 60px;
  margin-bottom: 60px;
  display: flex;
  align-items: center;
  border-radius: 8px;
  overflow: hidden;
  border: solid 2px ${(props) => props.theme.darkBlue};

  p,
  b {
    cursor: pointer;
    font-size: 18px;
    padding: 8px;
    width: 32px;
    height: 32px;
    background-color: ${(props) => props.theme.lightBlue};
    border: solid 1px ${(props) => props.theme.darkBlue};
    margin: 0;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: all 0.1s ease-in-out;

    &:hover {
      background-color: ${(props) => props.theme.darkBlue};
    }
  }
`;

const FilterContainer = styled.div`
  display: flex;
  align-items: center;
  column-gap: 4px;
`;

const FilterDiv = styled.div`
  display: flex;
  align-items: center;

  label {
    padding: 12px 24px;
    cursor: pointer;
    border-radius: 8px;
    border: solid 2px ${(props) => props.theme.lightBlue};
    font-weight: bold;
    transition: all 0.1s ease-in-out;

    &:hover {
      background-color: ${(props) => props.theme.intenseDarkBlue};
    }
  }

  input:checked + label {
    background-color: ${(props) => props.theme.lightBlue};

    &:hover {
      background-color: ${(props) => props.theme.intenseDarkBlue};
    }
  }
`;

const ArticlesHeader = styled.div`
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: ${(props) => props.theme.darkBlue};
  width: calc(100% - 128px * 2);
  padding: 48px 128px;
  margin-bottom: 64px;
`;

const CreateButton = styled.button`
  border: solid 1px grey;
  margin-bottom: 16px;
  padding: 8px 12px;
  font-size: 18px;
  border-radius: 8px;
  transition: all 0.1s ease-in-out;
  justify-self: flex-end;
  border: none;
  background-color: ${(props) => props.theme.intenseBlue};
  cursor: pointer;
  margin-top: 16px;

  &:hover {
    background-color: ${(props) => props.theme.intenseDarkBlue};
  }
`;

export default function Articles({ setShow }) {
  const { articles, setArticles, page, setPage } = useContext(StoreContext);
  const { user } = useContext(ConnectionContext);
  const [searchParams, setSearchParams] = useSearchParams();
  const [category, setCategory] = useState('ALL');

  const fetchArticles = () => {
    fetch(
      `http://edu.project.etherial.fr/articles?offset=${
        page.current ? (page.current - 1) * 10 : 0
      }&limit=10`
    ).then((response) => {
      response.json().then((json) => {
        setArticles(json.data);
      });
    });
  };

  useEffect(() => {
    setSearchParams('p=' + page.current);
    fetchArticles();
  }, [searchParams, page]);

  const handleReset = () => {
    setPage({
      previous: 0,
      current: 1,
      next: 2,
    });
  };

  const handleGoBack = () => {
    setPage({
      previous: page.current - 2,
      current: page.current - 1,
      next: page.current,
    });
  };

  const handleGoNext = () => {
    setPage({
      previous: page.current,
      current: page.current + 1,
      next: page.current + 2,
    });
  };

  return (
    <Container>
      <ArticlesHeader>
        <FilterContainer>
          <FilterDiv>
            <input
              type="radio"
              id="ALL"
              value="ALL"
              onChange={() => setCategory('ALL')}
              checked={category === 'ALL'}
              radioGroup="category"
              hidden
            />
            <label htmlFor="ALL"> ALL</label>
          </FilterDiv>
          <FilterDiv>
            <input
              type="radio"
              id="DEV"
              value="DEV"
              onChange={() => setCategory('DEV')}
              checked={category === 'DEV'}
              radioGroup="category"
              hidden
            />
            <label htmlFor="DEV"> DEV</label>
          </FilterDiv>
          <FilterDiv>
            <input
              type="radio"
              id="BIZ"
              value="BIZ"
              onChange={() => setCategory('BIZ')}
              checked={category === 'BIZ'}
              radioGroup="category"
              hidden
            />
            <label htmlFor="BIZ"> BIZ</label>
          </FilterDiv>
          <FilterDiv>
            <input
              type="radio"
              id="ART"
              value="ART"
              onChange={() => setCategory('ART')}
              checked={category === 'ART'}
              radioGroup="category"
              hidden
            />
            <label htmlFor="ART"> ART</label>
          </FilterDiv>
        </FilterContainer>
        {user && (
          <CreateButton onClick={() => setShow('create')}>
            Post a new article
          </CreateButton>
        )}
      </ArticlesHeader>
      {articles && articles.length > 0 && category === 'ALL'
        ? articles.map((article) => {
            return <Article article={article} key={article.id} />;
          })
        : articles
            .filter((article) => article.ArticleCategory.name === category)
            .map((article) => {
              return <Article article={article} key={article.id} />;
            })}

      <Paginator>
        <p
          onClick={() => {
            handleReset();
          }}
        >
          0
        </p>
        {page.current > 1 && (
          <p
            onClick={() => {
              handleGoBack();
            }}
          >
            {page.previous}
          </p>
        )}
        <b>{page.current}</b>
        <p
          onClick={() => {
            handleGoNext();
          }}
        >
          {page.next}
        </p>
      </Paginator>
    </Container>
  );
}
