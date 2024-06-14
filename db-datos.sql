INSERT INTO empresa (enombre, edireccion) VALUES 
('Transporte Nacional S.A.', 'Av. Libertador 1234'),
('Viajes del Sur', 'Calle Falsa 456'),
('Rápidos del Norte', 'Boulevard de los Andes 789'),
('Expreso Cordillerano', 'Calle Los Aromos 321'),
('Viajes Patagónicos', 'Ruta 22 km 34');


INSERT INTO responsable (rnumerolicencia, rnombre, rapellido) VALUES 
(100123, 'Carlos', 'Pérez'),
(100124, 'María', 'González'),
(100125, 'José', 'Rodríguez'),
(100126, 'Ana', 'Martínez'),
(100127, 'Luis', 'López');

INSERT INTO viaje (vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte) VALUES 
('Buenos Aires', 50, 1, 1, 1500.00),
('Córdoba', 45, 2, 2, 1200.00),
('Mendoza', 40, 3, 3, 1800.00),
('Rosario', 55, 4, 4, 1100.00),
('Bariloche', 60, 5, 5, 2000.00);

INSERT INTO pasajero (pdocumento, pnombre, papellido, ptelefono, idviaje) VALUES 
('12345678', 'Juan', 'Gómez', 1112345678, 1),
('23456789', 'Laura', 'Fernández', 2223456789, 2),
('34567890', 'Pedro', 'Mendoza', 3334567890, 3),
('45678901', 'Sofía', 'Ramírez', 4445678901, 4),
('56789012', 'Diego', 'Silva', 5556789012, 5);
