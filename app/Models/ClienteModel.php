<?php namespace App\Models;

use CodeIgniter\Model;

//instanciando la clase de Cliente
class ClienteModel extends Model
{
    protected $table = 'cliente'; // nombre de la tabla
    protected $primaryKey ='id'; // key de la tabla

    protected $returnType = 'array';
    protected $allowedFields = ['nombre','email','telefono','direccion']; // para que sepa que columnas va a manejar

    protected $useTimestamps = true;
    protected $createdField = 'fecha_registro';

    //  reglas
    protected $validationRules = [
        'nombre' => 'required|alpha_space|min_length[3]|max_length[100]',
        // 'nombre' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/]' para aceptar los acentos
        'email' => 'permit_empty|valid_email|min_length[8]|max_length[100]',
        'telefono' => 'permit_empty|numeric|min_length[8]|max_length[15]',
        'direccion' => 'permit_empty|alpha_numeric_space|min_length[3]|max_length[100]',
    ];
    

    //hay mensages predefinidos, pero asi se customizan
    protected $validationMessages = [
            'email' =>[
                'valid_email' => 'email incorrecto por favor no hagas promesas sobre el videt'
            ]
            ];
}