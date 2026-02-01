<?php
/**
 * 友链页面模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

// 解析友情链接配置
$friendLinks = Pure_Utils::parseFriendLinks($this->options->friendLinks);
?>

<main class="main" role="main">
    <article class="article article-links article-type-list" itemscope="">
        <header class="article-header">
            <h1 itemprop="title"><?php $this->title() ?></h1>
            <p class="text-muted">欢迎交换链接，可在当前页面留言</p>
        </header>
        <div class="article-body">
            <?php if (!empty($friendLinks)): ?>
            <div class="row">
                <?php foreach ($friendLinks as $link): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="panel panel-default hover-shadow hover-grow">
                        <figure class="media media-middle">
                            <?php if (!empty($link['avatar'])): ?>
                            <div class="media-left pr-no">
                                <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="img-burn thumb-md media-middle">
                                    <img src="<?php echo htmlspecialchars($link['avatar']); ?>" class="w-full" alt="<?php echo htmlspecialchars($link['name']); ?>">
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="media-body p-0x">
                                <h4 class="media-heading">
                                    <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank">
                                        <span class="text-dark"><?php echo htmlspecialchars($link['name']); ?></span>
                                    </a>
                                </h4>
                                <?php if (!empty($link['desc'])): ?>
                                <div class="text-muted">
                                    <?php echo htmlspecialchars($link['desc']); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </figure>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <p class="text-muted">暂无友情链接，欢迎申请交换链接！</p>
            <?php endif; ?>
            
            <!-- 申请友链信息 -->
            <?php if ($this->options->profileAuthor || $this->options->profileAvatar): ?>
            <div class="link-apply-info">
                <p>名称：<?php echo $this->options->profileAuthor ? $this->options->profileAuthor : $this->options->title(); ?></p>
                <?php if ($this->options->profileAvatar): ?>
                <p>头像：<?php $this->options->profileAvatar() ?></p>
                <?php endif; ?>
                <p>链接：<?php $this->options->siteUrl(); ?></p>
                <?php if ($this->options->profileDescription): ?>
                <p>介绍：<?php $this->options->profileDescription() ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </article>
    
    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>
