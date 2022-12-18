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
import { ConnectionProvider } from './Providers/Connection';
import { PositionProvider } from './Providers/Position';
import { StoreProvider } from './Providers/Store';
import CreateArticle from './Components/CreateArticle';
import { useDarkMode } from './Hooks/useDarkMode';

const lightTheme = {
  lightBlue: '#dff0ff',
  darkBlue: '#bed2e4',
  intenseBlue: '#0ab0ff',
  intenseDarkBlue: '#0897db',
  bgColor: '#e9e9e9',
  color: 'black',
  borderColor: 'black',
};

const darkTheme = {
  lightBlue: '#dff0ff',
  darkBlue: '#bed2e4',
  intenseBlue: '#0897db',
  intenseDarkBlue: '#0ab0ff',
  bgColor: '#2f3148',
  color: 'white',
  borderColor: 'white',
};

function App() {
  const [show, setShow] = useState('');
  const [theme, themeToggler] = useDarkMode();

  const themeMode = theme === 'light' ? lightTheme : darkTheme;

  return (
    <ThemeProvider theme={themeMode}>
      <StoreProvider>
        <ConnectionProvider>
          <PositionProvider>
            <BrowserRouter>
              <Header setShow={setShow} theme={theme} setTheme={themeToggler} />

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
          </PositionProvider>
        </ConnectionProvider>
      </StoreProvider>
    </ThemeProvider>
  );
}

export default App;
