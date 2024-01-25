<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShRexBootstrapNavigation
{
    private array $firstLevelCategories;
    private rex_category|null $currentCategory;
    private int $maxDepth;

    public function __construct(rex_category $firstLevelCategories = null, $maxDepth = 3)
    {
        if ($firstLevelCategories) {
            $this->firstLevelCategories = $firstLevelCategories->getChildren(true);
        } else {
            $this->firstLevelCategories = rex_category::getRootCategories(true);
        }
        $this->maxDepth = $maxDepth;
        $this->currentCategory = rex_category::getCurrent();
    }

    /**
     * @param rex_category[] $categories
     * @return string
     */
    public function render(array $categories = null): string
    {
        if (!$categories) {
            $categories = $this->firstLevelCategories;
        }
        $html = "";
        foreach ($categories as $category) {
            if (count($category->getChildren(true))) {
                $html .= $this->renderLiDropdown($category);
            } else {
                $html .= $this->renderLiLink($category);
            }
        }
        return $html;
    }

    private function hasParentOrIsSame(rex_category|null $childCategory, rex_category $parentCategory)
    {
        if(!$childCategory) {
            return false;
        }
        $parentOfChild = $childCategory->getParent();
        if ($childCategory->getId() == $parentCategory->getId()) {
            return true;
        } else if ($parentOfChild) {
            return $this->hasParentOrIsSame($parentOfChild, $parentCategory);
        }
    }

    private function renderLiLink($category) : string {
        $isActive = false;
        if ($this->hasParentOrIsSame($this->currentCategory, $category)) {
            $isActive = true;
        }
        return '<li><a class="' . ($isActive ? "active" : "") . '" href="' . $category->getUrl() . '">' . $category->getName() . '</a></li>';
    }

    private function renderLiDropdown(rex_category $category, string $chevron = "down"): string
    {
        $isActive = false;
        if ($this->hasParentOrIsSame($this->currentCategory, $category)) {
            $isActive = true;
        }
        $html = '<li class="dropdown"><a class="' . ($isActive ? "active" : "") . '" href="' . $category->getUrl() . '"><span>' . $category->getName() .
            '</span> <i class="bi bi-chevron-' . $chevron . '"></i></a><ul>';
        foreach ($category->getChildren(true) as $child) {
            if(count($child->getChildren(true)) && $this->maxDepth > 2) {
                $html .= $this->renderLiDropdown($child, "right");
            } else {
                $html .= $this->renderLiLink($child);
            }
        }
        return $html . "</ul></li>";
    }
}