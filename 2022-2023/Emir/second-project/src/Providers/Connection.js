import { createContext, useEffect, useState } from 'react';

export const ConnectionContext = createContext();

export function ConnectionProvider(props) {
  const [user, setUser] = useState(null);

  const [token, setToken] = useState(localStorage.getItem('token'));

  useEffect(() => {
    setToken(localStorage.getItem('token'));
    if (token) {
      getUserData();
    } else {
      setUser(null);
    }
  }, [token]);

  function getUserData() {
    fetch(`http://edu.project.etherial.fr/users/me`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
    }).then((response) => {
      response.json().then((json) => {
        setUser(json.data);
      });
    });
  }

  return (
    <ConnectionContext.Provider value={{ user, setUser, setToken }}>
      {props.children}
    </ConnectionContext.Provider>
  );
}
