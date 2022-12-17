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

  input {
    margin-bottom: 16px;
    padding: 8px 12px;
    font-size: 18px;
    border-radius: 8px;
    transition: all 0.1s ease-in-out;

    &[type='submit'] {
      border: none;
      background-color: ${(props) => props.theme.intenseBlue};
      cursor: pointer;
      margin-top: 16px;

      &:hover {
        background-color: ${(props) => props.theme.intenseDarkBlue};
      }
    }
  }

  label {
    margin-bottom: 8px;
  }
`;

const ErrorMessage = styled.span`
  color: red;
  margin-bottom: 4px;
`;

export default function Login({ show, setShow }) {
  const {
    register,
    handleSubmit,
    formState,
    reset,
    formState: { errors },
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
          reset({});
        } else {
          alert('An error occured, please try again later.');
        }
      });
    });
  }

  useEffect(() => {
    if (formState.isSubmitSuccessful || show !== 'login') {
      reset({});
    }
  }, [show]);

  if (show === 'login') {
    return (
      <Modal>
        <Form
          onSubmit={handleSubmit((data) => {
            sendForm(data);
          })}
        >
          <label htmlFor="email">Email</label>
          {errors.email && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            placeholder="mail"
            id="email"
            {...register('email', { required: true })}
          />

          <label htmlFor="password">Password</label>
          {errors.password && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            placeholder="password"
            type="password"
            id="password"
            {...register('password', { required: true })}
          />

          <input type="submit" value="Login" />
        </Form>
      </Modal>
    );
  } else {
    return null;
  }
}
