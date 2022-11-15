<?php
require_once './app/models/client.model.php';
require_once './app/views/api.view.php';

class ClientApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ClientModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }
  
    public function getClients($params = null) {
        $column= ['id', 'nombre' , 'apellido', 'dni' , 'email'];

        //FILTRO
        if ( isset($_GET['filtername']) ){        
            $filterName= mb_strtolower($_GET['filtername']);               
        }
        else{
            $filterName= null;
        }

        //ORDERNAR       
        if ((isset($_GET['sort']) && isset($_GET['order']) && 
        (isset($_GET['order']) =='asc' || isset($_GET['order']) =='desc') && 
        (in_array(isset($_GET['sort']), $column))) ) {
            $sort= $_GET['sort'];
            $order= $_GET['order'];
        }
        else {
            $sort= null;
            $order=null;
        }

         //PAGINADO
         if (isset($_GET['page']) && (isset($_GET['limit']))){            
            $page= intval($_GET['page']); //INTVAL LO CONVIERTE A ENTERO
            $limit= intval($_GET['limit']);            
            $offset= ($limit * $page) - $limit;            
        }
        else {
            $offset= null;
            $limit=null;
        }

        $result= $this->model->getAll($filterName, $offset, $limit, $order, $sort);

        if($result)
            return $this->view->response($result, 200);
        else
            $this->view->response("No existen resultados", 404);
    }

    public function getClient($params = null) {
        //obtengo el id del arreglo de params
        $id = $params[':ID'];
        $client = $this->model->get($id);

        //si no existe devuelvo 404
        if ($client)
            $this->view->response($client);
        else 
            $this->view->response("El cliente con el id=$id no existe", 404);
    }

    public function deleteClient($params = null) {
        $id = $params[':ID'];
        $client = $this->model->get($id);
        if ($client){
            $this->model->delete($id);
            $this->view->response("El cliente fue eliminado con éxito", 200);
        } 
        else 
            $this->view->response("El cliente con el id=$id no existe", 404);
    }

    public function insertClient($params = null) {
        $client = $this->getData();

        if (empty($client->nombre) || empty($client->apellido) || empty($client->dni) || empty($client->email)){
            $this->view->response("Complete los datos", 400);
        } 
        else{
            $id = $this->model->insert($client->nombre, $client->apellido, $client->dni, $client->email);
            $client = $this->model->get($id);
            $this->view->response("El cliente fue creado con exito", 201);
        }
    }

    public function updateClient($params = null){
        $id = $params[':ID'];
        $data= $this->getData();

        if ($id) {
            $this->model->update($id, $data->nombre, $data->apellido,  $data->dni,  $data->email );
            $this->view->response("El cliente fue modificado con éxito", 200);
        } else 
            $this->view->response("El cliente con el id=$id no existe", 404);
    }
}