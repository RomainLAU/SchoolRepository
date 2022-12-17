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
          {errors.firstname && (
            <ErrorMessage>
              This field is required. {errors.firstname.message} <br />
            </ErrorMessage>
          )}
          <input
            placeholder="firstname"
            {...register('firstname', { required: true })}
          />
          {errors.lastname && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            placeholder="lastname"
            {...register('lastname', { required: true })}
          />

          {errors.email && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            placeholder="mail"
            {...register('email', { required: true })}
          />

          {errors.password && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            placeholder="password"
            type="password"
            {...register('password', { required: true })}
          />

          {errors.password_verif && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <input
            placeholder="tieybcgydbgey"
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
