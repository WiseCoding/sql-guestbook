<?php

declare(strict_types=1);

use Snipe\BanBuilder\CensorWords;

require 'vendor/autoload.php';
$censor = new CensorWords();

// FORM SUBMIT NEW ENTRY
if (isset($_POST['submit']) && $_POST['submit'] === 'submit') {

  // FILTER PROFANITY
  $_POST['content'] = $censor->censorString($_POST['content'])['clean'];

  // INSTANTIATE POST
  $post = new savePosts();

  // SAVE POST
  $post->storePost();
  // $post->printPosts();
}

// GET & SHOW OLD POSTS
$showPosts = new showPosts();

// SHOW # AMOUNT OF POSTS
if (isset($_POST['reviews'])) {
  $seeAmount = (int)$_POST['reviews'];
} else {
  $seeAmount = 10;
}
