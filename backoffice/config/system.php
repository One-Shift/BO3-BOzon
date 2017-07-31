<?php

$cfg->system = new stdClass();

$cfg->system->minify = TRUE;
$cfg->system->pub = TRUE;
$cfg->system->restricted = TRUE;
$cfg->system->timezone = "Europe/Lisbon"; // to disable set with FALSE

$cfg->system->sitename = "";
$cfg->system->owner = "";

$cfg->system->protocol = "http"; // you can use https instead
$cfg->system->path = "Path-here ex.: /new or /old";
$cfg->system->path_bo = "Path-above + bo folder ex.: /new/backoffice";

$cfg->system->version = "3.0.1";
$cfg->system->sub_version = "beta";

$cfg->system->key = "GJTBpKregE9WgXc";

$cfg->system->cookie = "cookie";
$cfg->system->cookie_time = 320;

$cfg->system->analytics = "";
