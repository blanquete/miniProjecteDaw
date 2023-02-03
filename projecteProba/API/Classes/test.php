<?php

use Monolog\Handler\MongoDBHandler;

$conn = new MongoDB\Driver\Manager(('mongodb+srv://th:<password>@thcluster.q4scfxf.mongodb.net/?retryWrites=true&w=majority'));

new MongoDBHandler(1,2,3);
print($conn);
?>