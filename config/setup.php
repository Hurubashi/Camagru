<?php

    require 'database.php';
    exec("~/Containers/MAMP-7.1.27-0/mysql/bin/mysql -u $DB_USER  -p$DB_PASSWORD < components/database/camagru.sql");
    echo "Done!\n";

