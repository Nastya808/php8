<?php
// Класс Control
class Control {
    private $background;
    private $width;
    private $height;

    public function getBackground() {
        return $this->background;
    }

    public function setBackground($background) {
        $this->background = $background;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }
}

// Класс Input, наследует Control
class Input extends Control {
    private $name;
    private $value;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }
}

// Класс Button, наследует Input
class Button extends Input {
    private $isSubmit;

    public function __construct($background, $width, $height, $name, $value, $isSubmit) {
        $this->setBackground($background);
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setName($name);
        $this->setValue($value);
        $this->setSubmitState($isSubmit);
    }

    public function getSubmitState() {
        return $this->isSubmit;
    }

    public function setSubmitState($isSubmit) {
        $this->isSubmit = $isSubmit;
    }
}

// Класс Text, наследует Input
class Text extends Input {
    private $placeholder;

    public function __construct($background, $width, $height, $name, $value, $placeholder) {
        $this->setBackground($background);
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setName($name);
        $this->setValue($value);
        $this->setPlaceholder($placeholder);
    }

    public function getPlaceholder() {
        return $this->placeholder;
    }

    public function setPlaceholder($placeholder) {
        $this->placeholder = $placeholder;
    }
}

// Класс Label, наследует Control
class Label extends Control {
    private $for;

    public function __construct($background, $width, $height, $forObject) {
        $this->setBackground($background);
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setParentName($forObject);
    }

    public function getParentName() {
        return $this->for;
    }

    public function setParentName($forObject) {
        if ($forObject instanceof Input) {
            $this->for = $forObject->getName();
        }
    }
}

// Функция convertToHTML
function convertToHTML($control) {
    $html = '';
    if ($control instanceof Button) {
        $html = "<button style='background: {$control->getBackground()}; width: {$control->getWidth()}; height: {$control->getHeight()};' name='{$control->getName()}' value='{$control->getValue()}'>Submit</button>";
    } elseif ($control instanceof Text) {
        $html = "<input type='text' style='background: {$control->getBackground()}; width: {$control->getWidth()}; height: {$control->getHeight()};' name='{$control->getName()}' value='{$control->getValue()}' placeholder='{$control->getPlaceholder()}' />";
    } elseif ($control instanceof Label) {
        $html = "<label style='background: {$control->getBackground()}; width: {$control->getWidth()}; height: {$control->getHeight()};' for='{$control->getParentName()}'>Label</label>";
    }
    return $html;
}

// Создание объектов Button, Text и Label
$button = new Button("red", "100px", "50px", "submitBtn", "Отправить", true);
$text = new Text("blue", "200px", "30px", "username", "", "Введите ваше имя");
$label = new Label("transparent", "50px", "20px", $text);

// Вывод объектов в HTML
echo convertToHTML($label);
echo convertToHTML($text);
echo convertToHTML($button);
?>
