<?php
/**
 * 标签页面模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

// 获取所有标签
$db = Typecho_Db::get();
$tags = $db->fetchAll($db->select()->from('table.metas')
    ->where('type = ?', 'tag')
    ->order('count', Typecho_Db::SORT_DESC));

// 获取标签总数
$totalTags = count($tags);

// 获取每个标签下的文章
function getTagPosts($mid) {
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
    <article class="article article-tags" itemscope="">
        <header class="article-header">
            <h1 class="article-title" itemprop="name"><?php $this->title() ?></h1>
            <p class="article-desc">共 <?php echo $totalTags; ?> 个标签</p>
        </header>
        
        <!-- 标签云 -->
        <div class="tags-cloud-section">
            <div class="tags-cloud">
                <?php foreach ($tags as $tag): ?>
                <a href="#tag-<?php echo $tag['slug']; ?>" class="tag-cloud-item" data-count="<?php echo $tag['count']; ?>">
                    <?php echo htmlspecialchars($tag['name']); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- 标签文章列表 -->
        <div class="article-body tags-body">
            <?php foreach ($tags as $tag): ?>
            <?php $tagPosts = getTagPosts($tag['mid']); ?>
            <?php if (count($tagPosts) > 0): ?>
            <section class="tag-section" id="tag-<?php echo $tag['slug']; ?>">
                <header class="tag-section-header">
                    <h3 class="tag-section-title">
                        <i class="icon icon-tag"></i>
                        <?php echo htmlspecialchars($tag['name']); ?>
                    </h3>
                    <span class="tag-section-count">(<?php echo count($tagPosts); ?> 篇文章)</span>
                </header>
                <div class="tag-post-list">
                    <?php foreach ($tagPosts as $post): ?>
                    <?php 
                    $routeExists = (NULL != Typecho_Router::get('post'));
                    $permalink = $routeExists 
                        ? Typecho_Router::url('post', array('cid' => $post['cid']), Helper::options()->index)
                        : Helper::options()->siteUrl . '?p=' . $post['cid'];
                    ?>
                    <a href="<?php echo $permalink; ?>" class="tag-post-item">
                        <time datetime="<?php echo date('c', $post['created']); ?>">
                            <?php echo date('Y-m-d', $post['created']); ?>
                        </time>
                        <span class="tag-post-title"><?php echo htmlspecialchars($post['title']); ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </article>
</main>

<?php $this->need('footer.php'); ?>
