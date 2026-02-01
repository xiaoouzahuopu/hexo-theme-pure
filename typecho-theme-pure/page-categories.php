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
    <article class="article article-categories" itemscope="">
        <header class="article-header">
            <h1 class="article-title" itemprop="name"><?php $this->title() ?></h1>
            <p class="article-desc">共 <?php echo $totalCategories; ?> 个分类</p>
            <nav class="category-nav" role="navigation">
                <ul class="category-tabs">
                    <li class="active"><a href="javascript:void(0);" onclick="showAllCategories()">All</a></li>
                    <?php foreach ($categories as $category): ?>
                    <li><a href="#category-<?php echo $category['slug']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </header>
        <div class="article-body">
            <?php foreach ($categories as $category): ?>
            <?php $categoryPosts = getCategoryPosts($category['mid']); ?>
            <?php if (count($categoryPosts) > 0): ?>
            <section class="category-section" id="category-<?php echo $category['slug']; ?>">
                <header class="category-section-header">
                    <h3 class="category-section-title">
                        <i class="icon icon-folder"></i>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </h3>
                    <span class="category-section-count">(Total <?php echo count($categoryPosts); ?> articles)</span>
                </header>
                <div class="category-post-list">
                    <?php foreach ($categoryPosts as $post): ?>
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
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </article>
</main>

<script>
function showAllCategories() {
    var sections = document.querySelectorAll('.category-section');
    sections.forEach(function(section) {
        section.style.display = 'block';
    });
}

// 分类标签页切换
document.querySelectorAll('.category-tabs a[href^="#"]').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        var targetId = this.getAttribute('href').substring(1);
        var sections = document.querySelectorAll('.category-section');
        
        sections.forEach(function(section) {
            if (section.id === targetId) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });
        
        // 更新活动状态
        document.querySelectorAll('.category-tabs li').forEach(function(li) {
            li.classList.remove('active');
        });
        this.parentElement.classList.add('active');
    });
});
</script>

<?php $this->need('footer.php'); ?>
