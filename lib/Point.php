<?php
/**
 * Created by PhpStorm.
 * User: jpietler
 * Date: 30.12.16
 * Time: 16:18
 *
 * Dokumentation http://www.autodesk.com/techpubs/autocad/acad2000/dxf/point_dxf_06.htm
 */

namespace DXFighter\lib;

/**
 * Class Point
 * @package DXFighter\lib
 */
class Point extends Entity {
  protected $thickness;
  protected $point;
  protected $extrusion;
  protected $angle;

  function __construct($point, $thickness = 0, $extrusion = array(0,0,1), $angle = 0) {
    $this->entityType = 'point';
    $this->point = $point;
    $this->thickness = $thickness;
    $this->extrusion = $extrusion;
    $this->angle = $angle;
    parent::__construct();
  }

  public function render() {
    $output = parent::render();
    array_push($output, 100, 'AcDbPoint');
    array_push($output, 39, $this->thickness);
    array_push($output, $this->point($this->point));
    array_push($output, $this->point($this->extrusion, 200));
    array_push($output, 50, $this->angle);
    return implode($output, PHP_EOL);
  }
}