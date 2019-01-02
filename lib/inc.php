<?php
require('uuid-1.0.0/src/Rhumsaa/Uuid/Uuid.php');

if(isset($_GET['file']))
{
    require($_GET['file']);
}

use Rhumsaa\Uuid;