<?php

    require 'database.php';
    exec("~/Library/Containers/MAMP/mysql/bin/mysql -u $DB_USER  -p$DB_PASSWORD < components/database/camagru.sql");
    echo "Done!\n";

