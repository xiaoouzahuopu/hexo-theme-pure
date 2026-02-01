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
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="comment-form" role="form">
                <?php if($this->user->hasLogin()): ?>
                <p class="logged-in-as">
                    登录为 <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. 
                    <a href="<?php $this->options->logoutUrl(); ?>">退出登录 &raquo;</a>
                </p>
                <?php else: ?>
                <div class="comment-form-fields row">
                    <div class="col-md-4">
                        <input type="text" name="author" id="author" class="form-control" placeholder="昵称" value="<?php $this->remember('author'); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <input type="email" name="mail" id="mail" class="form-control" placeholder="邮箱" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                    </div>
                    <div class="col-md-4">
                        <input type="url" name="url" id="url" class="form-control" placeholder="网址(http://)" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                    </div>
                </div>
                <?php endif; ?>
                <div class="comment-form-textarea">
                    <textarea name="text" id="textarea" class="form-control" rows="5" placeholder="(๑•̀ㅂ•́)و✧来聊，快活聊!" required><?php $this->remember('text'); ?></textarea>
                </div>
                <div class="comment-form-submit clearfix">
                    <button type="submit" class="btn btn-default pull-right">提交</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- 评论列表 -->
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <div class="comment-list-container">
        <h3 class="comment-title"><?php $this->commentsNum('%d 评论'); ?></h3>
        
        <ol class="comment-list">
            <?php while($comments->next()): ?>
            <li id="<?php $comments->theId(); ?>" class="comment-item <?php if ($comments->levels > 0): ?>comment-child<?php else: ?>comment-parent<?php endif; ?>">
                <div class="comment-body">
                    <div class="comment-avatar">
                        <?php $comments->gravatar(50); ?>
                    </div>
                    <div class="comment-content">
                        <div class="comment-meta">
                            <span class="comment-author">
                                <a href="<?php $comments->url(); ?>" target="_blank" rel="nofollow"><?php $comments->author(); ?></a>
                            </span>
                            <span class="comment-ua text-muted">
                                <?php echo Pure_Comments::getAgent($comments->agent); ?>
                            </span>
                            <span class="comment-date text-muted">
                                <?php $comments->date('Y-m-d'); ?>
                            </span>
                            <span class="comment-reply">
                                <?php $comments->reply('回复'); ?>
                            </span>
                        </div>
                        <div class="comment-text">
                            <?php $comments->content(); ?>
                        </div>
                    </div>
                </div>
                
                <?php if ($comments->children): ?>
                <ol class="comment-children">
                    <?php $comments->threadedComments($options); ?>
                </ol>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        </ol>
        
        <!-- 评论分页 -->
        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    </div>
    <?php endif; ?>
    
</section>
<?php endif; ?>
