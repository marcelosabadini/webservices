<?php
/*
 * PHP-MG - Grupo de desenvolvedores de PHP de Minas Gerais (http://phpmg.org)
 * 
 */

namespace Phpmg\Webservice\Server;

use Respect\Rest\Routable;
use PDO;
use SimpleXMLElement;

/**
 * Implementação do webservice de CEP
 * 
 */
class Cep implements Routable
{
    
    const FORMAT_JSON   = 'json';
    const FORMAT_XML    = 'xml';
    
    /**
     * @var PDO $_db
     */
    private $_db;
    
    /**
     * Construtor
     * 
     * @param PDO $db 
     */
    public function __construct(PDO $db)
    {
        $this->_db = $db;
    }
    
    /**
     * Obtem o cep do banco de dados
     * 
     * @param string $cep 
     * @return stdClass
     */
    private function _fetchCep($cep)
    {
        $stmt = $this->_db->prepare('SELECT * FROM cep WHERE cep = ?');
        $stmt->execute(array($cep));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Obtem a resposta no formato XML
     * 
     * @param mixed $cep 
     * @return string
     */
    private function _getXmlResponse($cep)
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><response></response>');
        $xml->status = true;
        foreach ($cep as $field => $value) {
            $xml->$field = $value;
        }
        return $xml->asXML();
    }
    
    /**
     * Responde pelas requisições /cep/xxxxxxxx
     * 
     * @param string $cep
     * @return mixed
     */
    public function get($cep, $formato = Cep::FORMAT_JSON)
    {
        
        // Valida o formato do CEP
        if(!preg_match('/^[0-9]{8}$/', $cep)) {
            header('Status: 400 Bad Request');
            return json_encode(array(
                'status'    => false,
                'message'   => 'CEP invalido.'
            ));
        }
        
        // Obtem o cep do banco de dados
        $cep = $this->_fetchCep($cep);
        
        // Valida se o cep foi encontrado
        if (is_null($cep)) {
            header('Status: 404 Not Found');
            return json_encode(array(
                'status'    => false,
                'message'   => 'CEP não encontrado.'
            ));
        }
        
        // verifica o formato desejado
        switch ($format) {
            case self::FORMAT_JSON:
                header('Content-Type: application/json; charset=utf-8');
                return json_encode(array(
                    'status'    => true,
                    'content'   => $cep
                ));
            case self::FORMAT_XML:
                header('Content-Type: text/xml; charset=utf-8');
                return $this->_getXmlResponse($cep);
                break;
        }
    }
}
