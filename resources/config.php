<?php

$config = array(
    "db_members" => array(
            "db" => "mysql:einsteinfloripa.xyz;
                     port=3306;
                     dbname=einst301_members",
            "username" => "einst301_matrix",
            "password" => "M3lh0rD3p4rt4m3nt0",
    ),
    "urls" => array(
        "baseUrl" => "http://example.com"
    ),
    "paths" => array(
        "resources" => "/path/to/resources",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
        )
    )
); 

return $config;
?>