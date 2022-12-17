import { useState } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import { ThemeProvider } from 'styled-components';
import Header from './Components/Header';
import Login from './Components/Login';
import ModalBackground from './Components/ModalBackground';
import Signup from './Components/Signup';
import DetailedArticle from './Pages/DetailedArticle';
import ArticlesPage from './Pages/ArticlesPage';
import Map from './Pages/Map';
import { ConnectionContext, ConnectionProvider } from './Providers/Connection';
import { PositionProvider } from './Providers/Position';
import { StoreProvider } from './Providers/Store';
import CreateArticle from './Components/CreateArticle';
import MapPan from './Components/MapPan';
import { useContext } from 'react';

const theme = {
  lightBlue: '#dff0ff',
  darkBlue: '#bed2e4',
  intenseBlue: '#0ab0ff',
  intenseDarkBlue: '#0897db',
};

function App() {
  const [show, setShow] = useState('');

  return (
    <StoreProvider>
      <ConnectionProvider>
        <PositionProvider>
          <ThemeProvider theme={theme}>
            <BrowserRouter>
              <Header setShow={setShow} />

              <ModalBackground setShow={setShow} show={show} />
              <Signup show={show} setShow={setShow} />
              <Login show={show} setShow={setShow} />
              <CreateArticle show={show} setShow={setShow} />

              <Routes>
                <Route
                  path="/"
                  element={<ArticlesPage setShow={setShow} />}
                ></Route>
                <Route path="/article" element={<DetailedArticle />}></Route>
                <Route path="/map" element={<Map />}></Route>
              </Routes>
            </BrowserRouter>
          </ThemeProvider>
        </PositionProvider>
      </ConnectionProvider>
    </StoreProvider>
  );
}

export default App;
