<?php

namespace App\Libraries;

use App\Entities\Menu;

class MenuLib
{
    public static function init()
    {
        $menu = Menu::with(['children'])->whereNull('parent_id')->get();
        $html = MenuLib::renderMenu($menu, '');
        return $html;
    }

    static function renderMenu($menus, $html, $child = false)
    {
        foreach ($menus as $menu) {
            $html .= '<li>';
                $html .= '<a href="'.(!empty($menu->route) ? route($menu->route) : "#") .'">';
                    if (!empty($menu->icon)) $html .= '<i class="' . $menu->icon . '"></i>';
                    $html .= '<span>' . $menu->name . '</span>';
                $html .= '</a>';
                if (count($menu->children) > 0) {
                    $html .= '<ul>';
                    $html = MenuLib::renderMenu($menu->children, $html, true);
                }
            $html .= '</li>';

        }
        if ($child)
            $html .= '</ul>';

        return $html;
    }


}