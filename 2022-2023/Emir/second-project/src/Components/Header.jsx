import { useContext } from 'react';
import { NavLink } from 'react-router-dom';
import styled from 'styled-components';
import { ConnectionContext } from '../Providers/Connection';

const NavBar = styled.nav`
  display: flex;
  align-items: center;
  column-gap: 8px;
  padding: 8px;

  & > h2 {
    margin-right: 24px;
    font-size: 32px;
  }
`;

const StyledLink = styled(NavLink)`
  color: black;
  text-decoration: underline;
  cursor: pointer;
  width: 75px;

  &:hover {
    opacity: 0.8;
    font-weight: bold;
  }
`;

const CustomLink = styled.p`
  color: black;
  text-decoration: underline;
  cursor: pointer;
  width: 75px;
  padding-left: 15px;

  &:hover {
    opacity: 0.8;
    font-weight: bold;
  }
`;

export default function Header({ setShow }) {
  const { user, setUser } = useContext(ConnectionContext);

  const handleDisconnect = () => {
    setUser(null);
    localStorage.clear();
  };

  return (
    <NavBar>
      <h2>Maxium</h2>
      <StyledLink to="/articles">Articles</StyledLink>
      <StyledLink to="/map">Map</StyledLink>
      {user ? (
        <div style={{ display: 'flex' }}>
          <p>Hello, {user.firstname} ! </p>&nbsp;
          <CustomLink onClick={handleDisconnect}>Disconnect</CustomLink>
        </div>
      ) : (
        <div style={{ display: 'flex' }}>
          <CustomLink onClick={() => setShow('signup')}>Signup</CustomLink>
          <CustomLink onClick={() => setShow('login')}>Login</CustomLink>
        </div>
      )}
    </NavBar>
  );
}
