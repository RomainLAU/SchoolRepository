import { Reload } from '@styled-icons/ionicons-solid/Reload';
import { useState } from 'react';
import styled, { keyframes } from 'styled-components';

const rotate = keyframes`
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(540deg);
  }
`;

const RotatingReload = styled(Reload)`
  animation: ${rotate} 2s linear infinite;
  width: 24px;
`;

const Button = styled.button`
  width: 100px;
  height: 37px;
  margin-right: 150px;
  border: solid 1px grey;
  margin-bottom: 16px;
  padding: 8px 12px;
  font-size: 18px;
  border-radius: 8px;
  transition: all 0.1s ease-in-out;
  justify-self: flex-end;
  border: none;
  background-color: ${(props) => props.theme.intenseBlue};
  cursor: pointer;
  margin-top: 16px;

  &:hover {
    background-color: ${(props) => props.theme.intenseDarkBlue};
  }
`;

export default function ReloadButton({ fetchArticles }) {
  const [loading, setLoading] = useState(false);

  const handleFetch = () => {
    setLoading(true);
    fetchArticles();
    setTimeout(() => {
      setLoading(false);
    }, 1000);
  };

  if (loading) {
    return (
      <Button onClick={() => handleFetch()}>
        <RotatingReload />
      </Button>
    );
  } else {
    return <Button onClick={() => handleFetch()}>Refresh</Button>;
  }
}
