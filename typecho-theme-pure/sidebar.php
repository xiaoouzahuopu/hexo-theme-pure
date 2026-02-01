<?php
/**
 * 侧边栏模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<aside class="sidebar sidebar-right" itemscope itemtype="http://schema.org/WPSideBar">
    <div class="slimContent">
        
        <!-- 公告板 -->
        <?php if ($this->options->siteBoard): ?>
        <section class="widget widget-board">
            <h3 class="widget-title">公告</h3>
            <div class="widget-body">
                <?php $this->options->siteBoard() ?>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- 标签云 -->
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=count&ignoreZeroCount=1&desc=1&limit=30')->to($tags); ?>
        <?php if ($tags->have()): ?>
        <section class="widget widget-tagcloud">
            <h3 class="widget-title">标签云</h3>
            <div class="widget-body">
                <div class="tagcloud">
                    <?php while ($tags->next()): ?>
                    <a href="<?php $tags->permalink(); ?>" class="tag-item" title="<?php $tags->name(); ?> (<?php $tags->count(); ?>)"><?php $tags->name(); ?></a>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- 归档 -->
        <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=n 月 Y')->to($archives); ?>
        <?php if ($archives->have()): ?>
        <section class="widget widget-archive">
            <h3 class="widget-title">归档</h3>
            <div class="widget-body">
                <ul class="archive-list">
                    <?php while ($archives->next()): ?>
                    <li class="archive-item">
                        <span class="archive-bullet"></span>
                        <a href="<?php $archives->permalink(); ?>" class="archive-link">
                            <?php $archives->date(); ?>
                        </a>
                        <span class="archive-count">(<?php $archives->count(); ?>)</span>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- 最新文章 -->
        <section class="widget widget-recent">
            <h3 class="widget-title">最新文章</h3>
            <div class="widget-body">
                <ul class="recent-post-list">
                    <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=5')->to($recentPosts); ?>
                    <?php while ($recentPosts->next()): ?>
                    <li class="recent-post-item">
                        <div class="recent-post-category">
                            <?php $recentPosts->category(','); ?>
                        </div>
                        <h4 class="recent-post-title">
                            <a href="<?php $recentPosts->permalink(); ?>"><?php $recentPosts->title(); ?></a>
                        </h4>
                        <time class="recent-post-date" datetime="<?php $recentPosts->date('c'); ?>">
                            <?php $recentPosts->date('Y-m-d'); ?>
                        </time>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>
        
    </div>
</aside>
