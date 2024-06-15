<?php
namespace DXFighter\lib;

class MText extends Entity {
    protected $point;
    protected $height;
    protected $width;
    protected $text;
    protected $rotation;
    protected $style = 'STANDARD';
    protected $attachmentPoint = 1;
    protected $drawingDirection = 1;
    protected $lineSpacingFactor = 1.0;

    public function __construct($text, $point, $height, $rotation = 0, $width = -1) {
        $this->entityType = 'mtext';
        $this->text = $text;
        $this->point = $point;
        $this->height = $height;
        $this->rotation = $rotation;
        $this->width = $width;
        parent::__construct();
    }

    public function setAttachmentPoint($value) {
        $this->attachmentPoint = $value;
    }

    public function setDrawingDirection($value) {
        $this->drawingDirection = $value;
    }

    public function setLineSpacingFactor($value) {
        $this->lineSpacingFactor = $value;
    }

    public function move($move) {
        $this->movePoint($this->point, $move);
    }

    public function rotate($rotate, $rotationCenter = [0, 0, 0]) {
        $this->rotation += $rotate;
        $this->rotatePoint($this->point, $rotationCenter, deg2rad($rotate));
    }

    public function render() {
        $output = parent::render();
        array_push($output, 100, 'AcDbMText');
        array_push($output, 10, $this->point[0]);
        array_push($output, 20, $this->point[1]);
        array_push($output, 30, 0);
        array_push($output, 40, $this->height);
        array_push($output, 41, $this->width);
        array_push($output, 1, $this->text);
        array_push($output, 50, $this->rotation);
        array_push($output, 7, $this->style);
        array_push($output, 71, $this->attachmentPoint);
        array_push($output, 72, $this->drawingDirection);
        array_push($output, 41, $this->lineSpacingFactor);
        return implode(PHP_EOL, $output);
    }
}
