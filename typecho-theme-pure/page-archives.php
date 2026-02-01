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

// 获取文章总数
$totalPosts = $db->fetchObject($db->select(array('COUNT(cid)' => 'num'))->from('table.contents')
    ->where('type = ?', 'post')
    ->where('status = ?', 'publish'))->num;

// 分页参数
$pageSize = 15;
$currentPage = $this->request->get('page', 1);
$offset = ($currentPage - 1) * $pageSize;
$totalPages = ceil($totalPosts / $pageSize);

// 获取当前页的文章
$posts = $db->fetchAll($db->select()->from('table.contents')
    ->where('type = ?', 'post')
    ->where('status = ?', 'publish')
    ->order('created', Typecho_Db::SORT_DESC)
    ->offset($offset)
    ->limit($pageSize));

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
    <article class="content article article-archives" itemscope="">
        <header class="article-header">
            <h1 class="article-title" itemprop="title"><?php $this->title() ?></h1>
            <p class="article-desc">共 <?php echo $totalPosts; ?> 篇文章</p>
        </header>
        <div class="article-body">
            <?php foreach ($postsByYear as $year => $yearPosts): ?>
            <section class="archive-year-section">
                <header class="archive-year-header">
                    <h3 class="archive-year-title">
                        <i class="icon icon-calendar"></i>
                        <?php echo $year; ?>
                    </h3>
                </header>
                <div class="archive-post-list">
                    <?php foreach ($yearPosts as $post): ?>
                    <?php 
                    $routeExists = (NULL != Typecho_Router::get('post'));
                    $permalink = $routeExists 
                        ? Typecho_Router::url('post', array('cid' => $post['cid']), Helper::options()->index)
                        : Helper::options()->siteUrl . '?p=' . $post['cid'];
                    ?>
                    <a href="<?php echo $permalink; ?>" class="collection-item">
                        <time datetime="<?php echo date('c', $post['created']); ?>">
                            <?php echo date('Y-m-d', $post['created']); ?>
                        </time>
                        <span class="collection-title"><?php echo htmlspecialchars($post['title']); ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endforeach; ?>
        </div>
        
        <!-- 分页导航 -->
        <?php if ($totalPages > 1): ?>
        <nav class="pagination-nav clearfix">
            <div class="pagination-links">
                <?php if ($currentPage > 1): ?>
                <a href="<?php echo $this->permalink; ?>?page=<?php echo $currentPage - 1; ?>" class="page-nav-link prev">
                    <i class="icon icon-angle-left"></i> 上一页
                </a>
                <?php endif; ?>
                
                <?php if ($currentPage < $totalPages): ?>
                <a href="<?php echo $this->permalink; ?>?page=<?php echo $currentPage + 1; ?>" class="page-nav-link next">
                    下一页 <i class="icon icon-angle-right"></i>
                </a>
                <?php endif; ?>
            </div>
            <div class="pagination-info">
                Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
            </div>
        </nav>
        <?php endif; ?>
    </article>
</main>

<?php $this->need('footer.php'); ?>
