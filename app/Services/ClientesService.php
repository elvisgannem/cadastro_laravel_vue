<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class ClientesService
{
    public function __construct()
    {
    }

    public function get(int $id = null): Cliente|Collection
    {
        if($id) {
            return Cliente::where('id', $id)->first();
        }

        return Cliente::all();
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

    public function update(array $settings, int $id): bool
    {
        return Cliente::where('id', $id)->update($settings);
    }
}
