<?php

setcookie('logged-id',NULL,time()-3600,'/');

header('Location: ../login/');