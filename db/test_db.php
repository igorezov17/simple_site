<?php
require_once 'db/db.php';
require_once 'Func/func.php';

const Create_table_menu = '
    CREATE TABLE IF NOT EXISTS menu (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        parent_id INT UNSIGNED,
        title VARCHAR(255) NOT NULL,
        url VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)
    )
';

// вставка нового элемнта в БД
const SQL_INSERT_MENU_ITEM = '
    INSERT INTO menu(parent_id, title, url) VALUES (?, ?, ?)
';

// редактирование нового элемнта в БД
const SQL_UPDATE_MENU_ITEM = '
    UPDATE manu SET 
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