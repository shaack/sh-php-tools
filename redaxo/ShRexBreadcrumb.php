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

    public function render(): string
    {
        $pathArray = $this->article->getPathAsArray();
        $breadcrumbHtml = "";
        $i = 0;
        $extrasMode = false;
        foreach ($pathArray as $pathId) {
            $pathArticle = rex_article::get($pathId);
            if($pathArticle->getCategory()->getName() == "Extras") {
                $extrasMode = true;
                break;
            }
            if ($i != 1) {
                $breadcrumbHtml .= "<li class='breadcrumb-item'><a href='{$pathArticle->getUrl()}'>{$pathArticle->getName()}</a></li>";
            } else {
                $breadcrumbHtml .= "<li class='breadcrumb-item'><span>{$pathArticle->getCategory()->getName()}</span></li>";
            }
            $i++;
        }
        // if article is different from the category, add the article to the breadcrumb
        if($extrasMode) {
            $breadcrumbHtml .= "<li class='breadcrumb-item'><a href='{$this->article->getUrl()}'>{$this->article->getName()}</a></li>";
        } else if ($this->article->getId() != $this->article->getCategoryId()) {
            $breadcrumbHtml .= "<li class='breadcrumb-item'><a href='{$pathArticle->getUrl()}'>{$this->article->getName()}</a></li>";
        }
        return "<nav class='nav-breadcrumb' aria-label='breadcrumb'><ol class='breadcrumb'>$breadcrumbHtml</ol></nav>";
    }
}