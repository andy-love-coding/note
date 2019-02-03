<?php

// 获取当前路由名称，并把 "." 替换成 "_" 
function route_class()
{
    // `Route::currentRouteName()` 会获取当前路由的名称，即 ->name('路由名称') 中的名称，而不是获取路由路径
    return str_replace('.', '-', Route::currentRouteName());
}