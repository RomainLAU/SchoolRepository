import { Moon } from '@styled-icons/fa-regular/Moon';
import { Sun } from '@styled-icons/evaicons-solid/Sun';
import styled from 'styled-components';

const StyledMoon = styled(Moon)`
  cursor: pointer;
  height: 32px;
  margin-left: 32px;

  &:hover {
    opacity: 0.8;
  }
`;

const StyledSun = styled(Sun)`
  cursor: pointer;
  margin-left: 32px;
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
      <StyledMoon
        onClick={() => {
          handleChangeTheme();
        }}
      />
    );
  } else {
    return (
      <StyledSun
        onClick={() => {
          handleChangeTheme();
        }}
      />
    );
  }
}
