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
    <?php $themeUrl = Helper::options()->themeUrl; ?>
    <?php if ($this->options->favicon): ?>
    <link rel="icon" href="<?php $this->options->favicon() ?>" type="image/x-icon">
    <?php else: ?>
    <link rel="icon" href="<?php echo $themeUrl; ?>/assets/images/favicon.png" type="image/x-icon">
    <?php endif; ?>
    
    <!-- 主题样式 -->
    <link rel="stylesheet" href="<?php echo $themeUrl; ?>/assets/css/style.css">
    
    <!-- 公共样式 -->
    <link rel="stylesheet" href="<?php echo $themeUrl; ?>/assets/css/common.css">
    
    <!-- 文章页面样式 -->
    <?php if ($this->is('post') || $this->is('page')): ?>
    <link rel="stylesheet" href="<?php echo $themeUrl; ?>/assets/css/article.css">
    <?php endif; ?>
    
    <!-- 关键内联样式 -->
    <style type="text/css">
    /* 基础布局 */
    * { box-sizing: border-box; }
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; padding: 0; background: #fff; }
    .main { max-width: 800px; margin: 0 auto; padding: 20px; }
    .content { background: #fff; padding: 20px 0; }
    a { color: #2196f3; text-decoration: none; }
    a:hover { text-decoration: underline; }
    
    /* 文章样式 */
    .article { background: #fff; }
    .article-header { margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
    .article-title { font-size: 1.8em; font-weight: 600; color: #333; line-height: 1.4; margin: 0 0 15px 0; }
    .article-meta { font-size: 13px; color: #999; line-height: 2; }
    .article-meta span { margin-right: 15px; display: inline-flex; align-items: center; gap: 5px; }
    .article-meta a { color: #2196f3; text-decoration: none; }
    .article-meta .icon { font-size: 14px; }
    
    /* 文章内容 */
    .article-entry { line-height: 1.8; font-size: 15px; color: #333; }
    .article-entry p { margin: 15px 0; }
    .article-entry img { max-width: 100%; height: auto; display: block; margin: 15px 0; }
    .article-entry pre { background: #f8f8f8; padding: 15px; overflow-x: auto; border-radius: 4px; font-size: 13px; margin: 15px 0; border: 1px solid #eee; }
    .article-entry code { background: #f5f5f5; padding: 2px 6px; border-radius: 3px; font-size: 90%; color: #c7254e; font-family: Consolas, Monaco, "Andale Mono", monospace; }
    .article-entry pre code { background: none; padding: 0; color: #333; font-size: 13px; }
    .article-entry ul, .article-entry ol { padding-left: 25px; margin: 15px 0; }
    .article-entry li { margin: 8px 0; line-height: 1.8; }
    .article-entry blockquote { border-left: 4px solid #ddd; padding-left: 15px; margin: 15px 0; color: #666; }
    .article-entry a { color: #2196f3; text-decoration: none; }
    .article-entry a:hover { text-decoration: underline; }
    .article-entry h2 { font-size: 1.5em; margin: 30px 0 15px; font-weight: 600; color: #333; border-bottom: 1px solid #eee; padding-bottom: 10px; }
    .article-entry h3 { font-size: 1.25em; margin: 25px 0 15px; font-weight: 600; color: #333; }
    .article-entry h4 { font-size: 1.1em; margin: 20px 0 10px; font-weight: 600; color: #333; }
    
    /* 版权信息 */
    .article-copyright { margin: 30px 0; padding: 15px 20px; background: #f5f5f5; border-radius: 4px; font-size: 13px; color: #666; line-height: 1.8; }
    .article-copyright p { margin: 5px 0; }
    .article-copyright a { color: #2196f3; }
    .article-copyright strong { color: #333; }
    
    /* 底部导航 */
    .article-nav-bottom { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; margin: 20px 0; border-top: 1px solid #eee; }
    .nav-prev-next { flex: 1; }
    .nav-link { display: inline-flex; align-items: center; gap: 5px; color: #666; text-decoration: none; font-size: 14px; transition: color 0.3s; }
    .nav-link:hover { color: #2196f3; text-decoration: none; }
    .nav-share { display: flex; align-items: center; gap: 15px; }
    .nav-share .share-btn { display: inline-flex; align-items: center; justify-content: center; color: #999; text-decoration: none; transition: color 0.3s; }
    .nav-share .share-btn:hover { color: #2196f3; text-decoration: none; }
    .nav-share .share-btn .icon { font-size: 20px; }
    
    /* 评论区 */
    .comment-section { margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee; }
    .comment-form-container { margin-bottom: 30px; }
    .logged-in-as { font-size: 14px; color: #666; margin-bottom: 15px; }
    .logged-in-as a { color: #2196f3; }
    .comment-form-header { display: flex; gap: 15px; margin-bottom: 15px; }
    .comment-form-header input { flex: 1; padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; outline: none; transition: border-color 0.3s; }
    .comment-form-header input:focus { border-color: #2196f3; }
    .comment-form-body { margin-bottom: 10px; }
    .comment-form-body textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; resize: vertical; min-height: 120px; box-sizing: border-box; outline: none; transition: border-color 0.3s; font-family: inherit; }
    .comment-form-body textarea:focus { border-color: #2196f3; }
    .comment-form-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; }
    .comment-form-tools { display: flex; gap: 10px; }
    .comment-form-tools .tool-btn { color: #999; cursor: pointer; font-size: 18px; }
    .comment-form-tools .tool-btn:hover { color: #2196f3; }
    .comment-form-submit { background: #f5f5f5; color: #333; border: 1px solid #ddd; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; transition: all 0.3s; }
    .comment-form-submit:hover { background: #2196f3; color: #fff; border-color: #2196f3; }
    
    /* 评论列表 */
    .comment-list-container { margin-top: 30px; }
    .comment-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
    .comment-list { }
    .comment-item { display: flex; gap: 15px; padding: 20px 0; border-bottom: 1px solid #f0f0f0; }
    .comment-avatar img { width: 48px; height: 48px; border-radius: 50%; }
    .comment-content { flex: 1; min-width: 0; }
    .comment-header { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 5px; }
    .comment-author { font-weight: 600; }
    .comment-author a { color: #2196f3; text-decoration: none; }
    .comment-meta { color: #999; font-size: 12px; }
    .comment-date { color: #999; font-size: 12px; margin-bottom: 8px; }
    .comment-body { line-height: 1.6; color: #333; }
    .comment-body p { margin: 5px 0; }
    .comment-reply { margin-top: 8px; }
    .comment-reply a { color: #2196f3; font-size: 13px; text-decoration: none; }
    .comment-reply a:hover { text-decoration: underline; }
    .comment-empty { text-align: center; padding: 40px 0; color: #999; font-size: 14px; }
    .comment-pagination { margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
    .comment-page-info { color: #999; }
    .comment-page-info a { color: #f60; }
    
    /* 打赏按钮 */
    .article-donate { position: fixed; bottom: 50px; left: 50%; transform: translateX(-50%); z-index: 100; }
    .donate-btn { width: 50px; height: 50px; line-height: 50px; border-radius: 50%; background: linear-gradient(135deg, #f5af19 0%, #f12711 100%); color: #fff; font-size: 18px; font-weight: bold; border: none; cursor: pointer; box-shadow: 0 4px 15px rgba(241, 39, 17, 0.3); transition: transform 0.3s, box-shadow 0.3s; }
    .donate-btn:hover { transform: scale(1.1); box-shadow: 0 6px 20px rgba(241, 39, 17, 0.4); }
    .donate-qrcode { position: absolute; bottom: 60px; left: 50%; transform: translateX(-50%); background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
    .donate-content { display: flex; gap: 20px; }
    .donate-item { text-align: center; }
    .donate-item img { width: 150px; height: 150px; }
    .donate-item p { margin-top: 10px; font-size: 14px; color: #666; }
    
    /* Icon 字体占位 - 确保图标显示 */
    .icon { font-style: normal; }
    .icon-calendar:before { content: "📅"; }
    .icon-folder:before { content: "📁"; }
    .icon-tags:before { content: "🏷"; }
    .icon-eye:before { content: "👁"; }
    .icon-comment:before { content: "💬"; }
    .icon-angle-left:before { content: "<"; }
    .icon-weibo:before { content: "微"; }
    .icon-wechat:before { content: "微"; }
    .icon-qq:before { content: "Q"; }
    .icon-facebook:before { content: "f"; }
    .icon-twitter:before { content: "t"; }
    .icon-smile:before { content: "😊"; }
    .icon-image:before { content: "🖼"; }
    </style>
    
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
                        <img class="img-circle img-rotate" src="<?php echo $this->options->profileAvatar ? $this->options->profileAvatar : $themeUrl . '/assets/images/avatar.jpg'; ?>" width="200" height="200" alt="<?php $this->options->title() ?>">
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
