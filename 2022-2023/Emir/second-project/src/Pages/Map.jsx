import { useContext, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import MapPan from '../Components/MapPan';
import { ConnectionContext } from '../Providers/Connection';

export default function Map() {
  const { user } = useContext(ConnectionContext);
  const navigate = useNavigate();

  useEffect(() => {
    setTimeout(() => {
      if (!user) {
        navigate('/');
      }
    }, 500);
  });

  if (user) {
    return <MapPan format={'full'} />;
  }
}
