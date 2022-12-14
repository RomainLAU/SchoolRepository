import styled from 'styled-components';
import { useForm } from 'react-hook-form';
import { useContext } from 'react';
import { ConnectionContext } from '../Providers/Connection';
import { useEffect } from 'react';

const Modal = styled.div`
  padding: 16px;
  width: 400px;
  border: solid 2px black;
  background-color: white;
  border-radius: 8px;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 10000;
`;

const Form = styled.form`
  display: flex;
  flex-direction: column;
`;

export default function Login({ show, setShow }) {
  const {
    register,
    handleSubmit,
    formState,
    reset,
    formState: { errors, isSubmitSuccessful },
  } = useForm();

  const { setToken } = useContext(ConnectionContext);

  function sendForm(data) {
    fetch(`http://edu.project.etherial.fr/auth`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        email: data.email,
        password: data.password,
      }),
    }).then((response) => {
      response.json().then((json) => {
        if (json.status === 200) {
          localStorage.setItem('token', json.data.token);
          setToken(localStorage.getItem('token'));
          setShow('');
        } else {
          alert('An error occured, please try again later.');
        }
      });
    });
  }

  useEffect(() => {
    if (formState.isSubmitSuccessful) {
      reset({});
    }
  }, [formState, reset, show]);

  if (show === 'login') {
    return (
      <Modal>
        <Form
          onSubmit={handleSubmit((data) => {
            sendForm(data);
          })}
        >
          <input
            placeholder="mail"
            {...register('email', { required: true })}
          />
          {errors.email && (
            <span>
              This field is required. <br />
            </span>
          )}

          <input
            placeholder="password"
            type="password"
            {...register('password', { required: true })}
          />
          {errors.password && (
            <span>
              This field is required. <br />
            </span>
          )}

          <input type="submit" value="Login" />
        </Form>
      </Modal>
    );
  } else {
    return null;
  }
}
