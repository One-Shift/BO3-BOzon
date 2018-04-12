<?php

$cfg->system = new stdClass();

$cfg->system->minify = TRUE;
$cfg->system->pub = TRUE;
$cfg->system->restricted = TRUE;
$cfg->system->timezone = "Europe/Lisbon"; // to disable set with FALSE

$cfg->system->sitename = "";
$cfg->system->owner = "";

$cfg->system->protocol = "https"; // you can use http instead
$cfg->system->domain = "yourdomain.here";
$cfg->system->path = "Path-here ex.: /new or /old";
$cfg->system->path_bo = "{$cfg->system->path}/backoffice";

$cfg->system->version = "3.2.4";
$cfg->system->sub_version = "RC";

$cfg->system->key = "GJTBpKregE9WgXc";

$cfg->system->cookie = "cookie";
$cfg->system->cookie_time = 86400; // 86400 represents 1 day, 60 seconds * 60 minutes * 24 hours.

$cfg->system->analytics = "";
