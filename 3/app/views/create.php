<?php

echo "...";
require_once '../controllers/CommentsController.php';
require_once "../models/Comment.php";
$controller = new CommentsController();
$controller->record();