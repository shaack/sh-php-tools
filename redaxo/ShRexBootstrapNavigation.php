<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * License: MIT
 */

class ShRexBootstrapNavigation
{
    public static function renderChildsInline($categoryId = null)
    {
        if (!$categoryId) {
            $items = rex_category::getRootCategories(true);
        } else {
            $items = rex_category::get($categoryId)->getChildren(true);
        }
        $itemsHtml = "";
        $lang = rex_clang::getCurrentId();
        $itemsHtml .= "<li class='list-inline-item'><span role='button' class='link-primary' onclick='window.cookieConsent.showDialog()'>" . ($lang == 1 ? "Cookie-Einstellungen" : "Cookie settings") . "</span></li>";
        foreach ($items as $item) {
            $itemsHtml .= "<li class='list-inline-item'><a href='{$item->getUrl()}'>{$item->getName()}</a></li>";
        }
        return "<ul class='list-inline'>$itemsHtml</ul>";
    }

    public static function renderExtras($categoryId)
    {
        $categories = rex_category::get($categoryId)->getChildren(true);
        $html = "";
        foreach ($categories as $category) {
            $html .= "<li class='nav-item'><a class='nav-link' href='" . $category->getUrl() . "'>" . $category->getName() . "</a></li>";
        }
        return $html;
    }

    public static function renderCols($categoryId = null)
    {
        if (!$categoryId) {
            $categories = rex_category::getRootCategories(true);
        } else {
            $categories = rex_category::get($categoryId)->getChildren(true);
        }

        $colsHtml = "";
        foreach ($categories as $category) {
            if($category->getValue("cat_hide_in_footer") == "|true|") {
                continue;
            }
            $items = $category->getChildren(true);
            $itemsHtml = "";
            // $itemsHtml .= "<li><a href='{$category->getUrl()}'>{$category->getName()}</a></li>";
            foreach ($items as $item) {
                $itemsHtml .= "<li><a class='text-decoration-none' href='{$item->getUrl()}'>{$item->getName()}</a></li>";
            }
            $colsHtml .= "<div class='col-auto' style='min-width: 180px'><h4><a href='{$category->getUrl()}' class='text-decoration-none'>{$category->getName()}</a></h4><ul class='list-unstyled'>$itemsHtml</ul></div>";
        }
        return "<div class='row'>" . $colsHtml . "</div>";
    }
}