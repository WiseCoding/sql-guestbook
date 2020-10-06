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
    $db = parse_url(getenv("https://data.heroku.com/datastores/143a802a-fb86-4c11-a6af-b2223ba2747f#administration    postgres://eiyngzmixlorqx:462af116bd57e87e53e6671a05d8955c5b65b79db70e9247d3ce03a7fcbfb2ea@ec2-54-155-22-153.eu-west-1.compute.amazonaws.com:5432/de7j952d2j8cmk"));

    $pdo = new PDO("pgsql:" . sprintf(
      "host=%s;port=%s;user=%s;password=%s;dbname=%s",
      $db["ec2-54-155-22-153.eu-west-1.compute.amazonaws.com"],
      $db["5432"],
      $db["eiyngzmixlorqx"],
      $db["462af116bd57e87e53e6671a05d8955c5b65b79db70e9247d3ce03a7fcbfb2ea"],
      ltrim($db["path"], "/")
    ));
    return $pdo;

    /* // DB Login Info
    $dbhost    = "ec2-54-155-22-153.eu-west-1.compute.amazonaws.com";
    $dbuser    = "eiyngzmixlorqx";
    $dbpass    = "462af116bd57e87e53e6671a05d8955c5b65b79db70e9247d3ce03a7fcbfb2ea";
    $db        = "de7j952d2j8cmk";

    // Options
    $driverOptions = [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    // Instantiate & return
    $pdo = new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
    return $pdo; */
  }
}
