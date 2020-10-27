<?php

function isActive($menu)
{
    if (stripos($_SERVER["REQUEST_URI"], $menu)) {
        return true;
    }
    return false;
}