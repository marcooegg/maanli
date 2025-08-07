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

