<?php

namespace Dcat\Admin\Grid\Concerns;

use Dcat\Admin\Grid\Displayers\Actions;
use Dcat\Admin\Grid\Displayers\DropdownActions;
use Dcat\Admin\Grid\FixColumns;
use Illuminate\Support\Collection;

trait CanFixColumns
{
    /**
     * @var FixColumns
     */
    protected $fixColumns;

    /**
     * @return FixColumns
     */
    public function fixColumns(int $head, int $tail = -1)
    {
        $this->fixColumns = new FixColumns($this, $head, $tail);

        $this->resetActions();

        return $this->fixColumns;
    }

    protected function resetActions()
    {
        $actions = $this->actionsClass ?: config('admin.grid.grid_action_class');

        if (DropdownActions::class === $actions) {
            $this->setActionClass(Actions::class);
        }
    }

    protected function applyFixColumns()
    {
        if ($this->fixColumns) {
            if (!$this->options['show_bordered'] && !$this->options['table_collapse']) {
                $this->tableCollapse();
            }

            $this->fixColumns->apply();
        }
    }

    /**
     * @return Collection
     */
    public function leftVisibleColumns()
    {
        return $this->fixColumns->leftColumns();
    }

    /**
     * @return Collection
     */
    public function rightVisibleColumns()
    {
        return $this->fixColumns->rightColumns();
    }

    /**
     * @return Collection
     */
    public function leftVisibleComplexColumns()
    {
        return $this->fixColumns->leftComplexColumns();
    }

    /**
     * @return Collection
     */
    public function rightVisibleComplexColumns()
    {
        return $this->fixColumns->rightComplexColumns();
    }
}
