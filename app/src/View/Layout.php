<?php

namespace IntecPhp\View;


use IntecPhp\Model\Config;

/**
 * Description of Layout
 *
 * @author intec
 */
class Layout
{

    private $stylesheets;
    private $scripts;
    private $layout;
    private $renderLayout = true;
    private $title;

    const DEFAULT_LAYOUT = 'layout';

    public function __construct($layoutName = self::DEFAULT_LAYOUT, $stylesheets = [], $scripts = [])
    {
        $this->stylesheets = $stylesheets;
        $this->scripts = $scripts;
        $this->layout = $layoutName;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function setRenderLayout($renderLayout)
    {
        $this->renderLayout = $renderLayout;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function appendTitle($text, $separator = ' ')
    {
        $this->title .= $separator . $text;
    }

    public function render($page, $resp = [])
    {
        $this->contentId = $page;
        extract($resp);
        if ($this->renderLayout) {
            include_once 'app/views/partial/layout/' . $this->layout . '.php';
        } else {
            include_once 'app/views/template/' . $page . '.php';
        }
    }

    public function addScript($path)
    {
        $this->scripts[] = $path;
        return $this;
    }

    public function addStylesheet($href)
    {
        $this->stylesheets[] = $href;
        return $this;
    }
}
