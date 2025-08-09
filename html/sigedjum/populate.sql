DELETE FROM country;
DELETE FROM `state`;
DELETE FROM city;
DELETE FROM dependency;
DELETE FROM `partner`;
DELETE FROM users;
DELETE FROM `groups`;
DELETE FROM user_group;
DELETE FROM case_type;
DELETE FROM `case`;
DELETE FROM appointment;
DELETE FROM notes;
DELETE FROM attachment;

INSERT INTO
    partner (name, email)
VALUES
    ('Administrador', 'admin@juri.com.ar');

INSERT INTO
    users (username, password, partner_id)
VALUES
    (
        'admin',
        'admin123',
        (
            SELECT
                id
            FROM
                partner
            WHERE
                email = 'admin@juri.com.ar'
            LIMIT
                1
        )
    );

INSERT INTO
    `groups` (name, description)
VALUES
    ('Administrators', 'Group for system administrators');

INSERT INTO 
    user_group (user_id, group_id)
VALUES
    (
        (
            SELECT
                id
            FROM
                users
            WHERE
                username = 'admin'
            LIMIT
                1
        ),
        (
            SELECT
                id
            FROM
                `groups`
            WHERE
                name = 'Administrators'
            LIMIT
                1
        )
    );

-- insert Countries from latin america
INSERT INTO
    country (name, code)
VALUES
    ('Argentina', 'AR'),
    ('Brazil', 'BR'),
    ('Chile', 'CL'),
    ('Colombia', 'CO'),
    ('Paraguay', 'PY'),
    ('Uruguay', 'UY');
-- Guardar los ids de los países en variables de sesión
SET @ar_id = (SELECT id FROM country WHERE code = 'AR');
SET @br_id = (SELECT id FROM country WHERE code = 'BR');
SET @cl_id = (SELECT id FROM country WHERE code = 'CL');
SET @co_id = (SELECT id FROM country WHERE code = 'CO');
SET @uy_id = (SELECT id FROM country WHERE code = 'UY');
SET @py_id = (SELECT id FROM country WHERE code = 'PY');

-- insert States
INSERT INTO
    `state` (name, country_id)
VALUES
    -- Argentina
    ('Buenos Aires', @ar_id),
    ('CABA', @ar_id),
    ('Cordoba', @ar_id),
    ('Santa Fe', @ar_id),
    ('Mendoza', @ar_id),
    ('Tucuman', @ar_id),
    ('Salta', @ar_id),
    ('Entre Rios', @ar_id),
    ('Santiago del Estero', @ar_id),
    ('Misiones', @ar_id),
    ('Neuquen', @ar_id),
    ('Rio Negro', @ar_id),
    ('Chaco', @ar_id),
    ('Formosa', @ar_id),
    ('Jujuy', @ar_id),
    ('La Pampa', @ar_id),
    ('La Rioja', @ar_id),
    ('San Juan', @ar_id),
    ('San Luis', @ar_id),
    ('Santa Cruz', @ar_id),
    ('Santiago del Estero', @ar_id),
    ('Tierra del Fuego', @ar_id),
    ('Chubut', @ar_id),

    -- Brasil
    ('Acre', @br_id),
    ('Alagoas', @br_id),
    ('Amapá', @br_id),
    ('Amazonas', @br_id),
    ('Bahia', @br_id),
    ('Ceará', @br_id),
    ('Distrito Federal', @br_id),
    ('Espírito Santo', @br_id),
    ('Goiás', @br_id),
    ('Maranhão', @br_id),
    ('Mato Grosso', @br_id),
    ('Mato Grosso do Sul', @br_id),
    ('Minas Gerais', @br_id),
    ('Pará', @br_id),
    ('Paraíba', @br_id),
    ('Paraná', @br_id),
    ('Pernambuco', @br_id),
    ('Piauí', @br_id),
    ('Rio de Janeiro', @br_id),
    ('Rio Grande do Norte', @br_id),
    ('Rio Grande do Sul', @br_id),
    ('Rondônia', @br_id),
    ('Roraima', @br_id),
    ('Santa Catarina', @br_id),
    ('São Paulo', @br_id),
    ('Sergipe', @br_id),
    ('Tocantins', @br_id),

    -- Uruguay
    ('Artigas', @uy_id),
    ('Canelones', @uy_id),
    ('Cerro Largo', @uy_id),
    ('Colonia', @uy_id),
    ('Durazno', @uy_id),
    ('Flores', @uy_id),
    ('Florida', @uy_id),
    ('Lavalleja', @uy_id),
    ('Maldonado', @uy_id),
    ('Montevideo', @uy_id),
    ('Paysandú', @uy_id),
    ('Río Negro', @uy_id),
    ('Rivera', @uy_id),
    ('Rocha', @uy_id),
    ('Salto', @uy_id),
    ('San José', @uy_id),
    ('Soriano', @uy_id),
    ('Tacuarembó', @uy_id),
    ('Treinta y Tres', @uy_id),

    -- Paraguay
    ('Asunción', @py_id),
    ('Concepción', @py_id),
    ('San Pedro', @py_id),
    ('Cordillera', @py_id),
    ('Guairá', @py_id),
    ('Caaguazú', @py_id),
    ('Caazapá', @py_id),
    ('Itapúa', @py_id),
    ('Misiones', @py_id),
    ('Paraguarí', @py_id),
    ('Alto Paraná', @py_id),
    ('Central', @py_id),
    ('Ñeembucú', @py_id),
    ('Amambay', @py_id),
    ('Canindeyú', @py_id),
    ('Presidente Hayes', @py_id),
    ('Alto Paraguay', @py_id),
    ('Boquerón', @py_id),

    -- Colombia
    ('Amazonas', @co_id),
    ('Antioquia', @co_id),
    ('Arauca', @co_id),
    ('Atlántico', @co_id),
    ('Bolívar', @co_id),
    ('Boyacá', @co_id),
    ('Caldas', @co_id),
    ('Caquetá', @co_id),
    ('Casanare', @co_id),
    ('Cauca', @co_id),
    ('Cesar', @co_id),
    ('Chocó', @co_id),
    ('Córdoba', @co_id),
    ('Cundinamarca', @co_id),
    ('Guainía', @co_id),
    ('Guaviare', @co_id),
    ('Huila', @co_id),
    ('La Guajira', @co_id),
    ('Magdalena', @co_id),
    ('Meta', @co_id),
    ('Nariño', @co_id),
    ('Norte de Santander', @co_id),
    ('Putumayo', @co_id),
    ('Quindío', @co_id),
    ('Risaralda', @co_id),
    ('San Andrés y Providencia', @co_id),
    ('Santander', @co_id),
    ('Sucre', @co_id),
    ('Tolima', @co_id),
    ('Valle del Cauca', @co_id),
    ('Vaupés', @co_id),
    ('Vichada', @co_id),

    -- Chile
    ('Arica y Parinacota', @cl_id),
    ('Tarapacá', @cl_id),
    ('Antofagasta', @cl_id),
    ('Atacama', @cl_id),
    ('Coquimbo', @cl_id),
    ('Valparaíso', @cl_id),
    ('Metropolitana de Santiago', @cl_id),
    ('Libertador General Bernardo OHiggins', @cl_id),
    ('Maule', @cl_id),
    ('Ñuble', @cl_id),
    ('Biobío', @cl_id),
    ('La Araucanía', @cl_id),
    ('Los Ríos', @cl_id),
    ('Los Lagos', @cl_id),
    ('Aysén del General Carlos Ibáñez del Campo', @cl_id),
    ('Magallanes y de la Antártica Chilena', @cl_id);

SET @misiones_id = (SELECT id FROM `state` WHERE name = 'Misiones' AND country_id = @ar_id LIMIT 1);

INSERT INTO
    city (name, postal_code, state_id)
VALUES
    -- cities in misiones Argentina
    ('Posadas', '3300', @misiones_id),
    ('Oberá', '3360', @misiones_id),
    ('Eldorado', '3380', @misiones_id),
    ('Puerto Iguazú', '3370', @misiones_id),
    ('San Ignacio', '3315', @misiones_id),
    ('Apóstoles', '3382', @misiones_id),
    ('Leandro N. Alem', '3318', @misiones_id),
    ('Montecarlo', '3319', @misiones_id),
    ('Candelaria', '3305', @misiones_id),
    ('Garupá', '3307', @misiones_id),
    ('Puerto Rico', '3372', @misiones_id),
    ('San Javier', '3312', @misiones_id),
    ('Cerro Azul', '3311', @misiones_id),
    ('Campo Viera', '3364', @misiones_id),
    ('Puerto Esperanza', '3366', @misiones_id),
    ('Colonia Delicia', '3368', @misiones_id),
    ('Dos de Mayo', '3362', @misiones_id),
    ('El Soberbio', '3374', @misiones_id),
    ('Guaraní', '3384', @misiones_id),
    ('Iguazú', '3376', @misiones_id),
    ('Jardín América', '3316', @misiones_id),
    ('Leandro N. Alem', '3318', @misiones_id),
    ('Montecarlo', '3319', @misiones_id),
    ('Oberá', '3360', @misiones_id),
    ('Posadas', '3300', @misiones_id),
    ('Puerto Iguazú', '3370', @misiones_id),
    ('San Ignacio', '3315', @misiones_id),
    ('San Javier', '3312', @misiones_id),
    ('Santo Pipó', '3314', @misiones_id),
    ('Villa Cabello', '3306', @misiones_id),
    ('Villa Bonita', '3308', @misiones_id);


-- Insert tipos de casos
INSERT INTO case_type (name, description)
    VALUES
        ('Civil', 'Casos relacionados con asuntos civiles.'),
        ('Violencia', 'Casos relacionados con violencia familiar.'),
        ('Comercial', 'Casos relacionados con asuntos comerciales.'),
        ('Divorcio', 'Casos relacionados con divorcios.'),
        ('Protección de persona', 'Casos relacionados con la protección de personas.'),
        ('Ambiental', 'Casos relacionados con asuntos ambientales.');

-- Insert Dependencies (dependencias del poder judicial de Misiones Argentina)
INSERT INTO dependency (name, description)
    VALUES
        ('Poder Judicial de Misiones', 'Órgano encargado de la administración de justicia en la provincia de Misiones.'),
        ('Ministerio Público Fiscal', 'Institución encargada de la investigación y persecución de delitos en Misiones.'),
        ('Defensoría General', 'Organismo que brinda defensa legal a personas que no pueden costear un abogado en Misiones.'),
        ('Cámara de Apelaciones en lo Civil y Comercial', 'Tribunal que revisa las decisiones de los juzgados civiles y comerciales en Misiones.'),
        ('Cámara de Apelaciones en lo Penal', 'Tribunal que revisa las decisiones de los juzgados penales en Misiones.'),
        ('Juzgado de Primera Instancia en lo Civil y Comercial', 'Juzgado encargado de resolver asuntos civiles y comerciales en primera instancia en Misiones.'),
        ('Juzgado de Primera Instancia en lo Penal', 'Juzgado encargado de resolver asuntos penales en primera instancia en Misiones.'),
        ('Juzgado de Familia', 'Juzgado especializado en asuntos familiares y de menores en Misiones.'),
        ('Juzgado Laboral', 'Juzgado encargado de resolver conflictos laborales y de seguridad social en Misiones.'),
        ('Oficina de Mediación', 'Entidad que facilita la resolución alternativa de conflictos mediante la mediación en Misiones.'),
        ('Defensoria en lo civil y comercial numero 1', 'Defensoria que brinda asistencia legal en asuntos civiles y comerciales en Misiones.'),
        ('Defensoria en lo civil y comercial numero 2', 'Defensoria que brinda asistencia legal en asuntos civiles y comerciales en Misiones.'),
        ('Defensoria en lo civil y comercial numero 3', 'Defensoria que brinda asistencia legal en asuntos civiles y comerciales en Misiones.'),
        ('Defensoria en lo civil y comercial numero 4', 'Defensoria que brinda asistencia legal en asuntos civiles y comerciales en Misiones.'),
        ('Defensoria en lo civil y comercial numero 5', 'Defensoria que brinda asistencia legal en asuntos civiles y comerciales en Misiones.'),
        ('Defensoria en lo civil y comercial numero 6', 'Defensoria que brinda asistencia legal en asuntos civiles y comerciales en Misiones.'),
        ('Defensoria en lo civil y comercial numero 7', 'Defensoria que brinda asistencia legal en asuntos civiles y comerciales en Misiones.');