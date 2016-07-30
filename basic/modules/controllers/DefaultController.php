<?php

namespace app\modules\controllers;

use yii\web\Controller;
use app\components\Core;
use yii\base\Exception;

/**
 * Default controller for the `ell` module
 */
class DefaultController extends Controller
{
    protected $fields_condition = [ '0' => 3, '1' => 8, '3' => 4, '5' => 4, ];
    protected $ecology = [
        ['id' => 1,'type' => 0,'ecology' => 0,'oil' => 0,'minerals' => 0,'selected' => false],
        ['id' => 2,'type' => 0,'ecology' => 0,'oil' => 0,'minerals' => 0,'selected' => false],
        ['id' => 3,'type' => 0,'ecology' => 0,'oil' => 0,'minerals' => 0,'selected' => false]
    ];
    protected $oil = [
        ['id' => 4,'type' => 1,'ecology' => 1,'oil' => 1,'minerals' => 0,'selected' => false],
        ['id' => 5,'type' => 1,'ecology' => 1,'oil' => 1,'minerals' => 0,'selected' => false],
        ['id' => 11,'type' => 1,'ecology' => 1,'oil' => 1,'minerals' => 0,'selected' => false],
        ['id' => 14,'type' => 1,'ecology' => 3,'oil' => 1,'minerals' => 0,'selected' => false],
        ['id' => 15,'type' => 1,'ecology' => 3,'oil' => 1,'minerals' => 0,'selected' => false],
        ['id' => 16,'type' => 1,'ecology' => 5,'oil' => 1,'minerals' => 0,'selected' => false],
        ['id' => 18,'type' => 1,'ecology' => 5,'oil' => 1,'minerals' => 0,'selected' => false],
    ];
    protected $minerals = [
        ['id' => 7,'type' => 2,'ecology' => 1,'oil' => 0,'minerals' => 1,'selected' => false],
        ['id' => 8,'type' => 2,'ecology' => 1,'oil' => 0,'minerals' => 1,'selected' => false],
        ['id' => 10,'type' => 2,'ecology' => 1,'oil' => 0,'minerals' => 1,'selected' => false],
        ['id' => 12,'type' => 2,'ecology' => 3,'oil' => 0,'minerals' => 1,'selected' => false],
        ['id' => 13,'type' => 2,'ecology' => 3,'oil' => 0,'minerals' => 1,'selected' => false],
        ['id' => 17,'type' => 2,'ecology' => 5,'oil' => 0,'minerals' => 1,'selected' => false],
        ['id' => 19,'type' => 2,'ecology' => 5,'oil' => 0,'minerals' => 1,'selected' => false]
    ];
    protected $combine = [
        ['id' => 6,'type' => 3,'ecology' => 1,'oil' => 1,'minerals' => 1,'selected' => false],
        ['id' => 9,'type' => 3,'ecology' => 1,'oil' => 1,'minerals' => 1,'selected' => false]
    ];
    protected $type = 0;
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGameid()
    {
        return $this->render('test');
    }
    

    public function actionCreatemap() {
        

        $crew_count = 4;
        $_result = [ '0' => 3, '1' => 8, '3' => 4, '5' => 4, ];
        // 0, 6, 18
        $map = [];
        return $this->render('index', ['map' => $map]);
        
    }

    /*protected function _get_field_by_ecology($ecology) {
        $result = null;
        if(Core::isNumber($ecology)) {
            $ecology = (int)$ecology;
            foreach($this->fields as $index => $field) {
                if($ecology === $field['ecology'] && !$field['selected']) {
                    $result = $field;
                }
            }
        } else {
            throw new Exception('500.1.1.1');
        }
        if($result === null) {
            throw new Exception('Sector not found', '500');
        }
        $result['selected'] = true;
        return $result;
        
    }
    */

    
    /*protected function _first_circle_generate() {
        $local_map = [ null ];
        $position = 0;
        $local_map[ $position ] = $this->_get_field_by_ecology( 3 );
        return $local_map;
    }*/

    /*protected function _second_circle_generate() {
        $local_map = [ null, null, null, null, null, null ];
        ////
        //Будет ли в кольце заповедник
        $isset = true;
        //cколько будет у нас заповедников
        $count = 1;
        // в какую позицию займет заповедник
        $position = [0];
        foreach( $position as $index ) {
            $local_map[$index] = $this->_get_field_by_ecology( 0 );
        }
        
        
        /////
        //Будет ли в кольце 5 тип
        $isset = true;
        //cколько будет у нас заповедников
        $count = 2;
        // в какую позицию займет заповедник
        $position = [1, 2];
        foreach( $position as $index ) {
            $local_map[$index] = $this->_get_field_by_ecology( 5 );
        }
        
        /////
        return $local_map;

    }*/

    /*
    protected function _thirth_circle_generate() {
        $local_map = [ null, null, null, null, null, null, null, null, null, null, null, null, ];
        return $local_map;
    }
    */
}
