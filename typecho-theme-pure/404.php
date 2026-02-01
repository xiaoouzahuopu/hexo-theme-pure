<?php
/**
 * 404页面模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main class="main" role="main">
    <div class="content">
        <article class="article article-type-page article-404">
            <header class="article-header">
                <h1 class="article-title">404</h1>
            </header>
            <div class="article-body text-center">
                <p class="text-muted" style="font-size: 2em; margin: 50px 0;">页面未找到</p>
                <p>很抱歉，您访问的页面不存在或已被删除。</p>
                <p>
                    <a href="<?php $this->options->siteUrl(); ?>" class="btn btn-primary">返回首页</a>
                </p>
            </div>
        </article>
    </div>
</main>

<?php $this->need('footer.php'); ?>
