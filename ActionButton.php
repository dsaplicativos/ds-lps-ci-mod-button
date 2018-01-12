<?php
/**
 * Created by Raquel Baldavira on PhpStorm.
 * DS Aplicativos for fortville
 * Date: 10/01/2018
 * Time: 16:47
 */

/**
 * Class ActionButton
 * Geração automática de botão de ação
 */
class ActionButton {

    /**
     * Body elements
     */

    /**
     * Ícone do botão
     * @var string
     */
    private $icon;

    /**
     * Link de destino
     * @var string
     */
    private $url;

    /**
     * Define se o ícone deve aparecer em tamanho grande
     * @var bool
     */
    private $largeIcon;

    /**
     * Recebe uma cor hexadecimal
     * @var string
     */
    private $color;

    /**
     * Define se o botão será utilizado para exclusão de itens
     * @var bool
     */
    private $remove;


    /**
     * Popover elements
     */

    /**
     * Conteúdo do corpo
     * @var string
     */
    private $popoverBody;

    /**
     * Conteúdo do título
     * @var string
     */
    private $popoverTitle;

    /**
     * Posição
     * @see https://mdbootstrap.com/javascript/popovers/#examples
     * @var
     */
    private $popoverPosition;

    /**
     * Evento de ativação
     * @see https://mdbootstrap.com/javascript/popovers/#options -> hover
     * @var
     */
    private $popoverTrigger;

    /**
     * Permissão de uso de elementos html
     * @see https://mdbootstrap.com/javascript/popovers/#options -> html
     * @var boolean
     */
    private $popoverHtml;

    /**
     * ActionButton constructor.
     * @param string $icon
     * @param string $url
     * @param bool $largeIcon
     * @param string $color
     * @param bool $remove
     */
    public function __construct($icon, $url, $largeIcon = false, $color = '#000', $remove = false)
    {
        $this->icon = $icon;
        $this->url = $url;
        $this->largeIcon = $largeIcon;
        $this->color = $color;
        $this->remove = $remove;
    }

    /**
     * Gera o código HTML final do botão
     * @param string $item_name
     * @return string
     */
    public function getHTML($item_name = null) {
        return $this->getA($item_name) . $this->getIcon() . '</a>';
    }

    /**
     * Definição de propriedades de popover
     * @param string $body
     * @param string $title
     * @param string $position
     * @param string $trigger
     * @param bool $html
     */
    public function setPopover($body = '', $title = '', $position = 'top', $trigger = 'hover', $html = false) {
        $this->popoverBody = $body;
        $this->popoverTitle = $title;
        $this->popoverPosition = $position;
        $this->popoverTrigger = $trigger;
        $this->popoverHtml = $html;
    }

    /**
     * Retorna o código HTML do link
     * @param string $item_name
     * @return string
     */
    private function getA($item_name) {
        return '<a class="m-0 mx-auto d-block" href="' . base_url($this->url) . '" style="color: ' . $this->color . ' !important;" '
            . $this->getRemove($item_name)
            . $this->popover()
            . '>';
    }

    /**
     * Retorna o código HTML do popover
     * @return string
     */
    private function popover() {
        return 'data-toggle="popover" 
                data-trigger="' . $this->popoverTrigger . '" 
                data-title="' . $this->popoverTitle . '" 
                data-placement="' . $this->popoverPosition . '" 
                data-content="' . $this->popoverBody . '"'
            . ($this->popoverHtml == true ? 'data-html="true"' : '');
    }

    /**
     * Retorna a confirmação em javascript após o clique
     * @param string $item_name
     * @return string
     */
    private function getRemove($item_name) {
        return $this->remove == true ? 'onclick=\'return confirm("Excluir: ' . $item_name . '?"); return false;\'' : '';
    }

    /**
     * Retorna o código HTML do ícone
     * @return string
     */
    private function getIcon() {
        return '<i class="fa ' . $this->icon . ($this->largeIcon == true ? ' fa-lg' : '') . '"></i>';
    }

}