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
     * Define se o clique deverá ser confirmado
     * @var bool
     */
    private $confirm;

    /**
     * Recebe o texto de confirmação exibido no alerta, em javascript
     * @var string
     */
    private $confirmationMessage;


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
     * Condição para botão que abre modal
     * @var bool
     */
    private $modal;

    /**
     * Condição para botão não clicável
     * @var bool
     */
    private $nonClickable = false;

    /**
     * ActionButton constructor.
     * @param string $icon
     * @param string $url
     * @param bool $largeIcon
     * @param string $color
     * @param bool $confirm
     * @param bool $modal
     */
    public function __construct($icon, $url, $largeIcon = false, $color = '#000', $confirm = false, $modal = false)
    {
        $this->icon = $icon;
        $this->url = $url;
        $this->largeIcon = $largeIcon;
        $this->color = $color;
        $this->confirm = $confirm;
        $this->modal = $modal;
    }

    /**
     * Gera o código HTML final do botão
     * @return string
     */
    public function getHTML() {
        return $this->getA() . $this->getIcon() . ($this->nonClickable ? '</span>' : '</a>');
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
     * Define a mensagem de confirmação exibida no alerta
     * @param $message
     */
    public function setConfirmationMessage($message) {
        $this->confirmationMessage = $message;
    }

    /**
     * Define se o botão será ou não clicável
     * @param bool $clickable
     */
    public function setNonClickable($clickable) {
        $this->nonClickable = $clickable;
    }

    /**
     * Retorna o código HTML do link
     * @return string
     */
    private function getA() {
        return '<' . ($this->nonClickable ? 'span' : 'a') . ' class="m-0 mx-auto d-block" ' . (($this->modal) ? 'data-toggle="modal" data-target="#' . $this->url . '"' : 'href="' . base_url($this->url)) . '"'
            . $this->getConfirmation()
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
     * @return string
     */
    private function getConfirmation() {
        return $this->confirm == true ? 'onclick=\'return confirm("' . $this->confirmationMessage . '"); return false;\'' : '';
    }

    /**
     * Retorna o código HTML do ícone
     * @return string
     */
    private function getIcon() {
        return '<i ' . $this->popover() . ' class="my-2 mx-2 fa ' . $this->icon . ($this->largeIcon == true ? ' fa-lg' : '') . '" style="color: ' . $this->color . ' !important;"></i>';
    }

}