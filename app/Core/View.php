<?php

declare(strict_types=1);

namespace App\Core;

class View
{

    private function buildViewPath(string $viewName): string
    {
        return __DIR__ . '/../Views/' . $viewName . '.php';
    }


    private function _renderViewFromTemplate(string $viewPath, array $params = []): string
    {
        if (file_exists($viewPath)) {
            extract($params);
            ob_start();
            require($viewPath);
            return ob_get_clean();

        } else {
            throw new \Exception("La vue '$viewPath' est introuvable");
        }
    }


    public function render(string $viewName, array $params = [] ): void
    {
        $viewPath = $this->buildViewPath($viewName);

        $content = $this->_renderViewFromTemplate($viewPath, $params);

        ob_start();
        require(__DIR__.'/../Views/main.php');
        echo ob_get_clean();
        
    }
}