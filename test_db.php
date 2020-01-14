<?php
require_once 'db/db.php';
require_once 'Func/func.php';

const Create_table = '
    CREATE TABLE if NOT EXISTS menu (
        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
        parent_id = INT UNSIGNED,
        title VARCHAR(255) NOT NULL,
        url VARCHAR(500) NOT NULL,
        PRIMARY KEY(id)
    );
';

// вставка нового элемнта в БД
const SQL_INSERT_MENU_ITEM = '
    INSERT INTO menu(parent_id, title, url) VALUES (?, ?, ?)
';

const SQL_INSERT_MENU_ITEM1 = '
    INSERT INTO menu(parent_id, title, url) VALUES (:parent_id, :title, :url)
';

// редактирование нового элемнта в БД
const SQL_UPDATE_MENU_ITEM = '
    UPDATE menu SET 
        parent_id = :parent_id,
        title = :title,
        url = :url
    WHERE 
        id = :id
';
 
//получение всего меню
const SQL_GET_MENU = '
    SELECT id, parent_id, title, url FROM menu
';


//получение конкретного элемента меню
const SQL_GET_MENU_ITEM = '
    SELECT id, parent_id, title, url FROM menu WHERE id = :id
';


// создание таблицы nomencl
const SQL_CREATE_NOMEN = '
    CREATE TABLE if NOT EXISTS nomencl (
        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
        name VARCHAR(50) NOT NULL,
        PRIMARY KEY(id)
    );
    ';

    const SQL_CREATE_DESCRIBE = '
    CREATE TABLE if NOT EXISTS descrip (
        id INT UNSIGNED AUTO_INCREMENT NOT NULL,
        describ VARCHAR(50) NOT NULL,
        PRIMARY KEY(id)
    );
    ';

//заполгнение двух таблиц
const SQL_INSERT_NOMEN = '
    INSERT INTO nomencl(name) VALUES (:name)
';

const SQL_INSERT_descrip = '
    INSERT INTO descrip(describ) VALUES (:text)
';

const SQL_UPDATE_nomencl = '
    UPDATE nomencl SET 
        name = :name
    WHERE 
        id = :id
';