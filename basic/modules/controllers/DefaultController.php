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
    protected $types = ['ecology','oil','minerals','combine'];
    protected $counts = [3,7,7,2];
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

        $map = [];
        $map = array_merge(
            $map,
            $this->_first_circle_generate(),
            $this->_second_circle_generate()
        );
        return $this->render('index', ['map' => $map]);

    }


    /*protected function _get_field_by_ecology($ecology) {
        $result = null;
        if(Core::is_integer($ecology)) {
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

    protected function _rand($min, $max) {
        $result = null;
        if(Core::is_integer($min) and Core::is_integer($max)) {
            $result = rand($min, $max);
        } else {
            throw new Exception('500.1.2.1');
        }
        return $result;
    }

    protected function _first_circle_generate() {
        $local_map = [ null ];
        // какой квадрат будет задействован
        $i = $this->_rand(0, 3);
        $type = $this->types[$i];
        //
        $index = $this->_rand( 0, $this->counts[$i] - 1 );
        //
        $element = ($this->$type)[ $index ];
        //
        $local_map[0] = $element;
        $this->$type = array_filter($this->$type, function($v, $k) use ( $index ) {
            return $k !== $index;
        }, ARRAY_FILTER_USE_BOTH);
        $this->counts[$i] = $this->counts[$i] - 1;

        return $local_map;

    }

    protected function _ecology_type_count($count) {

    }

    protected function _bool() {
        return (bool)$this->_rand(0, 1);
    }

    protected function _index($count, $length) {
        $result = [];
        $limit = 0;
        while( (count($result) !== (int)$length) || ($limit > 30) ) {
            $index = $this->_rand(0, $count - 1);
            if(!in_array( $index, $result )) {
                $result[] = $index;
            }
            $limit = $limit + 1;
        }
        return $result;
    }

    protected function _second_circle_generate() {
        $local_map = [ null, null, null, null, null, null ];
        // будет ли заповедник во втором кольце
        $local_map = [ null, null, null, null, null, null ];
        if($this->counts[0] !== 0) {
            $ecology_count = $this->_rand(0, $this->counts[0]);
            $ecology_positions = $this->_index( count($local_map), $ecology_count );
            Core::Q( $this->_index( count($local_map), $ecology_count ));
        }
        if($this->counts[3] !== 0) {
            $combine_count = $this->_rand(0, $this->counts[3]);
        }
        $even = (bool)$this->_rand(0, 1);
        foreach($local_map as $index => $field) {

        }
        return $local_map;
        // количество заповедников
    }

    /*
    protected function _thirth_circle_generate() {
        $local_map = [ null, null, null, null, null, null, null, null, null, null, null, null, ];
        return $local_map;
    }
    */
}
