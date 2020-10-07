<?php

declare(strict_types=1);

class showPosts
{
  public function printPosts($amount)
  {
    // Get DB posts
    $pdo = $this->openConnection();
    $data = $pdo->query('SELECT * FROM posts ORDER BY id DESC LIMIT ' . $amount . '');

    // Print each post
    foreach ($data as $row) {
      echo '<div class="px-8 py-4 mx-8 my-4 text-white bg-gray-700 rounded-lg shadow-md">';
      echo   '<p class="mb-2 font-mono text-lg font-bold">' . $row['title'] . '</p>';
      echo   '<p class="text-justify text-gray-400">' . $row['content'] . '</p>';
      echo   '<div class="flex justify-between mt-3">';
      echo     '<p class="font-mono italic text-green-300">' . $row['author'] . '</p>';
      echo     '<p class="font-mono italic text-blue-300">' . $row['date'] . '</p>';
      echo   '</div>';
      echo '</div>';
    }
  }

  public function openConnection(): PDO
  {
    $db = parse_url(getenv("postgresql-rugged-74301"));

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
    return $pdo; */
  }
}
