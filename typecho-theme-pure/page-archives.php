<?php
/**
 * 归档页面模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

// 获取所有文章，按年份分组
$db = Typecho_Db::get();
$prefix = $db->getPrefix();

// 获取文章总数
$totalPosts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))->from('table.contents')
    ->where('type = ?', 'post')
    ->where('status = ?', 'publish'))->num;

// 获取所有已发布文章
$posts = $db->fetchAll($db->select()->from('table.contents')
    ->where('type = ?', 'post')
    ->where('status = ?', 'publish')
    ->order('created', Typecho_Db::SORT_DESC));

// 按年份分组
$postsByYear = array();
foreach ($posts as $post) {
    $year = date('Y', $post['created']);
    if (!isset($postsByYear[$year])) {
        $postsByYear[$year] = array();
    }
    $postsByYear[$year][] = $post;
}
?>

<main class="main" role="main">
    <article class="content article article-archives article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title"><?php $this->title() ?></h1>
            <p class="text-muted">共 <?php echo $totalPosts; ?> 篇文章</p>
        </header>
        <div class="article-body">
            <?php foreach ($postsByYear as $year => $yearPosts): ?>
            <section class="panel panel-default b-no">
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#collapse<?php echo $year; ?>" aria-expanded="true">
                            <i class="icon icon-calendar-plus text-active"></i>
                            <i class="icon icon-calendar-minus text"></i>
                            <?php echo $year; ?>
                        </a>
                    </h3>
                </div>
                <div id="collapse<?php echo $year; ?>" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">
                        <div class="collection">
                            <?php foreach ($yearPosts as $post): ?>
                            <?php 
                            // 构建永久链接
                            $routeExists = (NULL != Typecho_Router::get('post'));
                            $permalink = $routeExists 
                                ? Typecho_Router::url('post', array('cid' => $post['cid']), Helper::options()->index)
                                : Helper::options()->siteUrl . '?p=' . $post['cid'];
                            ?>
                            <a href="<?php echo $permalink; ?>" class="collection-item" itemprop="url">
                                <time datetime="<?php echo date('c', $post['created']); ?>" itemprop="datePublished">
                                    <?php echo date('Y-m-d', $post['created']); ?>
                                </time>
                                <span>&nbsp;&nbsp;&nbsp;</span>
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php endforeach; ?>
        </div>
    </article>
</main>

<?php $this->need('footer.php'); ?>
