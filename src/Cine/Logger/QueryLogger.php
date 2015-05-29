<?php
/**
 * Description of QueryLogger
 *
 * @author jr
 * time: 22:02:30
 * date: 21-feb-2015
 * 
 */

namespace Cine\Logger;

use Doctrine\DBAL\Logging\SQLLogger;

class QueryLogger implements SQLLogger
{
    
    private $elapsedTime;
    private $log;
    private $logFileName = 'query.log';

    
    public function __construct() 
    {
        if (!is_dir(__DIR__.'/log/')){
            mkdir(__DIR__.'/log/', 0777, true);
        }        
        $this->logFileName = __DIR__ .'/log/'.$this->logFileName;
    }
        
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->log = fopen($this->logFileName,'a');     
        $this->elapsedTime = microtime(TRUE);
        
        $logLineFormat = 
                '* Consulta:' . PHP_EOL .'%s' . PHP_EOL .
                '* Parametros: '.PHP_EOL .'%s' . 
                '* Tipos: '.PHP_EOL .'%s';
        
        fwrite($this->log, sprintf($logLineFormat, $sql, print_r($params,TRUE), print_r($types, TRUE)) );
    }

    public function stopQuery()
    {       
        fwrite($this->log, sprintf('Tiempo: %f seg.'.PHP_EOL.PHP_EOL,(microtime(TRUE)-$this->elapsedTime)));
    }
}
