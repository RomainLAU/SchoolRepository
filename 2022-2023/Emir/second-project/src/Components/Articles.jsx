import { useContext } from 'react';
import { useEffect } from 'react';
import { useState } from 'react';
import { NavLink, useSearchParams } from 'react-router-dom';
import styled from 'styled-components';
import { StoreContext } from '../Providers/Store';
import Article from './Article';

const Container = styled.div`
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 1em;
`;

const Paginator = styled.div`
  display: flex;
  align-items: center;
  column-gap: 4px;
  margin-top: 60px;
  margin-bottom: 60px;
`;

const CategoryInput = styled.label`
  padding: 12px 24px;
  cursor: pointer;
  border-radius: 8px;
  border: solid 2px grey;
`;

export default function Articles() {
  const { articles, setArticles } = useContext(StoreContext);
  const [searchParams, setSearchParams] = useSearchParams();
  const [category, setCategory] = useState('ALL');

  const fetchArticles = () => {
    fetch(
      `http://edu.project.etherial.fr/articles?offset=${page}&limit=10`
    ).then((response) => {
      response.json().then((json) => {
        setArticles(json.data);
      });
    });
  };

  let page = searchParams.get('p');

  useEffect(() => {
    fetchArticles();

    page = searchParams.get('p');

    if (page === null) {
      page = 0;
    } else {
      page = parseInt(page);
    }
  }, []);

  return (
    <Container>
      <div>
        <CategoryInput htmlFor="ALL"> ALL</CategoryInput>
        <input
          type="radio"
          id="ALL"
          value="ALL"
          onChange={() => setCategory('ALL')}
          checked={category === 'ALL'}
          radioGroup="category"
          hidden
        />

        <CategoryInput htmlFor="DEV"> DEV</CategoryInput>
        <input
          type="radio"
          id="DEV"
          value="DEV"
          onChange={() => setCategory('DEV')}
          checked={category === 'DEV'}
          radioGroup="category"
          hidden
        />

        <CategoryInput htmlFor="BIZ"> BIZ</CategoryInput>
        <input
          type="radio"
          id="BIZ"
          value="BIZ"
          onChange={() => setCategory('BIZ')}
          checked={category === 'BIZ'}
          radioGroup="category"
          hidden
        />

        <CategoryInput htmlFor="ART"> ART</CategoryInput>
        <input
          type="radio"
          id="ART"
          value="ART"
          onChange={() => setCategory('ART')}
          checked={category === 'ART'}
          radioGroup="category"
          hidden
        />
      </div>
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
        <NavLink to={'/articles?p=' + parseInt(page) - 1}>
          {parseInt(page) - 1 === -1 ? '' : parseInt(page) - 1}
        </NavLink>
        <NavLink to={'/articles?p=' + parseInt(page)}>{parseInt(page)}</NavLink>
        <NavLink to={'/articles?p=' + (parseInt(page) + 1)}>
          {parseInt(page) + 1}
        </NavLink>
      </Paginator>
    </Container>
  );
}
