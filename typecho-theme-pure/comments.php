<?php
/**
 * 评论模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<?php if ($this->allow('comment')): ?>
<section id="comments" class="comment-section">
    
    <!-- 评论表单 -->
    <div class="respond" id="<?php $this->respondId(); ?>">
        <div class="comment-form-container">
            <!-- 站点信息提示 -->
            <div class="comment-site-info">
                <p>名称：<?php $this->options->title() ?></p>
                <p>头像：<?php echo $this->options->profileAvatar ? $this->options->profileAvatar : $this->options->themeUrl('assets/images/avatar.jpg'); ?></p>
                <p>链接：<?php $this->options->siteUrl(); ?></p>
                <p>介绍：<?php $this->options->description() ?></p>
            </div>
            
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="comment-form" role="form">
                <?php if($this->user->hasLogin()): ?>
                <p class="logged-in-as">
                    登录为 <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. 
                    <a href="<?php $this->options->logoutUrl(); ?>">退出登录 &raquo;</a>
                </p>
                <?php else: ?>
                <div class="comment-form-header">
                    <input type="text" name="author" id="author" placeholder="昵称" value="<?php $this->remember('author'); ?>" required>
                    <input type="email" name="mail" id="mail" placeholder="邮箱" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                    <input type="url" name="url" id="url" placeholder="网址(http://)" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                </div>
                <?php endif; ?>
                <div class="comment-form-body">
                    <textarea name="text" id="textarea" rows="5" placeholder="(๑•̀ㅂ•́)و✧来聊，快活聊!" required><?php $this->remember('text'); ?></textarea>
                </div>
                <div class="comment-form-footer">
                    <div class="comment-form-tools">
                        <span class="tool-btn" title="表情"><i class="icon icon-smile"></i></span>
                        <span class="tool-btn" title="图片"><i class="icon icon-image"></i></span>
                    </div>
                    <button type="submit" class="comment-form-submit">提交</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- 评论列表 -->
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <div class="comment-list-container">
        <h3 class="comment-title"><?php $this->commentsNum('%d 评论'); ?></h3>
        
        <div class="comment-list">
            <?php while($comments->next()): ?>
            <div id="<?php $comments->theId(); ?>" class="comment-item <?php if ($comments->levels > 0): ?>comment-child-item<?php else: ?>comment-parent-item<?php endif; ?>">
                <div class="comment-avatar">
                    <?php $comments->gravatar(48); ?>
                </div>
                <div class="comment-content">
                    <div class="comment-header">
                        <span class="comment-author">
                            <?php if ($comments->url): ?>
                            <a href="<?php $comments->url(); ?>" target="_blank" rel="nofollow noopener"><?php $comments->author(); ?></a>
                            <?php else: ?>
                            <?php $comments->author(); ?>
                            <?php endif; ?>
                        </span>
                        <span class="comment-meta">
                            <?php echo Pure_Comments::getAgent($comments->agent); ?>
                        </span>
                    </div>
                    <div class="comment-date"><?php $comments->date('Y-m-d'); ?></div>
                    <div class="comment-body">
                        <?php $comments->content(); ?>
                    </div>
                    <div class="comment-reply">
                        <?php $comments->reply('回复'); ?>
                    </div>
                </div>
                
                <?php if ($comments->children): ?>
                <div class="comment-children">
                    <?php $comments->threadedComments($options); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
        
        <!-- 评论分页 -->
        <div class="comment-pagination">
            <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
            <span class="comment-page-info">Powered By <a href="http://typecho.org" target="_blank" rel="noopener">typecho</a></span>
        </div>
    </div>
    <?php endif; ?>
    
</section>
<?php endif; ?>
