import { useContext } from 'react';
import { useEffect } from 'react';
import { useForm } from 'react-hook-form';
import styled from 'styled-components';
import { StoreContext } from '../Providers/Store';

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

  input,
  textarea,
  select {
    border: solid 1px grey;
    margin-bottom: 16px;
    padding: 8px 12px;
    font-size: 18px;
    border-radius: 8px;
    transition: all 0.1s ease-in-out;
    background-color: transparent;

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

export default function CreateArticle({ show, setShow }) {
  const { categories, setCategories, setArticles, page } =
    useContext(StoreContext);
  const {
    register,
    handleSubmit,
    formState,
    reset,
    formState: { errors },
  } = useForm();

  function sendForm(data) {
    fetch(`http://edu.project.etherial.fr/articles`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: `Bearer ${localStorage.getItem('token')}`,
      },
      body: JSON.stringify({
        title: data.title,
        content: data.content,
        article_category_id: data.category,
      }),
    }).then((response) => {
      response.json().then((json) => {
        if (json.status !== 201) {
          alert('An error occured, please try again later.');
        } else {
          fetchArticles();
          setShow('');
          reset({});
        }
      });
    });
  }

  const fetchArticles = () => {
    fetch(
      `http://edu.project.etherial.fr/articles?offset=${
        page.current ? (page.current - 1) * 10 : 0
      }&limit=10`
    ).then((response) => {
      response.json().then((json) => {
        setArticles(json.data);
      });
    });
  };

  function getCategories() {
    fetch(`http://edu.project.etherial.fr/articles/categories`).then(
      (response) => {
        response.json().then((json) => {
          if (json.status === 200) {
            setCategories(json.data);
          }
        });
      }
    );
  }

  useEffect(() => {
    if (formState.isSubmitSuccessful || show !== 'create') {
      reset({});
    }
  }, [show]);

  useEffect(() => {
    getCategories();
  }, []);

  if (show === 'create') {
    return (
      <Modal>
        <Form
          onSubmit={handleSubmit((data) => {
            sendForm(data);
          })}
        >
          <label htmlFor="title">Title</label>
          {errors.title && (
            <ErrorMessage>
              This field is required. {errors.title.message} <br />
            </ErrorMessage>
          )}
          <input
            placeholder="Ex: The last one is amazing !"
            id="title"
            {...register('title', { required: true })}
          />

          <label htmlFor="content">Content</label>
          {errors.content && (
            <ErrorMessage>
              This field is required. <br />
            </ErrorMessage>
          )}
          <textarea
            rows="5"
            placeholder="Ex: Once upon a time..."
            id="content"
            {...register('content', { required: true })}
          />

          <select {...register('category', { required: true })}>
            {categories &&
              categories.map((category) => (
                <option key={category.id} value={category.id}>
                  {category.name}
                </option>
              ))}
          </select>

          <input type="submit" value="Post" />
        </Form>
      </Modal>
    );
  } else {
    return null;
  }
}
