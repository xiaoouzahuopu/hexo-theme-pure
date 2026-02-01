<?php
/**
 * 归档模板（分类、标签、日期归档）
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main class="main" role="main">
    <article class="content article article-archives article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title">
                <?php $this->archiveTitle(array(
                    'category'  =>  _t('分类: %s'),
                    'search'    =>  _t('搜索: %s'),
                    'tag'       =>  _t('标签: %s'),
                    'author'    =>  _t('作者: %s'),
                    'date'      =>  _t('归档: %s')
                ), '', ''); ?>
            </h1>
            <p class="text-muted">
                <?php 
                // 获取文章数量
                $count = 0;
                $temp = clone $this;
                while ($temp->next()) {
                    $count++;
                }
                echo '共 ' . $count . ' 篇文章';
                ?>
            </p>
        </header>
        <div class="article-body">
            <?php 
            // 收集文章并按年份分组
            $postsByYear = array();
            while($this->next()): 
                $year = $this->date('Y');
                if (!isset($postsByYear[$year])) {
                    $postsByYear[$year] = array();
                }
                $postsByYear[$year][] = array(
                    'title' => $this->title,
                    'permalink' => $this->permalink,
                    'date' => $this->date('Y-m-d'),
                    'datetime' => $this->date('c')
                );
            endwhile;
            ?>
            
            <?php foreach ($postsByYear as $year => $posts): ?>
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
                            <?php foreach ($posts as $post): ?>
                            <a href="<?php echo $post['permalink']; ?>" class="collection-item" itemprop="url">
                                <time datetime="<?php echo $post['datetime']; ?>" itemprop="datePublished">
                                    <?php echo $post['date']; ?>
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
    
    <!-- 分页 -->
    <?php $this->pageNav('&laquo; 上一页', '下一页 &raquo;'); ?>
</main>

<?php $this->need('footer.php'); ?>
