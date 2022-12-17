import { useContext } from 'react';
import { NavLink } from 'react-router-dom';
import styled from 'styled-components';
import { ConnectionContext } from '../Providers/Connection';

const NavBar = styled.nav`
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 48px;
  background-color: rgba(223, 240, 255, 0.4);
  backdrop-filter: blur(8px);
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 10000;

  & > div:first-child {
    display: flex;
    align-items: center;
  }

  & > div:last-child > p {
    margin: 0;

    &:last-child {
      margin-right: 128px;
    }
  }
`;

const StyledLink = styled(NavLink)`
  color: black;
  text-decoration: underline;
  cursor: pointer;
  width: 75px;
  transition: all 0.1s ease-in-out;

  &:hover {
    opacity: 0.8;
    font-size: 18px;
    font-weight: bold;
  }
`;

const CustomLink = styled.p`
  color: black;
  text-decoration: underline;
  cursor: pointer;
  width: 75px;
  margin: 0;
  padding-left: 15px;
  transition: all 0.1s ease-in-out;

  &:hover {
    opacity: 0.8;
    font-size: 18px;
    font-weight: bold;
  }
`;

const LogoLink = styled(NavLink)`
  text-decoration: none;
  font-weight: bold;
  color: black;
  margin: 0;
  margin-right: 94px;
  font-size: 32px;
`;

const UserItems = styled.div`
  display: flex;
  align-items: center;
  justify-self: flex-end;
`;

export default function Header({ setShow }) {
  const { user, setUser } = useContext(ConnectionContext);

  const handleDisconnect = () => {
    setUser(null);
    localStorage.clear();
  };

  return (
    <NavBar>
      <div>
        <LogoLink className="logo" to="/">
          Maxium
        </LogoLink>
        {user && <StyledLink to="/map">Map</StyledLink>}
      </div>
      {user ? (
        <UserItems>
          <p>Hello, {user.firstname} ! </p>&nbsp;
          <CustomLink onClick={handleDisconnect}>Disconnect</CustomLink>
        </UserItems>
      ) : (
        <UserItems>
          <CustomLink onClick={() => setShow('signup')}>Signup</CustomLink>
          <CustomLink onClick={() => setShow('login')}>Login</CustomLink>
        </UserItems>
      )}
    </NavBar>
  );
}
