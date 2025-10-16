<?php

namespace Core\View;

class View
{
    protected string $view;
    protected array $data = [];
    protected ?string $layout = null;
    protected array $meta = [];
    protected string $viewsPath = __DIR__ . '/../../app/views/';

    // Sistema de sections (al estilo Blade)
    protected static array $sections = [];
    protected static ?string $currentSection = null;
    protected static array $sectionStack = [];

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
        // Limpiar sections antes de renderizar
        self::$sections = [];
        self::$currentSection = null;
        self::$sectionStack = [];

        // Renderizar la vista principal (aquí se definen las sections)
        $content = $this->renderView($this->view, $this->data);

        // Si hay layout, renderizarlo con el contenido
        if ($this->layout) {
            return $this->renderLayout($content);
        }

        return $content;
    }

    /** Renderiza el layout con el contenido */
    protected function renderLayout(string $content): string
    {
        $layoutPath = $this->viewsPath . $this->layout . '.php';
        if (!file_exists($layoutPath)) {
            throw new \Exception("Layout no encontrado: {$this->layout}");
        }

        // Crear closure para aislar el scope del layout
        $render = function () use ($layoutPath, $content) {
            // Extraer solo las meta variables del layout
            extract($this->meta, EXTR_SKIP);

            ob_start();
            try {
                include $layoutPath;
                return ob_get_clean();
            } catch (\Throwable $e) {
                ob_end_clean();
                throw $e;
            }
        };

        // Bind a esta instancia para acceso a métodos
        $render = $render->bindTo($this, $this);
        return $render();
    }

    /** Método auxiliar para renderizar una vista con aislamiento completo */
    protected function renderView(string $path, array $data = []): string
    {
        $viewPath = $this->viewsPath . $path . '.php';
        if (!file_exists($viewPath)) {
            throw new \Exception("Vista no encontrada: {$path}");
        }

        // Crear closure para aislar el scope completamente
        $render = function () use ($viewPath, $data) {
            // Extraer solo las variables específicas de esta vista
            extract($data, EXTR_SKIP);

            ob_start();
            try {
                include $viewPath;
                return ob_get_clean();
            } catch (\Throwable $e) {
                ob_end_clean();
                throw $e;
            }
        };

        // Bind a esta instancia para permitir $this->include() y $this->section()
        $render = $render->bindTo($this, $this);
        return $render();
    }

    /**
     * Incluye una vista parcial con variables independientes
     * Uso en vista: <?= $this->include('partials/header', ['user' => $user]) ?>
     */
    public function include(string $path, array $data = []): string
    {
        return $this->renderView($path, $data);
    }

    /**
     * Incluye una vista solo si existe
     */
    public function includeIf(string $path, array $data = []): string
    {
        $viewPath = $this->viewsPath . $path . '.php';
        if (file_exists($viewPath)) {
            return $this->renderView($path, $data);
        }
        return '';
    }

    /**
     * Incluye una vista cuando una condición es verdadera
     */
    public function includeWhen(bool $condition, string $path, array $data = []): string
    {
        if ($condition) {
            return $this->renderView($path, $data);
        }
        return '';
    }

    // ========================================
    // SISTEMA DE SECTIONS (al estilo Blade)
    // ========================================

    /**
     * Inicia una section
     * Uso: <?php $this->section('title') ?>
     */
    public function section(string $name): void
    {
        self::$sectionStack[] = $name;
        self::$currentSection = $name;
        ob_start();
    }

    /**
     * Finaliza una section
     * Uso: <?php $this->endSection() ?>
     */
    public function endSection(): void
    {
        if (empty(self::$sectionStack)) {
            throw new \Exception("No hay section activa para finalizar");
        }

        $name = array_pop(self::$sectionStack);
        self::$sections[$name] = ob_get_clean();
        self::$currentSection = end(self::$sectionStack) ?: null;
    }

    /**
     * Muestra el contenido de una section
     * Uso en layout: <?= $this->yield('title') ?>
     */
    public function yield(string $name, string $default = ''): string
    {
        return self::$sections[$name] ?? $default;
    }

    /**
     * Define una section con contenido inline
     * Uso: <?php $this->sectionContent('title', 'Mi Título') ?>
     */
    public function sectionContent(string $name, string $content): void
    {
        self::$sections[$name] = $content;
    }

    /**
     * Verifica si una section existe
     */
    public function hasSection(string $name): bool
    {
        return isset(self::$sections[$name]);
    }

    // ========================================
    // HELPERS ÚTILES
    // ========================================

    /**
     * Escapa HTML
     */
    public function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Renderiza si la condición es verdadera
     */
    public function when(bool $condition, callable $callback): string
    {
        if ($condition) {
            ob_start();
            $callback();
            return ob_get_clean();
        }
        return '';
    }

    /**
     * Renderiza si la condición es falsa
     */
    public function unless(bool $condition, callable $callback): string
    {
        return $this->when(!$condition, $callback);
    }

    /** Permite convertir directamente a string */
    public function __toString(): string
    {
        try {
            return $this->render();
        } catch (\Throwable $e) {
            return "Error renderizando vista: " . $e->getMessage();
        }
    }
}
