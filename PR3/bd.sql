CREATE TABLE ACTIVIDADES (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    url_ubicacion VARCHAR(500) NOT NULL,
    dificultad VARCHAR(100) NOT NULL DEFAULT 'Fácil' CHECK (dificultad IN ('Fácil', 'Media', 'Difícil')),
    epoca VARCHAR(100) NOT NULL DEFAULT 'Verano' CHECK (epoca IN ('Verano', 'Invierno', 'Otoño', 'Primavera')),
    desnivel INT NOT NULL,
    distancia DECIMAL(5, 3) NOT NULL,
    duracion TIME NOT NULL,
    descripcion TEXT NOT NULL,
    foto_1 VARCHAR(100) NOT NULL,
    foto_2 VARCHAR(100) NOT NULL
);

INSERT INTO ACTIVIDADES (titulo, ubicacion, url_ubicacion, dificultad, epoca, desnivel, distancia, duracion, descripcion, foto_1, foto_2) 
VALUES ('Ruta de los Bolos - Dúrcal', 'Ruta de los bolos, 18650 Dúrcal, Granada', 'https://www.google.com/maps/place/Ruta+de+Los+Bolos/@37.0021274,-3.5669257,17z/data=!3m1!4b1!4m6!3m5!1s0xd71ef0ed545643d:0xd5201a5d5239e61!8m2!3d37.0021274!4d-3.5669257!16s%2Fg%2F11s561zn3n?entry=ttu', 'Media', 'Verano', 250, 12.500, '02:30:00', 
                'La ruta comenzará en la la parada de autobús de Los Mondarinos y proseguirá junto a la Acequia de Mahina
                hasta llegar a la altura del Río Dúrcal. Posteriormente llegaremos a la acequia en su parte de montaña y
                proseguiremos hasta el inicio de la acequia.

                Poco después encontraremos el Salto de Agua del Canal de Fuga desde donde continuaremos río arriba hasta
                llegar al Salto de Agua de Los Bolos. La Ruta de los Bolos es una de las rutas más conocidas de la
                provincia de Granada. Se trata de una ruta de senderismo de dificultad media que discurre por el
                municipio de Dúrcal.

                La ruta tiene una longitud de 12 km y una duración aproximada de 4 horas. El punto de partida es el área
                recreativa de la Charca de Suárez. La ruta es circular y discurre por un río.

                La ruta comienza en el área recreativa de la Charca de Suárez. El sendero discurre por un paraje natural
                de gran belleza. El recorrido es circular y discurre por un terreno de montaña. El sendero está bien
                señalizado y es fácil de seguir. La ruta es apta para toda la familia y es ideal para disfrutar de un
                día en la naturaleza.',
                '../icon/bolos1.jpg',
                '../icon/bolos2.jpg');

INSERT INTO ACTIVIDADES (titulo, ubicacion, url_ubicacion, dificultad, epoca, desnivel, distancia, duracion, descripcion, foto_1, foto_2) 
VALUES ('Ruta de los Cahorros - Monachil', 'Los Cahorros, 18193 Monachil, Granada', '                https://www.google.es/maps/place/Ruta+de+Los+Cahorros/@37.1292593,-3.5259783,17z/data=!3m1!4b1!4m6!3m5!1s0xd71e45bc890eddf:0x77158a222c5f862b!8m2!3d37.1292551!4d-3.5234034!16s%2Fg%2F11crxq1m7z?entry=ttu', 'Media', 'Verano', 300, 8.000, '03:00:00', 
                'La Ruta de los Cahorros es una impresionante ruta de senderismo situada en el municipio de Monachil, en la provincia de Granada, España. La ruta sigue el curso del río Monachil y pasa por una serie de desfiladeros y puentes colgantes que ofrecen unas vistas espectaculares.

                El sendero comienza en el puente colgante de los Cahorros y sigue el río Monachil a lo largo de su curso, atravesando varios puentes colgantes y desfiladeros estrechos. La ruta ofrece la oportunidad de disfrutar de la naturaleza en su estado más puro, con paisajes impresionantes y una gran variedad de flora y fauna.

                La ruta tiene una longitud de aproximadamente 8 kilómetros y una duración de unas 3 horas, aunque puede variar según el ritmo de cada caminante. Es importante llevar calzado adecuado y agua suficiente, ya que el terreno puede ser irregular y la ruta puede ser exigente en algunos tramos.

                La Ruta de los Cahorros es una opción ideal para los amantes del senderismo y la naturaleza, y ofrece una experiencia única en uno de los parajes más bellos de la provincia de Granada.', 
                '../icon/cahorros1.jpg', 
                '../icon/cahorros2.jpeg');

INSERT INTO ACTIVIDADES (titulo, ubicacion, url_ubicacion, dificultad, epoca, desnivel, distancia, duracion, descripcion, foto_1, foto_2) 
VALUES ('Ruta del Gollizno - Moclín', 'Moclín, Granada', 'https://www.google.es/maps/search/ruta+del+gollizno/@37.3320096,-3.7943711,15z/data=!3m1!4b1?entry=ttu', 'Media', 'Primavera', 400, 10.000, '03:30:00', 
                'La Ruta del Gollizno es una impresionante ruta de senderismo situada en el municipio de Moclín, en la provincia de Granada, España. La ruta sigue un sendero que serpentea por la sierra de Moclín y ofrece unas vistas panorámicas espectaculares.

                El sendero comienza en el centro de Moclín y asciende por la sierra, pasando por antiguos caminos empedrados y bosques de encinas y pinos. A lo largo del recorrido, se pueden encontrar diversas especies de flora y fauna autóctonas, así como restos arqueológicos de antiguas fortificaciones.

                La ruta tiene una longitud de aproximadamente 10 kilómetros y una duración de unas 3 horas y media, aunque puede variar según el ritmo de cada caminante y las condiciones del terreno. Es importante llevar calzado adecuado y agua suficiente, ya que el terreno puede ser irregular y la ruta puede ser exigente en algunos tramos.

                La Ruta del Gollizno es una opción ideal para los amantes del senderismo y la naturaleza, y ofrece una experiencia única en uno de los parajes más bellos de la provincia de Granada.', 
                '../icon/gollizno1.jpg', 
                '../icon/gollizno2.jpeg');

/* HACER TABLAS REDES, BONUS, FOTOS Y COMENTARIOS */

CREATE TABLE COMENTARIOS (
    id INT,
    id_comentario INT AUTO_INCREMENT,
    email VARCHAR(100),
    comentario TEXT,
    nombre VARCHAR(100),
    fecha VARCHAR(50),
    FOREIGN KEY (id) REFERENCES ACTIVIDADES(id),
    PRIMARY KEY (id_comentario)
);

CREATE TABLE REDES (
    id INT,
    facebook VARCHAR(250),
    twitter VARCHAR(100),
    FOREIGN KEY (id) REFERENCES ACTIVIDADES(id),
    PRIMARY KEY (id)
);

INSERT INTO `REDES`(`id`, `facebook`, `twitter`) VALUES ('1','https://www.facebook.com/bolodurcal/?locale=es_LA','https://twitter.com/durcalnet?lang=es');
INSERT INTO `REDES`(`id`, `facebook`, `twitter`) VALUES ('2','https://www.facebook.com/gpsmalaga/videos/los-cahorros-de-monachil-granada-vive-la-monta%C3%B1a/684000555712776/?locale=es_LA','https://twitter.com/loscahorros');
INSERT INTO `REDES`(`id`, `facebook`, `twitter`) VALUES ('3','https://www.facebook.com/groups/595618240585591/','https://twitter.com/lolasanmar/status/1576257723674820608');

CREATE TABLE BONUS (
    id INT,
    id_bonus INT AUTO_INCREMENT,
    img_bonus VARCHAR(100),
    desc_bonus VARCHAR(100),
    FOREIGN KEY (id) REFERENCES ACTIVIDADES(id),
    PRIMARY KEY (id_bonus)
);

INSERT INTO `BONUS`(`id`, `img_bonus`, `desc_bonus`) VALUES ('1','../icon/perro.png','Mascotas bienvenidas');
INSERT INTO `BONUS`(`id`, `img_bonus`, `desc_bonus`) VALUES ('1','../icon/agua.png','Ruta refrescante');

INSERT INTO `BONUS`(`id`, `img_bonus`, `desc_bonus`) VALUES ('2','../icon/perro.png','Mascotas bienvenidas');
INSERT INTO `BONUS`(`id`, `img_bonus`, `desc_bonus`) VALUES ('2','../icon/kart.png','Aparcamiento disponible');

INSERT INTO `BONUS`(`id`, `img_bonus`, `desc_bonus`) VALUES ('3','../icon/kart.png','Aparcamiento cercano');
INSERT INTO `BONUS`(`id`, `img_bonus`, `desc_bonus`) VALUES ('3','../icon/nieve.png','Nieve en temporada');

CREATE TABLE FOTOS (
    id INT,
    img VARCHAR(100),
    FOREIGN KEY (id) REFERENCES ACTIVIDADES(id),
    PRIMARY KEY (img)
);

INSERT INTO `FOTOS`(`id`, `img`) VALUES ('1','../icon/bolos1.jpg');
INSERT INTO `FOTOS`(`id`, `img`) VALUES ('1','../icon/bolos2.jpg');
INSERT INTO `FOTOS`(`id`, `img`) VALUES ('1','../icon/bolos3.jpg');
INSERT INTO `FOTOS`(`id`, `img`) VALUES ('1','../icon/bolos4.jpg');
INSERT INTO `FOTOS`(`id`, `img`) VALUES ('1','../icon/bolos5.jpg');

INSERT INTO `FOTOS`(`id`, `img`) VALUES ('2','../icon/cahorros1.jpg');
INSERT INTO `FOTOS`(`id`, `img`) VALUES ('2','../icon/cahorros2.jpeg');

INSERT INTO `FOTOS`(`id`, `img`) VALUES ('3','../icon/gollizno1.jpg');
INSERT INTO `FOTOS`(`id`, `img`) VALUES ('3','../icon/gollizno2.jpeg');

CREATE TABLE NOTICIAS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    img VARCHAR(100) NOT NULL
);

INSERT INTO `NOTICIAS`(`titulo`, `descripcion`, `img`) VALUES ('Desprendimiento','Se desprenden rocas en un piuente antes del desvío a Tózar.','../icon/desprendimiento.jpeg');

CREATE TABLE PALABRAS_PROHIBIDAS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    palabra VARCHAR(100) NOT NULL
);

INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('mierda');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('caca');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('pene');
INSERT INTO `PALABRAS_PROHHIBIDAS`(`palabra`) VALUES ('polla');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('coño');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('puta');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('zorra');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('cabron');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('gilipollas');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('idiota');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('tonto');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('subnormal');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('retrasado');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('mongolo');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('maricon');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('marica');
INSERT INTO `PALABRAS_PROHIBIDAS`(`palabra`) VALUES ('homosexual');

CREATE TABLE CLAVE_MAPAS (
    id INT PRIMARY KEY ,
    clave VARCHAR(400) NOT NULL,
    FOREIGN KEY (id) REFERENCES ACTIVIDADES(id)
);

INSERT INTO `CLAVE_MAPAS`(`id`, `clave`) VALUES ('1','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3186.321432690251!2d-3.5669256999999996!3d37.00212739999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71ef0ed545643d%3A0xd5201a5d5239e61!2sRuta%20de%20Los%20Bolos!5e0!3m2!1ses!2ses!4v1712697289210!5m2!1ses!2ses');
INSERT INTO `CLAVE_MAPAS`(`id`, `clave`) VALUES ('2','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3180.9857056679084!2d-3.5234034000000003!3d37.129255099999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd71e45bc890eddf%3A0x77158a222c5f862b!2sRuta%20de%20Los%20Cahorros!5e0!3m2!1ses!2ses!4v1712699182059!5m2!1ses!2ses');
INSERT INTO `CLAVE_MAPAS`(`id`, `clave`) VALUES ('3','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12689.77368467618!2d-3.7943711290000404!3d37.332009615420795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6dfdb5ca919131%3A0x4b7aa761d89841dc!2sRuta%20del%20Gollizno!5e0!3m2!1ses!2ses!4v1712699263768!5m2!1ses!2ses');

