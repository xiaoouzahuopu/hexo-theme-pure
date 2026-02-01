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
        <article class="article article-type-post article-index" itemscope itemtype="http://schema.org/BlogPosting">
            <header class="article-header">
                <h2 class="article-title" itemprop="name">
                    <a class="article-title-link" href="<?php $this->permalink() ?>" itemprop="url">
                        <?php $this->title() ?>
                    </a>
                </h2>
            </header>
            <div class="article-meta">
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
                <span class="article-comment">
                    <i class="icon icon-comment"></i>
                    <a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a>
                </span>
                <?php if ($this->options->showWordCount): ?>
                <span class="article-wordcount">
                    <i class="icon icon-file-text"></i>
                    字数统计: <?php echo Pure_Utils::getWordCount($this->content); ?>字
                </span>
                <span class="article-readtime">
                    <i class="icon icon-clock"></i>
                    阅读时长: <?php echo Pure_Utils::getReadTime($this->content); ?>分
                </span>
                <?php endif; ?>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
    
    <!-- 分页导航 -->
    <?php if ($this->_currentPage > 1 || $this->have()): ?>
    <nav class="pagination-nav clearfix">
        <div class="pagination-links">
            <?php if ($this->_currentPage > 1): ?>
            <a href="<?php echo $this->pageLink($this->_currentPage - 1); ?>" class="page-nav-link prev">
                <i class="icon icon-angle-left"></i> 上一页
            </a>
            <?php endif; ?>
            
            <?php 
            // 检查是否有下一页
            $db = Typecho_Db::get();
            $totalPosts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))->from('table.contents')
                ->where('type = ?', 'post')
                ->where('status = ?', 'publish'))->num;
            $pageSize = $this->options->pageSize;
            $totalPages = ceil($totalPosts / $pageSize);
            ?>
            
            <?php if ($this->_currentPage < $totalPages): ?>
            <a href="<?php echo $this->pageLink($this->_currentPage + 1); ?>" class="page-nav-link next">
                下一页 <i class="icon icon-angle-right"></i>
            </a>
            <?php endif; ?>
        </div>
        <div class="pagination-info">
            Page <?php echo $this->_currentPage; ?> of <?php echo $totalPages; ?>
        </div>
    </nav>
    <?php endif; ?>
    
    <?php else: ?>
    <!-- 单篇文章 -->
    <?php $this->need('post.php'); ?>
    <?php endif; ?>
</main>

<?php $this->need('footer.php'); ?>
