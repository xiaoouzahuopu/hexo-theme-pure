<?php
/**
 * 关于页面模板
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

// 解析配置
$profileLinks = Pure_Utils::parseProfileLinks($this->options->profileLinks);
$profileSkills = Pure_Utils::parseSkills($this->options->profileSkills);
$profileLabels = Pure_Utils::parseLabels($this->options->profileLabels);
$profileWorks = Pure_Utils::parseWorks($this->options->profileWorks);
$profileProjects = Pure_Utils::parseProjects($this->options->profileProjects);
?>

<!-- 关于页面侧边栏 -->
<aside class="sidebar" itemscope itemtype="http://schema.org/WPSideBar">
    <div class="slimContent">
        <!-- 个人链接 -->
        <?php if (!empty($profileLinks)): ?>
        <div class="widget">
            <h3 class="widget-title">个人链接</h3>
            <div class="widget-body">
                <ul class="link-list lh-2x">
                    <?php foreach ($profileLinks as $link): ?>
                    <li>
                        <?php echo htmlspecialchars($link['name']); ?>:
                        <?php if (strpos($link['url'], 'http') === 0): ?>
                        <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank"><?php echo htmlspecialchars($link['url']); ?></a>
                        <?php else: ?>
                        <a><?php echo htmlspecialchars($link['url']); ?></a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- 技能 -->
        <?php if (!empty($profileSkills)): ?>
        <div class="widget">
            <h3 class="widget-title">技能</h3>
            <div class="widget-body">
                <ul class="skill-list lh-2x">
                    <?php foreach ($profileSkills as $skill): ?>
                    <li class="clearfix">
                        <span><?php echo htmlspecialchars($skill['name']); ?></span>
                        <span class="pull-right"><?php echo htmlspecialchars($skill['level']); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- 个人标签 -->
        <?php if (!empty($profileLabels)): ?>
        <div class="widget">
            <h3 class="widget-title">个人标签</h3>
            <div class="widget-body">
                <?php foreach ($profileLabels as $label): ?>
                <span class="label label-default mb"><?php echo htmlspecialchars($label); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- 个人作品 -->
        <?php if (!empty($profileWorks)): ?>
        <div class="widget">
            <h3 class="widget-title">个人作品</h3>
            <div class="widget-body">
                <ul class="work-list lh-2x">
                    <?php foreach ($profileWorks as $work): ?>
                    <li class="clearfix">
                        <a href="<?php echo htmlspecialchars($work['url']); ?>" target="_blank" title="<?php echo htmlspecialchars($work['name']); ?>">
                            <span><?php echo htmlspecialchars($work['name']); ?></span>
                            <span class="pull-right text-muted"><?php echo htmlspecialchars($work['year']); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- 个人项目 -->
        <?php if (!empty($profileProjects)): ?>
        <div class="widget">
            <h3 class="widget-title">个人项目</h3>
            <div class="widget-body">
                <ul class="project-list list-square lh-2x">
                    <?php foreach ($profileProjects as $project): ?>
                    <li class="public source">
                        <a href="<?php echo htmlspecialchars($project['url']); ?>" target="_blank" title="<?php echo htmlspecialchars($project['name']); ?>">
                            <span class="repo-icon octicon octicon-repo"></span>
                            <span class="repo-and-owner css-truncate-target"><?php echo htmlspecialchars($project['name']); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</aside>

<main class="main" role="main">
    <article class="article archives-about article-type-normal" itemscope="">
        <header class="article-header">
            <h1 itemprop="title"><?php $this->title() ?></h1>
            <?php if ($this->options->profileDescription): ?>
            <p class="text-muted"><?php $this->options->profileDescription() ?></p>
            <?php endif; ?>
        </header>
        <div class="article-body">
            <?php $this->content(); ?>
        </div>
    </article>
    
    <?php $this->need('comments.php'); ?>
</main>

<?php $this->need('footer.php'); ?>
