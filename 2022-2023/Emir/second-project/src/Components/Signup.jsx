import { useEffect } from 'react';
import { useForm } from 'react-hook-form';
import styled from 'styled-components';

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
`;

export default function Signup({ show, setShow }) {
  const {
    register,
    handleSubmit,
    formState,
    reset,
    formState: { errors },
  } = useForm();

  function sendForm(data) {
    fetch(`http://edu.project.etherial.fr/users`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        lastname: data.lastname,
        firstname: data.firstname,
        email: data.email,
        password: data.password,
        password_verif: data.password_verif,
      }),
    }).then((response) => {
      response.json().then((json) => {
        if (json.status !== 201) {
          alert('An error occured, please try again later.');
        } else {
          setShow('login');
          reset({});
        }
      });
    });
  }

  useEffect(() => {
    if (formState.isSubmitSuccessful || show !== 'signup') {
      reset({});
    }
  }, [show]);

  if (show === 'signup') {
    return (
      <Modal>
        <Form
          onSubmit={handleSubmit((data) => {
            sendForm(data);
          })}
        >
          <label htmlFor="firstname">First Name</label>
          {errors.firstname && (
            <ErrorMessage>
              This field is required. {errors.firstname.message} <br />
            </ErrorMessage>
          )}
          <input
            placeholder="Ex: Jeanne"
            id="firstname"
            {...register('firstname', { required: true })}
          />

          <label htmlFor="lastname">Last Name</label>
          {errors.lastname && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            placeholder="Ex: Maria"
            id="lastname"
            {...register('lastname', { required: true })}
          />

          <label htmlFor="email">Email</label>
          {errors.email && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            id="email"
            placeholder="Ex: jeanne.maria@mail.com"
            {...register('email', { required: true })}
          />

          <label htmlFor="password">Password</label>
          {errors.password && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            id="password"
            placeholder="******************"
            type="password"
            {...register('password', { required: true })}
          />

          <label htmlFor="password_verif">Password verification</label>
          {errors.password_verif && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            id="password_verif"
            placeholder="******************"
            type="password"
            {...register('password_verif', { required: true })}
          />

          <input type="submit" value="Register" />
        </Form>
      </Modal>
    );
  } else {
    return null;
  }
}
