<?php

class MichaelsInterfaceButton {

    private $buttonTitle = 'ButtonTitle';

    private $buttonAttributes = array('attribute1', 'attribute2');

    private $buttonClass = 'btn btn-primary';

    private $buttonType = 'button';

    private $onClickEvent;

    private $buttonHtml = 'Please use createHtml';

    /**
     * @return string
     */
    public function getButtonTitle() : string {

        return $this->buttonTitle;
    }

    /**
     * @param string $buttonTitle
     */
    public function setButtonTitle(string $buttonTitle) : void {

        $this->buttonTitle = $buttonTitle;
    }

    /**
     * @return array
     */
    public function getButtonAttributes() : array {

        return $this->buttonAttributes;
    }

    /**
     * @param array $buttonAttributes
     */
    public function setButtonAttributes(array $buttonAttributes) : void {

        $this->buttonAttributes = $buttonAttributes;
    }

    /**
     * @return string
     */
    public function getButtonClass() : string {

        return $this->buttonClass;
    }

    /**
     * @param string $buttonClass
     */
    public function setButtonClass(string $buttonClass) : void {

        $this->buttonClass = $buttonClass;
    }

    /**
     * @return string
     */
    public function getButtonType() : string {

        return $this->buttonType;
    }

    /**
     * @param string $buttonType
     */
    public function setButtonType(string $buttonType) : void {

        $this->buttonType = $buttonType;
    }

    /**
     * @return string
     */
    public function getOnClickEvent() : string {

        return $this->onClickEvent;
    }

    /**
     * @param string $onClickEvent
     */
    public function setOnClickEvent(string $onClickEvent) : void {

        $this->onClickEvent = $onClickEvent;
    }

    /**
     * Create button-html
     */
    public function createHtml() {

        $this->buttonHtml = "<button type='$this->buttonType' class='$this->buttonClass'>$this->buttonTitle</button>";
    }

    /**
     * Create button-html with click-function
     */
    public function createHtmlWithOnClick() {

        $attributeString = '';
        foreach ($this->buttonAttributes as $attribute) {
            $attributeString .= '`' . $attribute . '`,';

        }
        $attributeString = substr_replace($attributeString, "", -1);

        $this->buttonHtml = "<button type='$this->buttonType' class='$this->buttonClass' onclick='$this->onClickEvent($attributeString)'>$this->buttonTitle</button>";
    }

    /**
     * Echo Button
     */
    public function echoButton() {

        echo $this->buttonHtml;
    }

}