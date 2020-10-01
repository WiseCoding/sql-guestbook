<?php

declare(strict_types=1);
session_start();

// MODEL
include "./model/showPosts.php";
include "./model/savePosts.php";

// CONTROLLER
include "./controller/controller.php";

// VIEW
include "./view/view.php";
