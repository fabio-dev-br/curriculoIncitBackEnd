<?php

return array_merge_recursive(
    require_once 'app/config/docs-routes.php', // remove in new projects
    require_once 'app/config/api-routes.php', // for data response
    require_once 'app/config/template-routes.php' // for html templates
);
