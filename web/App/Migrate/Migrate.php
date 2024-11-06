<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';

use App\Migrate\MembrosMigrate;
use App\Migrate\UsuarioMigrate;

class Migrate
{

    public function Migrate()
    {
        $MembrosMigrate = new MembrosMigrate();
        $MembrosMigrate->migrate();
        
        $UsuarioMigrate = new UsuarioMigrate();
        $UsuarioMigrate->migrate();
        
        // $contatoMigration = new ContatoMigrate();
        // $contatoMigration->migrate();
    }
}

 
new Migrate();