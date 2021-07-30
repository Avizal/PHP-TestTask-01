<?php

if (is_file('config.php')) {
	require_once('config.php');
} else {
    exit('Not exist file config.php');
}

if (is_file(DIR_SYSTEM . 'startup.php')) {
	require_once(DIR_SYSTEM . 'startup.php');
} else {
    exit('Not exist file startup.php');
}
