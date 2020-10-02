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

    // Range selected by user
    /* $high = count($this->posts);
    if ((count($this->posts) - $amount) < 0) {
      $low = 0;
    } else {
      $low = count($this->posts) - $amount;
    } */

    // Print each post, last post first, within range
    /* for ($i = $high - 1; $i >= $low; $i--) {
      echo '<div class="px-8 py-4 mx-8 my-4 text-white bg-gray-700 rounded-lg shadow-md">';
      echo  '<p class="mb-2 font-mono text-lg font-bold">' . $this->posts[$i]['title'] . '</p>';
      echo  '<p class="text-justify text-gray-400">' . $this->posts[$i]['content'] . '</p>';
      echo  '<div class="flex justify-between mt-3">';
      echo   '<p class="font-mono italic text-green-300">' . $this->posts[$i]['author'] . '</p>';
      echo   '<p class="font-mono italic text-blue-300">' . $this->posts[$i]['date'] . '</p>';
      echo  '</div>';
      echo '</div>';
    } */
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
