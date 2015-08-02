<?php
include_once($_SERVER['FILE_PREFIX']."/project_list/project_object.php") ;
$github_uri   = "https://github.com/aidansean/eye_of_argon" ;
$blogpost_uri = "http://aidansean.com/projects/?tag=eye_of_argon" ;
$project = new project_object("eye_of_argon", "Eye of Argon acronym generator", "https://github.com/aidansean/eye_of_argon", "http://aidansean.com/projects/?tag=eye_of_argon", "eye_of_argon/images/project.jpg", "eye_of_argon/images/project_bw.jpg", "This project was made to demonstrate a point.  A student said that they doubted I could make a simple application in an afternoon, so within about an hour I had made this is.  It takes a string from the user and makes a phrase using word from the Eye of Argon to make an initialisation.", "Frivolous", "HTML,MySQL,PHP") ;
?>