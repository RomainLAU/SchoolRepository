import { Moon } from '@styled-icons/fa-regular/Moon';
import { Sun } from '@styled-icons/evaicons-solid/Sun';
import styled from 'styled-components';

const Container = styled.div`
  width: 32px;
  height: 32px;
  border-radius: 8px;
  margin-left: 32px;
  padding: 4px;
  transition: all 0.1s ease-in-out;

  &:hover {
    background-color: ${(props) => props.theme.darkBlue};
  }
`;

const StyledMoon = styled(Moon)`
  cursor: pointer;
  height: 32px;

  &:hover {
    opacity: 0.8;
  }
`;

const StyledSun = styled(Sun)`
  cursor: pointer;
  height: 32px;

  &:hover {
    opacity: 0.8;
  }
`;

export default function ChangeTheme({ theme, setTheme }) {
  const handleChangeTheme = () => {
    if (theme === 'light') {
      setTheme('dark');
    } else {
      setTheme('light');
    }
  };

  if (theme === 'light') {
    return (
      <Container>
        <StyledMoon
          onClick={() => {
            handleChangeTheme();
          }}
        />
      </Container>
    );
  } else {
    return (
      <Container>
        <StyledSun
          onClick={() => {
            handleChangeTheme();
          }}
        />
      </Container>
    );
  }
}
