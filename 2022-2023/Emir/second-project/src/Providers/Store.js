import { createContext, useState } from 'react';

export const StoreContext = createContext();

export function StoreProvider(props) {
  const [articles, setArticles] = useState([]);
  const [page, setPage] = useState({
    previous: 0,
    current: 1,
    next: 2,
  });

  return (
    <StoreContext.Provider
      value={{
        articles: articles,
        setArticles: setArticles,
        page: page,
        setPage: setPage,
      }}
    >
      {props.children}
    </StoreContext.Provider>
  );
}