<?php
/**
 * 文章模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 判断是否显示目录
$showToc = $this->options->showToc;
if ($this->fields->toc !== '') {
    $showToc = $this->fields->toc;
}

// 处理内容，添加标题锚点
$content = $this->content;
if ($showToc) {
    $content = Pure_Utils::addHeadingAnchors($this->content);
}

// 为代码块添加高亮样式包装
$content = Pure_Utils::wrapCodeBlocks($content);
?>

<?php if ($showToc): ?>
<!-- 文章目录侧边栏 -->
<aside class="sidebar sidebar-toc collapse in" id="collapseToc" itemscope itemtype="http://schema.org/WPSideBar">
    <div class="slimContent">
        <?php echo Pure_Utils::getTocNumbered($this->content); ?>
    </div>
</aside>
<?php endif; ?>

<div class="content">
    <article id="post-<?php $this->cid(); ?>" class="article article-type-post" itemscope itemtype="http://schema.org/BlogPosting">
        
        <!-- 文章头部 -->
        <header class="article-header">
            <h1 class="article-title" itemprop="name">
                <?php $this->title() ?>
            </h1>
            <div class="article-meta">
                <span class="article-date">
                    <i class="icon icon-calendar"></i>
                    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y/n/j'); ?></time>
                </span>
                <span class="article-category">
                    <i class="icon icon-folder"></i>
                    <?php $this->category(','); ?>
                </span>
                <?php if ($this->tags): ?>
                <span class="article-tag">
                    <i class="icon icon-tags"></i>
                    <?php $this->tags(', ', true, 'none'); ?>
                </span>
                <?php endif; ?>
                <span class="article-views">
                    <i class="icon icon-eye"></i>
                    <?php echo Pure_Utils::getViews($this); ?>
                </span>
                <span class="article-comment">
                    <i class="icon icon-comment"></i>
                    <?php $this->commentsNum('评论', '评论', '评论'); ?>
                </span>
            </div>
        </header>
        
        <!-- 文章内容 -->
        <div class="article-entry marked-body" itemprop="articleBody">
            <?php echo $content; ?>
        </div>
        
        <!-- 版权信息 -->
        <div class="article-copyright">
            <p><strong>本文链接：</strong><a href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a></p>
            <p><strong>版权声明：</strong>本博客所有文章除特别声明外，均采用 <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank" rel="noopener">CC BY 4.0 CN协议</a> 许可协议。转载请注明出处！</p>
        </div>
    </article>
    
    <!-- 上下篇导航和分享 -->
    <nav class="article-nav-bottom">
        <div class="nav-prev-next">
            <?php $this->thePrev('<a href="%s" class="nav-link nav-prev"><i class="icon icon-angle-left"></i> 上一篇</a>', ''); ?>
        </div>
        <div class="nav-share">
            <a href="javascript:void(0);" class="share-btn" onclick="window.open('http://service.weibo.com/share/share.php?url=<?php echo urlencode($this->permalink); ?>&title=<?php echo urlencode($this->title); ?>', '_blank', 'width=550,height=370');" title="微博">
                <i class="icon icon-weibo"></i>
            </a>
            <a href="javascript:void(0);" class="share-btn" title="微信">
                <i class="icon icon-wechat"></i>
            </a>
            <a href="javascript:void(0);" class="share-btn" onclick="window.open('http://connect.qq.com/widget/shareqq/index.html?url=<?php echo urlencode($this->permalink); ?>&title=<?php echo urlencode($this->title); ?>', '_blank', 'width=550,height=370');" title="QQ">
                <i class="icon icon-qq"></i>
            </a>
            <a href="javascript:void(0);" class="share-btn" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($this->permalink); ?>', '_blank', 'width=550,height=370');" title="Facebook">
                <i class="icon icon-facebook"></i>
            </a>
            <a href="javascript:void(0);" class="share-btn" onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo urlencode($this->permalink); ?>&text=<?php echo urlencode($this->title); ?>', '_blank', 'width=550,height=370');" title="Twitter">
                <i class="icon icon-twitter"></i>
            </a>
        </div>
    </nav>
    
    <!-- 打赏 -->
    <?php if ($this->options->showDonate && ($this->options->donateAlipay || $this->options->donateWechat)): ?>
    <div class="article-donate">
        <button class="donate-btn" type="button" onclick="toggleDonate()">赏</button>
        <div class="donate-qrcode" id="donateModal" style="display: none;">
            <div class="donate-content">
                <?php if ($this->options->donateAlipay): ?>
                <div class="donate-item">
                    <img src="<?php $this->options->donateAlipay() ?>" alt="支付宝">
                    <p>支付宝</p>
                </div>
                <?php endif; ?>
                <?php if ($this->options->donateWechat): ?>
                <div class="donate-item">
                    <img src="<?php $this->options->donateWechat() ?>" alt="微信">
                    <p>微信支付</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
    function toggleDonate() {
        var modal = document.getElementById('donateModal');
        modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
    }
    </script>
    <?php endif; ?>
    
    <!-- 评论 -->
    <?php $this->need('comments.php'); ?>
</div>
