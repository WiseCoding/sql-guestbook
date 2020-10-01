<?php

declare(strict_types=1);

class savePosts
{
  private $post = array();

  public function __construct()
  {
    // convert smileys
    $_POST['title'] = $this->addEmojis($_POST['title']);
    $_POST['content'] = $this->addEmojis($_POST['content']);

    // filter profanity
    $_POST['title'] = $this->filterProfanity($_POST['title']);
    $_POST['content'] = $this->filterProfanity($_POST['content']);

    // compose entry message
    $this->post = array(
      'title' => htmlspecialchars($_POST['title']),
      'content' => htmlspecialchars($_POST['content']),
      'author' => htmlspecialchars($_POST['author']),
      'date' => htmlspecialchars($_POST['date']),
    );
  }

  public function getPost()
  {
    return $this->post;
  }

  public function storePost()
  {
    try {
      // Saving location entries
      $path = "./data/entries.json";
      // Get previous entries
      $entries = file_get_contents($path);
      $entries = json_decode($entries, true);
      // Add new entry
      $entries[] = $this->post;
      // Encode entries
      $entries = json_encode($entries, JSON_PRETTY_PRINT);
      // Save entries
      file_put_contents($path, $entries);
      return "Entry saved";
    } catch (\Throwable $th) {
      return 'Error: ' .  $th . "<br />";
    }
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
}
