<?php
/**
 * 独立页面模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 获取页面模板类型
$template = $this->fields->template;

// 根据模板类型加载不同的模板文件
switch ($template) {
    case 'about':
        $this->need('page-about.php');
        break;
    case 'links':
        $this->need('page-links.php');
        break;
    case 'archives':
        $this->need('page-archives.php');
        break;
    case 'categories':
        $this->need('page-categories.php');
        break;
    case 'tags':
        $this->need('page-tags.php');
        break;
    default:
        // 默认页面模板
        $this->need('header.php');
?>

<main class="main" role="main">
    <div class="content">
        <article id="page-<?php $this->cid(); ?>" class="article article-type-page" itemscope itemtype="http://schema.org/BlogPosting">
            <header class="article-header">
                <h1 itemprop="name"><?php $this->title() ?></h1>
            </header>
            <div class="article-body">
                <?php $this->content(); ?>
            </div>
        </article>
        
        <?php $this->need('comments.php'); ?>
    </div>
</main>

<?php 
        $this->need('footer.php');
        break;
}
?>
