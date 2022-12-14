import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import { useContext } from 'react';
import { PositionContext } from '../Providers/Position';
import styled from 'styled-components';

const StyledMapContainer = styled(MapContainer)`
  .leaflet-marker-pane > * {
    width: 48px;
    height: 48px;
    transition: transform 0.3s linear;
  }

  .leaflet-popup-pane > * {
    transition: transform 0.3s linear;
  }
`;

export default function Map() {
  const { positions } = useContext(PositionContext);

  const icon = L.icon({
    iconUrl: '/images/snail.svg',
  });

  return (
    <StyledMapContainer
      center={[48.84583, 2.2368]}
      zoom={12}
      scrollWheelZoom={true}
      style={{ width: '100%', height: '800px' }}
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
  );
}
