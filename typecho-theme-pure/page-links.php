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
    <article class="article article-links" itemscope="">
        <header class="article-header links-header">
            <h1 class="article-title" itemprop="title"><?php $this->title() ?></h1>
            <p class="article-desc">欢迎交换链接，可在当前页面留言</p>
        </header>
        
        <div class="article-body links-body">
            <?php if (!empty($friendLinks)): ?>
            <div class="links-grid">
                <?php foreach ($friendLinks as $link): ?>
                <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" rel="noopener" class="link-card">
                    <div class="link-card-inner">
                        <?php if (!empty($link['avatar'])): ?>
                        <div class="link-avatar">
                            <img src="<?php echo htmlspecialchars($link['avatar']); ?>" alt="<?php echo htmlspecialchars($link['name']); ?>" loading="lazy">
                        </div>
                        <?php else: ?>
                        <div class="link-avatar link-avatar-placeholder">
                            <span><?php echo mb_substr($link['name'], 0, 1); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="link-info">
                            <h4 class="link-name"><?php echo htmlspecialchars($link['name']); ?></h4>
                            <?php if (!empty($link['desc'])): ?>
                            <p class="link-desc"><?php echo htmlspecialchars($link['desc']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="links-empty">
                <p>暂无友情链接，欢迎申请交换链接！</p>
            </div>
            <?php endif; ?>
            
            <!-- 申请友链信息 -->
            <div class="links-apply">
                <p><strong>名称：</strong><?php echo $this->options->profileAuthor ? $this->options->profileAuthor : $this->options->title(); ?></p>
                <?php if ($this->options->profileAvatar): ?>
                <p><strong>头像：</strong><?php $this->options->profileAvatar() ?></p>
                <?php endif; ?>
                <p><strong>链接：</strong><?php $this->options->siteUrl(); ?></p>
                <?php if ($this->options->profileDescription): ?>
                <p><strong>介绍：</strong><?php $this->options->profileDescription() ?></p>
                <?php endif; ?>
            </div>
        </div>
    </article>
    
    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>
