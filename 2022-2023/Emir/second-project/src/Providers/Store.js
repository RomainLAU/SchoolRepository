import { createContext, useState } from 'react';

export const StoreContext = createContext();

export function StoreProvider(props) {
  const [articles, setArticles] = useState([]);

  return (
    <StoreContext.Provider
      value={{
        articles: articles,
        setArticles: setArticles,
      }}
    >
      {props.children}
    </StoreContext.Provider>
  );
}
