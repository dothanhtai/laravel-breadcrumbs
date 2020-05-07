<?php
namespace Dothanhtai\Breadcrumbs;

class Breadcrumb
{
    protected static $breadcrumbs = [];

    protected $divider;

    protected $cssClass;

    protected $listElement;

    protected $itemElement;

    protected $beforeElement;

    protected $showLast;

    protected $position = 1;

    public function __construct()
    {
        $this->divider       = config('breadcrumb.divider',       '/');
        $this->cssClass      = config('breadcrumb.cssClass',      []);
        $this->listElement   = config('breadcrumb.listElement',   'ol');
        $this->itemElement   = config('breadcrumb.itemElement',   'li');
        $this->beforeElement = config('breadcrumb.beforeElement', '');
        $this->showLast      = config('breadcrumb.showLast',      true);
    }

    /**
     * @param $name
     * @param null $href
     * @param array $args
     * @return $this
     */
    public function add($name, $href = null, $args = [])
    {
        self::$breadcrumbs[] = [
            'name'   => $name,
            'href'   => $href,
            'class'  => isset($args['class'])  ? $args['class']  : '',
            'before' => isset($args['before']) ? $args['before'] : '',
        ];

        return $this;
    }

    /**
     * @param string $divider
     * @return Breadcrumb
     */
    public function setDivider($divider)
    {
        $this->divider = $divider;

        return $this;
    }

    /**
     * @param array $cssClass
     * @return $this
     */
    public function setCssClass(array $cssClass)
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    /**
     * @param string $listElement
     * @return $this
     */
    public function setListElement($listElement)
    {
        $this->listElement = $listElement;

        return $this;
    }

    /**
     * @param $itemElement
     * @return $this
     */
    public function setItemElement($itemElement)
    {
        $this->itemElement = $itemElement;

        return $this;
    }

    /**
     * @param $beforeElement
     * @return $this
     */
    public function setBeforeElement($beforeElement)
    {
        $this->beforeElement = $beforeElement;

        return $this;
    }

    /**
     * @param $crumb
     * @param bool|false $isLast
     * @return string
     */
    protected function renderCrumb($crumb, $isLast = false)
    {
        $itemClass = '';
        if (is_string($crumb['class'])) {
            $itemClass = $crumb['class'];
        } elseif (is_array($crumb['class'])) {
            $itemClass = implode(' ', $crumb['class']);
        }

        $output = "<{$this->itemElement} class='{$itemClass}' property='itemListElement' typeof='ListItem'>";

        if ($crumb['before']) {
            $output .= $crumb['before'];
        }

        if (($isLast && !$this->showLast) || !$crumb['href']) {
            $output .= "<span>{$crumb['name']}</span>";
        } else {
            $output .= "<a href='{$crumb['href']}' property='item' typeof='WebPage'><span property='name'>{$crumb['name']}</span></a>";
        }

        $position = $this->position;
        $output .= "<meta property='position' content='{$position}'>";
        $this->position ++ ;

        if (! $isLast) {
            $output .= $this->divider;
        }

        $output .= "</{$this->itemElement}>";

        return $output;
    }

    /**
     * @return string
     */
    protected function renderCrubms()
    {
        end(self::$breadcrumbs);
        $lastKey = key(self::$breadcrumbs);

        $output = '';
        foreach (self::$breadcrumbs as $key => $crumb)
        {
            $isLast = ($lastKey === $key);
            $output .= $this->renderCrumb($crumb, $isLast);
        }
        return $output;
    }

    /**
     * @param null $group
     *
     * @return string
     */
    public function render($group = null)
    {
        if ($group) {
            $this->setConfigGroup($group);
        }

        if (! self::$breadcrumbs) {
            return '';
        }

        $cssClass = implode(' ', $this->cssClass);

        $listElement = $this->listElement;

        return '<' . $listElement . ' class="' . $cssClass . '" vocab="http://schema.org/" typeof="BreadcrumbList">' .
            $this->beforeElement   .
            $this->renderCrubms() .
        '</' . $listElement . '>';
    }

    private function setConfigGroup($group)
    {
        $config_name = 'breadcrumb.groups.' . $group . '.';

        if (config($config_name . 'divider')) {
            $this->divider = config($config_name . 'divider');
        }

        if (config($config_name . 'cssClass')) {
            $this->cssClass = config($config_name . 'cssClass');
        }

        if (config($config_name . 'listElement')) {
            $this->listElement = config($config_name . 'listElement');
        }

        if (config($config_name . 'itemElement')) {
            $this->itemElement = config($config_name . 'itemElement');
        }

        if (config($config_name . 'beforeElement')) {
            $this->beforeElement = config($config_name . 'beforeElement');
        }

        if (config($config_name . 'showLast')) {
            $this->showLast = config($config_name . 'showLast');
        }
    }
}