<?php

declare(strict_types=1);

class savePosts
{
  private $post = array();
  private $title, $content, $author, $date;

  public function __construct()
  {
    // convert smileys
    $_POST['title'] = $this->addEmojis($_POST['title']);
    $_POST['content'] = $this->addEmojis($_POST['content']);

    // filter profanity
    $_POST['title'] = $this->filterProfanity($_POST['title']);
    $_POST['content'] = $this->filterProfanity($_POST['content']);

    // save data
    $this->title = htmlspecialchars($_POST['title']);
    $this->content = htmlspecialchars($_POST['content']);
    $this->author = htmlspecialchars($_POST['author']);
    $this->date = htmlspecialchars($_POST['date']);
  }

  public function getPost()
  {
    return $this->post;
  }

  public function storePost()
  {
    // Prepare safe statements
    $sql = "INSERT INTO posts(title, content, author, date) VALUES (:title, :content, :author, :date)";
    $prep = ['title' => $this->title, 'content' => $this->content, 'author' => $this->author, 'date' => $this->date];

    // Add data to DB
    $pdo = $this->openConnection();
    $pdo->prepare($sql)->execute($prep);
  }

  public function addEmojis($input): string
  {
    $smileys = [':-)', ':)', ';-)', ';)', ':-(', ':(', ':\'-(', ':\'(', ':-D', ':D', ':-p', ':p'];
    $emojis = ['😀', '😀', '😉', '😉', '😟', '😟', '😭', '😭', '😂', '😂', '😜', '😜'];

    for ($i = 0; $i < count($smileys); $i++) {
      $input = str_replace($smileys[$i], $emojis[$i], $input);
    }

    return $input;
  }

  public function filterProfanity($input)
  {
    $words = ['fuck', 'shit', 'piss', 'turd', 'ass', 'becode', 'BeCode', 'Becode'];
    $filter = '❤️';

    for ($i = 0; $i < count($words); $i++) {
      $input = str_replace($words[$i], $filter, $input);
    }

    return $input;
  }

  public function openConnection(): PDO
  {
    // DB Login Info
    $dbhost    = "localhost";
    $dbuser    = "root";
    $dbpass    = "rootingforyou";
    $db        = "php_guestbook";

    // Options
    $driverOptions = [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    // Instantiate & return
    $pdo = new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
    return $pdo;
  }
}
