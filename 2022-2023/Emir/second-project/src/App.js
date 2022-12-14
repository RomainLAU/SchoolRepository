import { useState } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Header from './Components/Header';
import Login from './Components/Login';
import ModalBackground from './Components/ModalBackground';
import Signup from './Components/Signup';
import DetailedArticle from './Pages/DetailedArticle';
import Home from './Pages/Home';
import Map from './Pages/Map';
import { ConnectionProvider } from './Providers/Connection';
import { PositionProvider } from './Providers/Position';
import { StoreProvider } from './Providers/Store';

function App() {
  const [show, setShow] = useState('');

  return (
    <StoreProvider>
      <ConnectionProvider>
        <PositionProvider>
          <BrowserRouter>
            <Header setShow={setShow} />

            <ModalBackground setShow={setShow} show={show} />
            <Signup show={show} setShow={setShow} />
            <Login show={show} setShow={setShow} />

            <Routes>
              <Route path="/articles" element={<Home />}></Route>
              <Route path="/article" element={<DetailedArticle />}></Route>
              <Route path="/map" element={<Map />}></Route>
            </Routes>
          </BrowserRouter>
        </PositionProvider>
      </ConnectionProvider>
    </StoreProvider>
  );
}

export default App;
