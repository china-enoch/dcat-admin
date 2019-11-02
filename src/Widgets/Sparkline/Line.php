<?php

namespace Dcat\Admin\Widgets\Sparkline;

use Dcat\Admin\Widgets\Colors;

/**
 * @see https://omnipotent.net/jquery.sparkline
 *
 * @method $this normalRangeMin(int $val)
 * @method $this drawNormalOnTop(string $val)
 * @method $this xvalues($val)
 * @method $this chartRangeClip($val)
 * @method $this chartRangeMinX($val)
 * @method $this highlightSpotColor(string $color)
 * @method $this highlightLineColor(string $color)
 * @method $this minSpotColor(string $color)
 * @method $this maxSpotColor(string $color)
 * @method $this spotColor(string $color)
 * @method $this spotRadius(int $val)
 * @method $this lineWidth(int $width)
 */
class Line extends Sparkline
{
    protected $type = 'line';

    public function fillDefaultColor()
    {
        $this->fillColors(Colors::$default['primary']);
    }

    public function primary(bool $opaque = false)
    {
        return $this->fillColors(Colors::$default['primary'], $opaque);
    }

    public function green(bool $opaque = false)
    {
        return $this->fillColors(Colors::$default['green'], $opaque);
    }

    public function purple(bool $opaque = false)
    {
        return $this->fillColors(Colors::$default['purple'], $opaque);
    }

    public function red(bool $opaque = false)
    {
        return $this->fillColors(Colors::$default['red'], $opaque);
    }

    public function custom(bool $opaque = false)
    {
        return $this->fillColors(Colors::$default['custom'], $opaque);
    }

    public function tear(bool $opaque = false)
    {
        return $this->fillColors(Colors::$default['tear'], $opaque);
    }

    public function blue(bool $opaque = false)
    {
        return $this->fillColors(Colors::$default['blue'], $opaque);
    }

    protected function fillColors($color, bool $opaque = false)
    {
        $this->lineColor($color[0])
            ->fillColor($opaque ? $color[0] : $color[1])
            ->highlightSpotColor('#fff')
            ->highlightLineColor($color[0])
            ->minSpotColor($color[0])
            ->maxSpotColor($color[0])
            ->spotColor($color[0]);

        if (!isset($this->options['lineWidth'])) {
            $this->lineWidth(2);
        }
        if (!isset($this->options['spotRadius'])) {
            $this->spotRadius(3);
        }

        return $this;
    }

    public function render()
    {
        if (!isset($this->options['lineColor'])) {
            $this->fillDefaultColor();
        }

        return parent::render(); // TODO: Change the autogenerated stub
    }
}