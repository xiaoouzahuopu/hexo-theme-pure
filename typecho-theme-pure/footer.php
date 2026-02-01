<?php
/**
 * 页脚模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
    
    <!-- 页脚 -->
    <footer class="footer" itemscope itemtype="http://schema.org/WPFooter">
        <!-- 社交链接 -->
        <?php if ($this->options->socialLinks): ?>
        <ul class="social-links">
            <?php 
            $socialLinks = explode("\n", $this->options->socialLinks);
            foreach ($socialLinks as $link) {
                $link = trim($link);
                if (empty($link)) continue;
                $parts = explode('|', $link);
                if (count($parts) >= 2) {
                    $name = trim($parts[0]);
                    $url = trim($parts[1]);
                    $icon = strtolower($name);
                    echo '<li><a href="' . htmlspecialchars($url) . '" target="_blank" title="' . htmlspecialchars($name) . '" data-toggle="tooltip" data-placement="top"><i class="icon icon-' . htmlspecialchars($icon) . '"></i></a></li>';
                }
            }
            ?>
        </ul>
        <?php endif; ?>
        
        <div class="copyright">
            <?php if ($this->options->showCopyright): ?>
            &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
            <?php endif; ?>
            
            <div class="publishby">
                Theme by <a href="https://github.com/cofess" target="_blank">cofess</a> base on <a href="https://github.com/cofess/hexo-theme-pure" target="_blank">pure</a>.
            </div>
            
            <?php if ($this->options->icp): ?>
            <div class="icp">
                <a href="https://beian.miit.gov.cn/" target="_blank"><?php $this->options->icp() ?></a>
            </div>
            <?php endif; ?>
            
            <?php if ($this->options->footerInfo): ?>
            <div class="footer-info">
                <?php $this->options->footerInfo() ?>
            </div>
            <?php endif; ?>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="<?php $this->options->themeUrl('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/plugin.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/application.js'); ?>"></script>
    
    <!-- 页脚代码 -->
    <?php $this->footer(); ?>
    
    <!-- 自定义JS -->
    <?php if ($this->options->customJs): ?>
    <script type="text/javascript">
        <?php $this->options->customJs() ?>
    </script>
    <?php endif; ?>
    
</body>
</html>
