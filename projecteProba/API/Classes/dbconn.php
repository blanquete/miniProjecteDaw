<?php

use Monolog\Handler\MongoDBHandler;

    class Dbconn
    {
        function __constructor()
        {
            $conn = new MongoDB\Driver\Manager(('mongodb+srv://th:thpass@thcluster.q4scfxf.mongodb.net/?retryWrites=true&w=majority'));
            print("connected");
        }
    }        
?>