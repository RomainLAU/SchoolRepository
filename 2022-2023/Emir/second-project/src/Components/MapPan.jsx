import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import L from 'leaflet/';
import 'leaflet/dist/leaflet.css';
import { useContext, useEffect, useState } from 'react';
import { PositionContext } from '../Providers/Position';
import styled from 'styled-components';
import { useLocation } from 'react-router-dom';

const ReducedMapContainer = styled.div`
  position: fixed;
  bottom: 25px;
  right: 25px;
  width: 500px;
  height: 350px;
`;

const StyledMapContainer = styled(MapContainer)`
  margin-top: ${(props) => (props.format === 'full' ? '64px' : '0px')};
  width: ${(props) => (props.format === 'full' ? '100%' : '500px')};
  height: ${(props) => (props.format === 'full' ? '800px' : '350px')};

  .leaflet-marker-pane > * {
    width: 48px;
    height: 48px;
    transition: transform 0.3s linear;
  }

  .leaflet-popup-pane > * {
    transition: transform 0.3s linear;
  }

  * {
    color: black !important;
  }
`;

export default function MapPan() {
  const { positions } = useContext(PositionContext);
  const [format, setFormat] = useState('full');
  let location = useLocation();

  useEffect(() => {
    if (location.pathname === '/map') {
      setFormat('full');
    } else {
      setFormat('reduced');
    }
  }, [location]);

  const icon = L.icon({
    iconUrl: '/images/snail.svg',
  });

  if (format === 'full') {
    return (
      <StyledMapContainer
        center={[48.84583, 2.2368]}
        zoom={12}
        scrollWheelZoom={true}
        format={format}
      >
        <TileLayer
          attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        />
        {positions.data &&
          Object.keys(positions.data).map((key, index) => {
            return (
              <Marker
                position={[
                  positions.data[key].location.latitude,
                  positions.data[key].location.longitude,
                ]}
                icon={icon}
                key={index}
              >
                <Popup>{key}</Popup>
              </Marker>
            );
          })}
      </StyledMapContainer>
    );
  } else {
    return (
      <ReducedMapContainer>
        <StyledMapContainer
          center={[48.84583, 2.2368]}
          zoom={12}
          scrollWheelZoom={true}
          format={format}
          className={'reduced'}
        >
          <TileLayer
            attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          />
          {positions.data &&
            Object.keys(positions.data).map((key, index) => {
              return (
                <Marker
                  position={[
                    positions.data[key].location.latitude,
                    positions.data[key].location.longitude,
                  ]}
                  icon={icon}
                  key={index}
                  rotationAngle={positions.data[key].location.rotation ?? '0'}
                  rotationOrigin="center"
                >
                  <Popup>{key}</Popup>
                </Marker>
              );
            })}
        </StyledMapContainer>
      </ReducedMapContainer>
    );
  }
}
