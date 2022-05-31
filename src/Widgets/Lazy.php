<?php

namespace Dcat\Admin\Widgets;

use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\InteractsWithRenderApi;

class Lazy extends Widget
{
    use InteractsWithRenderApi;

    protected $target = 'lazy';
    protected $load = true;

    public function __construct(LazyRenderable $renderable = null, bool $load = true)
    {
        $this->setRenderable($renderable);
        $this->load($load);

        $this->class($this->elementClass = 'lazy-box');
    }

    /**
     * 设置是否立即加载.
     *
     * @return $this
     */
    public function load(bool $value)
    {
        $this->load = $value;

        return $this;
    }

    protected function addScript()
    {
        $loader = $this->load ? "target.trigger('{$this->target}:load')" : '';

        $this->script = <<<JS
Dcat.init('{$this->getElementSelector()}', function (target) {
    var body = target;
    {$this->getRenderableScript()}

    body.html('<div style="min-height:150px"></div>').loading();
    
    {$loader}
});
JS;
    }

    public function html()
    {
        $this->addScript();

        return <<<HTML
<div {$this->formatHtmlAttributes()}></div>
HTML;
    }
}
