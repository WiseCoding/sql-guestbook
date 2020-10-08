<?php

declare(strict_types=1);

class showPosts
{
  public function printPosts($amount)
  {
    if (isset($_POST['edit'])) {
      // Edit specific post by it's ID
      $id = (int)$_POST['edit'];

      // Get post
      $pdo = $this->openConnection();
      $row = $pdo->query('SELECT * FROM posts WHERE id = ' . $id . '')->fetch(PDO::FETCH_ASSOC);

      // Print edit form
      echo '<div class="relative px-8 py-4 mx-8 my-4 bg-gray-700 rounded-lg shadow-md">';
      echo   '<form method="POST">';
      echo     '<input type="hidden" name="id" value="' . $row['id'] . '">';
      echo     '<input required type="text" name="title" value="' . $row['title'] . '" title="Edit Title" class="hover:bg-gray-200 hover:text-black focus:outline-none block w-full p-2 mb-2 font-mono text-lg font-bold text-white bg-gray-700 rounded-md shadow-sm">';
      echo     '<textarea required rows="3" name="content" title="Edit Content" class="hover:bg-gray-200 hover:text-black focus:outline-none block w-full p-2 text-justify text-white bg-gray-700 rounded-md shadow-sm">' . $row['content'] . '</textarea>';
      echo     '<div class="flex flex-wrap justify-between mt-3">';
      echo       '<input required type="text" name="author" value="' . $row['author'] . '" title="Edit Author" class="hover:bg-gray-200 hover:text-black focus:outline-none p-2 mb-2 font-mono italic text-green-300 bg-gray-700 rounded-md shadow-sm">';
      echo       '<input required type="text" name="date" value="' . $row['date'] . '" title="Edit Date" class="hover:bg-gray-200 hover:text-black focus:outline-none p-2 mb-2 font-mono italic text-right text-blue-300 bg-gray-700 rounded-md shadow-sm">';
      echo     '</div>';
      echo     '<button value="submit" name="submit" title="Save Edits!" class="hover:bg-red-700 hover:border-gray-400 hover:text-white hover:font-bold absolute bottom-0 right-0 px-1 -mb-1 -mr-1 text-base font-semibold text-green-400 bg-gray-700 border border-gray-700 rounded-md">✅</button>';
      echo   '</form>';
      echo '</div>';
    } else {
      // Get all posts
      $pdo = $this->openConnection();
      $data = $pdo->query('SELECT * FROM posts ORDER BY id DESC LIMIT ' . $amount . '');

      // Print all posts
      foreach ($data as $row) {
        echo '<div class="relative px-8 py-4 mx-8 my-4 text-white bg-gray-700 rounded-lg shadow-md">';
        echo   '<form method="POST">';
        echo     '<button class="hover:bg-green-700 hover:border-gray-400 hover:text-white hover:font-bold absolute top-0 left-0 px-1 -mt-1 -ml-1 text-base font-semibold text-red-400 bg-gray-700 border border-gray-700 rounded-full" value="' . $row['id'] . '" name="edit" title="Edit this entry">✏️</button>';
        echo     '<button class="hover:bg-red-700 hover:border-gray-400 hover:text-white hover:font-bold absolute top-0 right-0 px-1 -mt-1 -mr-1 text-base font-semibold text-red-400 bg-gray-700 border border-gray-700 rounded-full" value="' . $row['id'] . '" name="delete" title="Delete this entry">ⓧ</button>';
        echo   '</form>';
        echo   '<p class="mb-2 font-mono text-lg font-bold">' . $row['title'] . '</p>';
        echo   '<p class="text-justify text-gray-400">' . $row['content'] . '</p>';
        echo   '<div class="flex justify-between mt-3">';
        echo     '<p class="font-mono italic text-green-300" title="Post Author">' . $row['author'] . '</p>';
        echo     '<p class="font-mono italic text-blue-300" title="Posting Date">' . $row['date'] . '</p>';
        echo   '</div>';
        echo '</div>';
      }
    }
  }

  public function deletePost($id)
  {
    // Prepare safe statements
    $sql = "DELETE FROM posts WHERE id = :id";
    $prep = ['id' => $id];

    // Delete data from DB
    $pdo = $this->openConnection();
    $pdo->prepare($sql)->execute($prep);
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

    // LOCAL DB CONNECTION
    /* $dbhost    = "localhost";
    $dbuser    = "root";
    $dbpass    = "*****";
    $db        = "php_guestbook";
    $driverOptions = [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $pdo = new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
    return $pdo; */
  }
}
