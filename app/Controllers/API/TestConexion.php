<?php

namespace App\Controllers\API;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class TestConexion extends Controller
{
    public function index()
    {
        try {
            // Obtener la conexión a la base de datos
            $db = Config::connect();

            // Realizar una consulta simple para verificar la conexión
            $query = $db->query('SELECT 1');
            if ($query) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Conexión exitosa a la base de datos.']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'No se pudo conectar a la base de datos.']);
            }
        } catch (\Exception $e) {
            // Manejar cualquier error de conexión
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}
