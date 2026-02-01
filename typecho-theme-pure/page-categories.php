<?php
/**
 * 分类页面模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

// 获取所有分类
$db = Typecho_Db::get();
$categories = $db->fetchAll($db->select()->from('table.metas')
    ->where('type = ?', 'category')
    ->order('order', Typecho_Db::SORT_ASC));

// 获取分类总数
$totalCategories = count($categories);

// 获取每个分类下的文章
function getCategoryPosts($mid) {
    $db = Typecho_Db::get();
    $posts = $db->fetchAll($db->select('table.contents.cid', 'table.contents.title', 'table.contents.slug', 'table.contents.created')
        ->from('table.contents')
        ->join('table.relationships', 'table.contents.cid = table.relationships.cid')
        ->where('table.relationships.mid = ?', $mid)
        ->where('table.contents.type = ?', 'post')
        ->where('table.contents.status = ?', 'publish')
        ->order('table.contents.created', Typecho_Db::SORT_DESC));
    return $posts;
}
?>

<main class="main" role="main">
    <article class="article article-categories article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="name" class="hidden-xs"><?php $this->title() ?></h1>
            <p class="text-muted hidden-xs">共 <?php echo $totalCategories; ?> 个分类</p>
            <nav role="navigation" id="nav-main" class="okayNav">
                <ul>
                    <li><a href="<?php $this->options->siteUrl(); ?>categories">All</a></li>
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo Typecho_Router::url('category', array('slug' => $category['slug']), Helper::options()->index); ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </header>
        <div class="article-body">
            <?php foreach ($categories as $category): ?>
            <?php $categoryPosts = getCategoryPosts($category['mid']); ?>
            <?php if (count($categoryPosts) > 0): ?>
            <div class="panel panel-default b-no">
                <div class="panel-heading" role="tab">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" href="#collapse<?php echo $category['slug']; ?>" aria-expanded="true">
                            <i class="icon icon-folder text-active"></i>
                            <i class="icon icon-folder-open text"></i>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </a>
                        <small class="text-muted">(Total <?php echo count($categoryPosts); ?> articles)</small>
                    </h3>
                </div>
                <div id="collapse<?php echo $category['slug']; ?>" class="panel-collapse collapse in" role="tabpanel">
                    <div class="panel-body">
                        <div class="collection">
                            <?php foreach ($categoryPosts as $post): ?>
                            <?php 
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
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </article>
</main>

<?php $this->need('footer.php'); ?>
