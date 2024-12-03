<?php

namespace App\Controllers\API;

use App\Models\ClienteModel; // 
use CodeIgniter\RESTful\ResourceController; // controlador propio de codeigniter para poder implementar una restful api


class Clientes extends ResourceController
{

    public function __construct(){
        $this->model = new ClienteModel;
    }

    public function index()
    {
        $clientes = $this->model->findAll();
        return $this->respuesta_generica($clientes,"",200);
    }

    public function show($id = null)
    {
        if($id == null){
            return $this->respuesta_generica(null,"El Id no fue encontrado",500);
        }

        $clientes = $this->model->find($id); 

        if(!$clientes){
            return $this->respuesta_generica(null,"El cliente no fue encontrado",500);
        }

        return $this -> respuesta_generica($clientes,"Ok",200);

    }

    public function create()
    {
        try {
            $cliente = $this->request->getJSON(true); // Convertir JSON en array asociativo por el postman
            // $data = $this->request->getPost(); // datos como formulario
            if ($this->model->save($cliente)) 
                return $this->respuesta_generica($cliente, "Cliente creado exitosamente.", 201);
        } catch (\Throwable $th) {
           // log_message('debug', 'Errores del modelo: ' . json_encode($this->model->errors()));
           return $this->respuesta_generica(null,"Datos no válidos o JSON malformado.", 400);
        }           
    }
    

    public function update($id = null)
    {
    try {
        if ($id == null) {
            return $this->failValidationError("ID es nulo");
        }

        $clienteVerificado = $this->model->find($id);
        if ($clienteVerificado == null) {
            return $this->failValidationError("Cliente no encontrado");
        }

        $cliente = $this->request->getJSON(true);
        if($this->model->update($id, $cliente)) {
            return $this->respondUpdated([
                'message' => 'Cliente actualizado correctamente',
                'data' => $cliente
            ]);
        } else {
            return $this->failValidationError($this->model->errors());
        }

    } catch (\Exception $e) {
        return $this->failServerError("Ocurrio un error de server");
    }
    }

    public function delete($id = null)
    {
    try {
        if ($id == null) {
            return $this->failValidationError("ID es nulo");
        }

        $cliente = $this->model->find($id);
        if ($cliente == null) {
            return $this->failValidationError("Cliente no encontrado");
        }
        if($this->model->delete($id)){
            return $this->respondDeleted([
                'message'=> 'Cliente eliminado',
                'data' => $cliente
            ]);
        }
        else{
            return $this->failServerError('Error al eliminar el cliente');
        }

    } catch (\Exception $e) {
        return $this->failServerError("Ocurrio un error de server");
    }
    }


    private function respuesta_generica($data,$msj,$code){
        if($code == 200){
            return $this->respond(array(
                "data" => $data,
                "code" => $code
            )); //, 404, "nada"
        }
        else{
            return $this -> respond(array(
                "msj" => $msj,
                "code" => $code
            ));
        }
    }

}
