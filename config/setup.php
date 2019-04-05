<?php

    require 'database.php';
    exec("/Users/hurubashi/Containers/MAMP-7.1.27/mysql/bin/mysql -u $DB_USER  -p$DB_PASSWORD < components/database/camagru.sql");
    echo "Done!\n";

