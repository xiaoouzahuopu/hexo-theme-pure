<?php
/**
 * Typecho Pure Theme
 * 
 * 基于 hexo-theme-pure 移植的 Typecho 主题
 * 一个简洁且功能丰富的博客主题
 * 
 * @package Pure
 * @author cofess
 * @version 1.0.0
 * @link https://github.com/cofess/hexo-theme-pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need('header.php');
?>

<main class="main" role="main">
    <?php if ($this->is('index')): ?>
    <div class="content article-list">
        <?php while($this->next()): ?>
        <article class="article article-type-post" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="article-header">
                <h2 class="article-title" itemprop="name">
                    <a class="article-title-link" href="<?php $this->permalink() ?>" itemprop="url">
                        <?php $this->title() ?>
                    </a>
                </h2>
            </div>
            <?php if ($this->options->showExcerpt && $this->excerpt): ?>
            <div class="article-entry text-muted" itemprop="description">
                <?php $this->excerpt(200, '...'); ?>
            </div>
            <?php endif; ?>
            <p class="article-meta">
                <span class="article-date">
                    <i class="icon icon-calendar"></i>
                    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y/n/j'); ?></time>
                </span>
                <span class="article-category">
                    <i class="icon icon-folder"></i>
                    <?php $this->category(','); ?>
                </span>
                <?php if ($this->tags): ?>
                <span class="article-tag">
                    <i class="icon icon-tags"></i>
                    <?php $this->tags(', ', true, 'none'); ?>
                </span>
                <?php endif; ?>
                <span class="post-comment">
                    <i class="icon icon-comment"></i>
                    <a href="<?php $this->permalink() ?>#comments" class="article-comment-link"><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a>
                </span>
                <?php if ($this->options->showWordCount): ?>
                <span class="post-wordcount">
                    <i class="icon icon-file-text"></i>
                    字数统计: <?php echo Pure_Utils::getWordCount($this->content); ?>字
                </span>
                <span class="post-readtime">
                    <i class="icon icon-clock"></i>
                    阅读时长: <?php echo Pure_Utils::getReadTime($this->content); ?>分
                </span>
                <?php endif; ?>
            </p>
        </article>
        <?php endwhile; ?>
    </div>
    <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;', 1, '...', array(
        'wrapTag' => 'nav',
        'wrapClass' => 'bar bar-footer clearfix',
        'itemTag' => 'ul',
        'itemClass' => 'pager pull-left',
        'textTag' => 'li',
        'currentClass' => 'current',
        'prevClass' => 'prev',
        'nextClass' => 'next'
    )); ?>
    <?php else: ?>
    <!-- 单篇文章 -->
    <?php $this->need('post.php'); ?>
    <?php endif; ?>
</main>

<?php $this->need('footer.php'); ?>
