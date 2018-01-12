<?php
/**
 * Created by Raquel Baldavira on PhpStorm.
 * DS Aplicativos for fortville
 * Date: 10/01/2018
 * Time: 16:47
 */

class ActionButton {

    private $icon;
    private $url;
    private $largeIcon;
    private $color;
    private $remove;

    public function __construct($icon, $url, $largeIcon = false, $color = '#000', $remove = false)
    {
        $this->icon = $icon;
        $this->url = $url;
        $this->largeIcon = $largeIcon;
        $this->color = $color;
        $this->remove = $remove;
    }

    private function getA($item_name) {
    	return '<a class="m-0 mx-auto d-block" href="' . base_url($this->url) . '" style="color: ' . $this->color . ' !important;" ' .
    				$this->getRemove($item_name) . '>';
    }

    private function getRemove($item_name) {
        $html = '';
        if ($this->remove == true) {
            $html = 'onclick=\'return confirm("Excluir Documento: ' . $item_name . '?"); return false;\'';
        }
        return '';
    }

    private function getIcon() {
        return '<i class="fa ' . $this->icon . ($this->largeIcon == true ? ' fa-lg' : '') . '"></i>';
    }

    public function getHTML($item_name = null) {
        return $this->getA($item_name) . $this->getIcon() . '</a>';
    }

}