<?php
// Тестовое задание Инлайн

// Строка подключения к бд
$connect = mysqli_connect("localhost", "root", "root", "testing");

// Функция переноса Json в таблицы
function jsonToSqlPosts()
{

global $connect;
$count = 0;

// Переменная с json
$data = file_get_contents('https://jsonplaceholder.typicode.com/posts');

// Массив с данными 
$array = json_decode($data, true);

// Цикл с добавлением записей в таблицу
foreach($array as $row){

    // Добавление записей в таблицу
    mysqli_query($connect, "INSERT INTO tbl_posts(userId, id, title, body) 
    VALUES('".$row["userId"]."',
    '".$row["id"]."',
    '".$row["title"]."',
    '".$row["body"]."')");

    // Подсчет записей в таблице
    $count++;
}
    // Возвращение кол-ва записей
    return $count;
}

// Функция переноса Json в таблицы
function jsonToSqlComments()
{
global $connect;
$count = 0;

// Переменная с json
$data = file_get_contents('https://jsonplaceholder.typicode.com/comments');

// Массив с данными 
$array = json_decode($data, true);

// Цикл с добавлением записей в таблицу
foreach($array as $row){
    
    // Добавление записей в таблицу
    mysqli_query($connect, "INSERT INTO tbl_comments(postId, id, name, email, body)
    VALUES('".$row["postId"]."',
    '".$row["id"]."',
    '".$row["name"]."',
    '".$row["email"]."',
    '".$row["body"]."')");

    // Подсчет записей в таблице
    $count++;
}
    // Возвращение кол-ва записей
    return $count;
}

// Вывод результата
echo "Загружено ", jsonToSqlPosts(), " записей и ", jsonToSqlComments(), " комментариев";