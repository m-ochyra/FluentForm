<?php namespace inkvizytor\FluentForm\Controls\Elements;

use inkvizytor\FluentForm\Base\Control;
use inkvizytor\FluentForm\Base\Handler;
use inkvizytor\FluentForm\Renderers\Base;
use inkvizytor\FluentForm\Traits\CssContract;
use inkvizytor\FluentForm\Traits\ControlsContract;
use inkvizytor\FluentForm\Traits\CustomContract;
use inkvizytor\FluentForm\Traits\GroupContract;
use inkvizytor\FluentForm\Traits\SizeContract;
use inkvizytor\FluentForm\Traits\ExclusiveContract;

/**
 * Class Group
 *
 * @package inkvizytor\FluentForm
 */
class Group extends Control
{
    use ControlsContract, ExclusiveContract, CustomContract, GroupContract, CssContract, SizeContract;

    /** @var array */
    protected $guarded = ['content'];
    
    /** @var array */
    protected $content = [];

    /**
     * @param \inkvizytor\FluentForm\Base\Handler $handler
     */
    public function __construct(Handler $handler)
    {
        parent::__construct($handler);
        
        $this->renderer()
            ->mode(Base::RENDER_GROUP)
            ->bindGroup($this);
    }
    
    /**
     * @param Control|string $content
     * @return $this
     */
    public function add($content)
    {
        if ($content instanceof Control)
        {
            $this->content[] = $content->display();
        }
        else if (is_string($content))
        {
            $this->content[] = $content;
        }
        
        return $this;
    }

    /**
     * Set size of the controls in horizontal form
     *
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function fieldSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->setFieldSize($lg, $md, $sm, $xs);
        
        return $this;
    }

    /**
     * Set size of the label in horizontal form
     *
     * @param int $lg
     * @param int $md
     * @param int $sm
     * @param int $xs
     * @return $this
     */
    public function labelSize($lg = null, $md = null, $sm = null, $xs = null)
    {
        $this->setLabelSize($lg, $md, $sm, $xs);

        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return implode("\n", $this->content);
    }

    /**
     * @return string
     */
    public function display()
    {
        return $this->renderer()
            ->mode(Base::RENDER_GROUP)
            ->bindGroup($this)
            ->display();
    }
}