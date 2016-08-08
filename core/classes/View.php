<?php

/**
 * Class View
 */
class View
{
    private $data = [];

    private $template = null;

    public function __construct($template)
    {
        try {
            $file = NEWS_ADMIN_ROOT . 'View/Template/' . $template . '.php';



            if (file_exists($file)) {
                $this->template = $file;
            } else {
                throw new Exception('Template ' . $template . ' not found!');
            }
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function assign($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render()
    {
        extract($this->data);

        require($this->template);
    }

    public function getRenderedContent()
    {
        ob_start();

        extract($this->data);

        require($this->template);

        $content = ob_get_clean();

        return $content;
    }
}