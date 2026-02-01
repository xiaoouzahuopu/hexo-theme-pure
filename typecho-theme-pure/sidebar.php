<?php
/**
 * 侧边栏模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<aside class="sidebar" itemscope itemtype="http://schema.org/WPSideBar">
    <div class="slimContent">
        
        <!-- 公告板 -->
        <?php if ($this->options->siteBoard): ?>
        <div class="widget">
            <h3 class="widget-title">公告</h3>
            <div class="widget-body">
                <?php $this->options->siteBoard() ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- 标签云 -->
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=count&ignoreZeroCount=1&desc=1&limit=30')->to($tags); ?>
        <?php if ($tags->have()): ?>
        <div class="widget">
            <h3 class="widget-title">标签云</h3>
            <div class="widget-body tagcloud">
                <?php while ($tags->next()): ?>
                <a href="<?php $tags->permalink(); ?>" class="tag-link" title="<?php $tags->name(); ?> (<?php $tags->count(); ?>)"><?php $tags->name(); ?></a>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- 归档 -->
        <div class="widget">
            <h3 class="widget-title">归档</h3>
            <div class="widget-body">
                <ul class="archive-list">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 n 月')->to($archives); ?>
                    <?php while ($archives->next()): ?>
                    <li>
                        <a href="<?php $archives->permalink(); ?>">
                            <?php $archives->date(); ?>
                        </a>
                        <span class="archive-count">(<?php $archives->count(); ?>)</span>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        
        <!-- 最新文章 -->
        <div class="widget">
            <h3 class="widget-title">最新文章</h3>
            <div class="widget-body">
                <ul class="recent-post-list list-unstyled no-thumbnail">
                    <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=5')->to($recentPosts); ?>
                    <?php while ($recentPosts->next()): ?>
                    <li>
                        <div class="item-inner">
                            <p class="item-category">
                                <?php $recentPosts->category(','); ?>
                            </p>
                            <p class="item-title">
                                <a href="<?php $recentPosts->permalink(); ?>" class="title"><?php $recentPosts->title(); ?></a>
                            </p>
                            <p class="item-date">
                                <time datetime="<?php $recentPosts->date('c'); ?>" itemprop="datePublished"><?php $recentPosts->date('Y-m-d'); ?></time>
                            </p>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        
        <!-- 分类 -->
        <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
        <?php if ($categories->have()): ?>
        <div class="widget">
            <h3 class="widget-title">分类</h3>
            <div class="widget-body">
                <ul class="category-list">
                    <?php while ($categories->next()): ?>
                    <li>
                        <a href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?></a>
                        <span class="category-count">(<?php $categories->count(); ?>)</span>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
</aside>
