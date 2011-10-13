<?php
/*
 * PHP-MG - Grupo de desenvolvedores de PHP de Minas Gerais (http://phpmg.org)
 * 
 */

namespace Webservice\Server;

use Respect\Rest\Routable;
use PDO;

class Cep implements Routable
{
    public function __construct(){}
    public function __destruct() {}
    
    public function get($cep)
    {
        if(!preg_match('/^[0-9]{8}$/', $cep)) {
            header("Status: 400 Bad Request");
            return null;
        }

        $pdo = new PDO('mysql:host=localhost;dbname=cidades_estados', 'root');
        $stmt = $pdo->prepare("SELECT * FROM cep WHERE cep = ? ");
        $stmt->execute(array($cep));
        $cep = $stmt->fetch(PDO::FETCH_OBJ);
        
        #TODO Descobrir como passar os parametros da URL para a classe e fazer a validação de tipo de request.
        if(false) {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode($cep);
        } else {
            header('Content-Type: text/xml; charset=utf-8');
            return '<endereco><estado>'.$cep->estado.'</estado><cidade>'.$cep->cidade.'</cidade><locadouro>'.$cep->locadouro.'</locadouro><bairro>'.$cep->bairro.'</bairro><tipo>'.$cep->tipo.'</tipo><observacao>'.$cep->observacao.'</observacao></endereco>';
        }
    }
}
