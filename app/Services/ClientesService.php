<?php

namespace App\Services;

use App\Models\Cliente;
use Ramsey\Uuid\Uuid;

class ClientesService
{
    public function __construct()
    {
    }

    public function create(array $settings): Cliente
    {
        return Cliente::create([
            'codigo_cliente' => Uuid::uuid4(),
            'nome' => $settings['nome'],
            'cpf' => $settings['cpf'],
            'sexo' => $settings['sexo'],
            'email' => $settings['email']
        ]);
    }
}
