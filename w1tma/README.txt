W1 Music: a web app to display all songs stored in our database, their duration and associated artists.
------------------------------------------------------
Author:  nkatz01 13128128 
Date:	18/6/2019
Site address: http://titan.dcs.bbk.ac.uk/~nkatz01/w1tma/index.php

Before deploying...

Configuration
-------------
1. Change values defined in "includes/config.php" to
match current environment.

Installation
------------
2. To set up minimal database import "sql/w1tma_tables.sql"
NB: the "sql/w1Queries.sql"  need not be implemented with the application, they're for reference only.

Language
------------
3. Change values in $lang[] in your "languages/otherLanguage.php file to your preferred language(as in "languages/en.php") and then assign otherLanguage to $config['language'].

Notes
-----
4. If running a local installation of apache, make sure apache user has permission to read/write/execute files (e.g. $ chgrp -R www-data /project_template)


Deployment
-------------
5. Unzip the nkatz01_w1_tma and drop or paste all content, as it is, from inside the top most parent folder (that is nkatz01_w1_tma), into the public_www folder/directory on the mapped drive or server named: naktz01(\\fileserv) (H:), so that index.php is directly accessible from within the public_www directory.