import { createContext, useEffect, useState } from 'react';
import { io } from 'socket.io-client';

const socket = io('http://edu.project.etherial.fr');

export const PositionContext = createContext();

export function PositionProvider(props) {
  const [positions, setPositions] = useState({});

  useEffect(() => {
    socket.on('connect', () => {
      socket.emit('auth', localStorage.getItem('token'));
    });

    socket.on('positions', ({ data }) => {
      setPositions({ ...positions, data });
    });

    navigator.geolocation.getCurrentPosition(success, error, options);
  }, []);

  const options = {
    enableHighAccuracy: true,
    timeout: 500,
    maximumAge: 0,
  };

  function success(pos) {
    socket.emit('update_position', {
      point_lat: pos.coords.latitude,
      point_lon: pos.coords.longitude,
    });
  }

  function error(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
  }

  return (
    <PositionContext.Provider value={{ positions }}>
      {props.children}
    </PositionContext.Provider>
  );
}
