import styled from 'styled-components';

const BackgroundContainer = styled.div`
  width: 100%;
  height: 100vh;
  position: fixed;
  top: 0;
  background-color: rgba(0, 0, 0, 0.295);
  z-index: 100;
`;

export default function ModalBackground({ setShow, show }) {
  if (show.length > 0) {
    return (
      <BackgroundContainer onClick={() => setShow('')}></BackgroundContainer>
    );
  } else {
    return null;
  }
}
