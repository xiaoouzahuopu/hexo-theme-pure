<?php
/**
 * 头部模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 引入主题函数
require_once dirname(__FILE__) . '/functions.php';

// 获取主题配置
$themeConfig = $this->options;

// 布局类名
$bodyClass = 'main-center';
if ($themeConfig->layout) {
    $bodyClass = $themeConfig->layout;
}
if ($themeConfig->skin) {
    $bodyClass .= ' ' . $themeConfig->skin;
}
// 如果是关于页面，使用特殊布局
if ($this->is('page') && $this->fields->template == 'about') {
    $bodyClass .= ' page-about';
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no,email=no,adress=no">
    <meta name="theme-color" content="#000000">
    <meta http-equiv="window-target" content="_top">
    
    <title><?php $this->archiveTitle(array(
        'category'  =>  _t('分类 %s 下的文章'),
        'search'    =>  _t('包含关键字 %s 的文章'),
        'tag'       =>  _t('标签 %s 下的文章'),
        'author'    =>  _t('%s 发布的文章')
    ), '', ' - '); ?><?php $this->options->title(); ?></title>
    
    <!-- 规范链接 -->
    <link rel="canonical" href="<?php $this->permalink() ?>">
    
    <!-- RSS -->
    <?php if ($this->options->feedUrl): ?>
    <link rel="alternate" href="<?php $this->options->feedUrl() ?>" title="<?php $this->options->title() ?>" type="application/atom+xml">
    <?php endif; ?>
    
    <!-- Favicon -->
    <?php if ($this->options->favicon): ?>
    <link rel="icon" href="<?php $this->options->favicon() ?>" type="image/x-icon">
    <?php else: ?>
    <link rel="icon" href="<?php $this->options->themeUrl('assets/images/favicon.png'); ?>" type="image/x-icon">
    <?php endif; ?>
    
    <!-- 主题样式 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/style.css'); ?>">
    
    <!-- 自定义CSS -->
    <?php if ($this->options->customCss): ?>
    <style type="text/css">
        <?php $this->options->customCss() ?>
    </style>
    <?php endif; ?>
    
    <!-- 页头代码 -->
    <?php $this->header(); ?>
</head>
<body class="<?php echo $bodyClass; ?>" itemscope itemtype="http://schema.org/WebPage">
    
    <!-- 头部导航 -->
    <header class="header" itemscope itemtype="http://schema.org/WPHeader">
        <div class="slimContent">
            <div class="navbar-header">
                <!-- 个人信息区域 -->
                <?php if ($this->options->showProfile): ?>
                <div class="profile-block text-center">
                    <a id="avatar" href="<?php echo $this->options->profileFollow ? $this->options->profileFollow : $this->options->siteUrl(); ?>" target="_blank">
                        <img class="img-circle img-rotate" src="<?php echo $this->options->profileAvatar ? $this->options->profileAvatar : $this->options->themeUrl('assets/images/avatar.jpg'); ?>" width="200" height="200" alt="<?php $this->options->title() ?>">
                    </a>
                    <h2 id="name" class="hidden-xs hidden-sm"><?php echo $this->options->profileAuthor ? $this->options->profileAuthor : $this->author->screenName; ?></h2>
                    <h3 id="title" class="hidden-xs hidden-sm hidden-md"><?php echo $this->options->profileTitle ? $this->options->profileTitle : ''; ?></h3>
                    <small id="location" class="text-muted hidden-xs hidden-sm">
                        <?php if ($this->options->profileLocation): ?>
                        <i class="icon icon-map-marker"></i> <?php $this->options->profileLocation() ?>
                        <?php endif; ?>
                    </small>
                </div>
                <?php endif; ?>
                
                <!-- 搜索框 -->
                <div class="search" id="search-form-wrap">
                    <form class="search-form sidebar-form" method="post" action="<?php $this->options->siteUrl(); ?>">
                        <div class="input-group">
                            <input type="text" name="s" class="search-form-input form-control" placeholder="搜索" autocomplete="off">
                            <span class="input-group-btn">
                                <button type="submit" class="search-form-submit btn btn-flat"><i class="icon icon-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                
                <!-- 移动端菜单按钮 -->
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            
            <!-- 主导航 -->
            <nav id="main-navbar" class="collapse navbar-collapse" itemscope itemtype="http://schema.org/SiteNavigationElement" role="navigation">
                <ul class="nav navbar-nav main-nav">
                    <li class="menu-item menu-item-home <?php if($this->is('index')): ?>active<?php endif; ?>">
                        <a href="<?php $this->options->siteUrl(); ?>">
                            <i class="icon icon-home-fill"></i>
                            <span class="menu-title">首页</span>
                        </a>
                    </li>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li class="menu-item menu-item-<?php echo strtolower($pages->slug); ?> <?php if($this->is('page', $pages->slug)): ?>active<?php endif; ?>">
                        <a href="<?php $pages->permalink(); ?>">
                            <?php 
                            // 根据页面slug设置图标
                            $icons = array(
                                'archives' => 'icon-archives-fill',
                                'archive' => 'icon-archives-fill',
                                'categories' => 'icon-folder',
                                'category' => 'icon-folder',
                                'tags' => 'icon-tags',
                                'links' => 'icon-friendship',
                                'link' => 'icon-friendship',
                                'about' => 'icon-cup-fill',
                                'projects' => 'icon-project',
                                'project' => 'icon-project',
                            );
                            $slug = strtolower($pages->slug);
                            $icon = isset($icons[$slug]) ? $icons[$slug] : 'icon-file';
                            ?>
                            <i class="icon <?php echo $icon; ?>"></i>
                            <span class="menu-title"><?php $pages->title(); ?></span>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                
                <!-- 社交链接 -->
                <?php if ($this->options->socialLinks): ?>
                <ul class="social-links">
                    <?php 
                    $socialLinks = explode("\n", $this->options->socialLinks);
                    foreach ($socialLinks as $link) {
                        $link = trim($link);
                        if (empty($link)) continue;
                        $parts = explode('|', $link);
                        if (count($parts) >= 2) {
                            $name = trim($parts[0]);
                            $url = trim($parts[1]);
                            $icon = strtolower($name);
                            echo '<li><a href="' . htmlspecialchars($url) . '" target="_blank" title="' . htmlspecialchars($name) . '" data-toggle="tooltip" data-placement="top"><i class="icon icon-' . htmlspecialchars($icon) . '"></i></a></li>';
                        }
                    }
                    ?>
                </ul>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    
    <!-- 侧边栏 -->
    <?php if (!($this->is('page') && $this->fields->template == 'about')): ?>
    <?php $this->need('sidebar.php'); ?>
    <?php endif; ?>
