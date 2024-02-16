<?php

/**
 * Author: Stefan Haack (https://shaack.com)
 * Date: 2024-02-16
 */
class ShRexBreadcrumb
{
    private rex_article $article;

    public function __construct(rex_article $article = null)
    {
        if (!$article) {
            $article = rex_article::getCurrent();
        }
        $this->article = $article;
    }

    public function render()
    {
        $pathArray = $this->article->getPathAsArray();
        $breadcrumbHtml = "";
        $i = 0;
        foreach ($pathArray as $pathId) {
            $pathArticle = rex_article::get($pathId);
            if ($i != 1) {
                $breadcrumbHtml .= "<li class='breadcrumb-item'><a href='{$pathArticle->getUrl()}'>{$pathArticle->getName()}</a></li>";
            } else {
                $breadcrumbHtml .= "<li class='breadcrumb-item'><span>{$pathArticle->getName()}</span></li>";
            }
            $i++;
        }
        return "<nav class='nav-breadcrumb' aria-label='breadcrumb'><ol class='breadcrumb'>$breadcrumbHtml</ol></nav>";
    }
}