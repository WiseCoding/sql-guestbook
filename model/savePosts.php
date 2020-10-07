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
    try {
      $db = parse_url(getenv("DATABASE_URL"));

      $pdo = new PDO("pgsql:" . sprintf(
        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
      ));
    } catch (\Throwable $th) {
      echo 'Caught exception: ',  $th->getMessage(), "\n";
    }
    return $pdo;
  }
}
