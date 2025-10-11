<?php

namespace Core\View;

class View
{
    protected string $view;
    protected array $data = [];
    protected ?string $layout = null;
    protected array $meta = [];
    protected string $viewsPath = __DIR__ . '/../../app/views/';

    public function __construct(string $view, array $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    /** Crea una nueva instancia de View */
    public static function make(string $view, array $data = []): self
    {
        return new self($view, $data);
    }

    /** Define el layout y sus meta datos */
    public function withLayout(string $layout, array $meta = []): self
    {
        $this->layout = $layout;
        $this->meta = $meta;
        return $this;
    }

    /** Renderiza la vista con o sin layout */
    public function render(): string
    {
        $content = $this->renderView($this->view, $this->data);

        if ($this->layout) {
            $layoutPath = $this->viewsPath . $this->layout . '.php';
            if (!file_exists($layoutPath)) {
                throw new \Exception("Layout no encontrado: {$this->layout}");
            }

            // Los meta datos se extraen aquí
            extract($this->meta, EXTR_SKIP);

            // El contenido de la vista se pasa como variable $content
            ob_start();
            include $layoutPath;
            return ob_get_clean();
        }

        return $content;
    }

    /** Método auxiliar para renderizar solo una vista */
    protected function renderView(string $path, array $data = []): string
    {
        $viewPath = $this->viewsPath . $path . '.php';
        if (!file_exists($viewPath)) {
            throw new \Exception("Vista no encontrada: {$path}");
        }

        // Las variables del contenido se extraen aquí
        extract($data, EXTR_SKIP);

        ob_start();
        include $viewPath;
        return ob_get_clean();
    }

    /** Permite convertir directamente a string (por conveniencia) */
    public function __toString(): string
    {
        return $this->render();
    }
}
