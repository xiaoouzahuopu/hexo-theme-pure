<?php
/**
 * 主题函数
 * 
 * @package Pure
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 主题初始化
 */
function themeInit($archive) {
    Helper::options()->commentsMaxNestingLevels = 999;
    Helper::options()->commentsOrder = 'DESC';
}

/**
 * 主题配置
 */
function themeConfig($form) {
    // 基本设置
    $layout = new Typecho_Widget_Helper_Form_Element_Select(
        'layout',
        array(
            'main-left' => '左侧布局',
            'main-center' => '居中布局',
            'main-right' => '右侧布局'
        ),
        'main-center',
        _t('布局方式'),
        _t('选择页面的整体布局方式')
    );
    $form->addInput($layout);
    
    $skin = new Typecho_Widget_Helper_Form_Element_Select(
        'skin',
        array(
            '' => '默认主题',
            'theme-black' => '黑色主题',
            'theme-blue' => '蓝色主题',
            'theme-green' => '绿色主题',
            'theme-purple' => '紫色主题'
        ),
        '',
        _t('主题配色'),
        _t('选择主题的配色方案')
    );
    $form->addInput($skin);
    
    // 网站图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text(
        'favicon',
        NULL,
        '',
        _t('网站图标'),
        _t('填写网站图标的完整URL，留空使用默认图标')
    );
    $form->addInput($favicon);
    
    // 个人信息设置
    $showProfile = new Typecho_Widget_Helper_Form_Element_Radio(
        'showProfile',
        array('1' => '显示', '0' => '隐藏'),
        '1',
        _t('显示个人信息'),
        _t('是否在侧边栏显示个人信息区域')
    );
    $form->addInput($showProfile);
    
    $profileAvatar = new Typecho_Widget_Helper_Form_Element_Text(
        'profileAvatar',
        NULL,
        '',
        _t('头像地址'),
        _t('填写头像图片的完整URL')
    );
    $form->addInput($profileAvatar);
    
    $profileAuthor = new Typecho_Widget_Helper_Form_Element_Text(
        'profileAuthor',
        NULL,
        '',
        _t('作者昵称'),
        _t('显示在头像下方的名称')
    );
    $form->addInput($profileAuthor);
    
    $profileTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'profileTitle',
        NULL,
        '',
        _t('作者头衔'),
        _t('例如：Web Developer & Designer')
    );
    $form->addInput($profileTitle);
    
    $profileLocation = new Typecho_Widget_Helper_Form_Element_Text(
        'profileLocation',
        NULL,
        '',
        _t('所在地'),
        _t('例如：Shenzhen, China')
    );
    $form->addInput($profileLocation);
    
    $profileFollow = new Typecho_Widget_Helper_Form_Element_Text(
        'profileFollow',
        NULL,
        '',
        _t('关注链接'),
        _t('点击头像跳转的链接，如Github主页')
    );
    $form->addInput($profileFollow);
    
    $profileDescription = new Typecho_Widget_Helper_Form_Element_Text(
        'profileDescription',
        NULL,
        '',
        _t('个人简介'),
        _t('关于页面显示的个人简介')
    );
    $form->addInput($profileDescription);
    
    // 个人链接（关于页面显示）
    $profileLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'profileLinks',
        NULL,
        '',
        _t('个人链接'),
        _t('关于页面显示的个人链接，每行一个，格式：名称|链接<br>例如：<br>Github|https://github.com/xxx<br>Blog|https://xxx.com')
    );
    $form->addInput($profileLinks);
    
    // 技能列表（关于页面显示）
    $profileSkills = new Typecho_Widget_Helper_Form_Element_Textarea(
        'profileSkills',
        NULL,
        '',
        _t('技能列表'),
        _t('关于页面显示的技能列表，每行一个，格式：技能名|评分<br>例如：<br>Javascript|★★★★☆<br>HTML+CSS|★★★★★')
    );
    $form->addInput($profileSkills);
    
    // 个人标签
    $profileLabels = new Typecho_Widget_Helper_Form_Element_Textarea(
        'profileLabels',
        NULL,
        '',
        _t('个人标签'),
        _t('关于页面显示的个人标签，每行一个<br>例如：<br>前端<br>前端开发<br>Web前端')
    );
    $form->addInput($profileLabels);
    
    // 个人作品
    $profileWorks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'profileWorks',
        NULL,
        '',
        _t('个人作品'),
        _t('关于页面显示的个人作品，每行一个，格式：作品名|链接|年份<br>例如：<br>必应壁纸|https://xxx.com|2016')
    );
    $form->addInput($profileWorks);
    
    // 个人项目
    $profileProjects = new Typecho_Widget_Helper_Form_Element_Textarea(
        'profileProjects',
        NULL,
        '',
        _t('个人项目'),
        _t('关于页面显示的个人项目，每行一个，格式：项目名|链接<br>例如：<br>xCss/Valine|https://github.com/xCss/Valine')
    );
    $form->addInput($profileProjects);
    
    // 社交链接
    $socialLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'socialLinks',
        NULL,
        '',
        _t('社交链接'),
        _t('社交媒体链接，每行一个，格式：名称|链接<br>支持的图标：github, weibo, twitter, facebook, dribbble, behance, rss<br>例如：<br>github|https://github.com/xxx<br>weibo|https://weibo.com/xxx')
    );
    $form->addInput($socialLinks);
    
    // 友情链接
    $friendLinks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'friendLinks',
        NULL,
        '',
        _t('友情链接'),
        _t('友链页面显示的链接，每行一个，格式：名称|链接|头像|描述<br>例如：<br>云淡风轻|https://ioliu.cn|https://ioliu.cn/avatar.jpg|一个安静的角落')
    );
    $form->addInput($friendLinks);
    
    // 站点公告
    $siteBoard = new Typecho_Widget_Helper_Form_Element_Textarea(
        'siteBoard',
        NULL,
        '<p>欢迎交流与分享经验!</p>',
        _t('站点公告'),
        _t('显示在侧边栏的公告内容，支持HTML')
    );
    $form->addInput($siteBoard);
    
    // 显示设置
    $showExcerpt = new Typecho_Widget_Helper_Form_Element_Radio(
        'showExcerpt',
        array('1' => '显示', '0' => '隐藏'),
        '1',
        _t('显示文章摘要'),
        _t('是否在首页文章列表显示摘要')
    );
    $form->addInput($showExcerpt);
    
    $showWordCount = new Typecho_Widget_Helper_Form_Element_Radio(
        'showWordCount',
        array('1' => '显示', '0' => '隐藏'),
        '1',
        _t('显示字数统计'),
        _t('是否显示文章字数统计和阅读时长')
    );
    $form->addInput($showWordCount);
    
    $showToc = new Typecho_Widget_Helper_Form_Element_Radio(
        'showToc',
        array('1' => '显示', '0' => '隐藏'),
        '1',
        _t('显示文章目录'),
        _t('是否在文章页面显示目录导航')
    );
    $form->addInput($showToc);
    
    $showCopyright = new Typecho_Widget_Helper_Form_Element_Radio(
        'showCopyright',
        array('1' => '显示', '0' => '隐藏'),
        '1',
        _t('显示版权信息'),
        _t('是否在页脚显示版权信息')
    );
    $form->addInput($showCopyright);
    
    $showDonate = new Typecho_Widget_Helper_Form_Element_Radio(
        'showDonate',
        array('1' => '显示', '0' => '隐藏'),
        '0',
        _t('显�����打赏'),
        _t('是否在文章末尾显示打赏按钮')
    );
    $form->addInput($showDonate);
    
    $donateAlipay = new Typecho_Widget_Helper_Form_Element_Text(
        'donateAlipay',
        NULL,
        '',
        _t('支付宝收款码'),
        _t('支付宝收款二维码图片URL')
    );
    $form->addInput($donateAlipay);
    
    $donateWechat = new Typecho_Widget_Helper_Form_Element_Text(
        'donateWechat',
        NULL,
        '',
        _t('微信收款码'),
        _t('微信收款二维码图片URL')
    );
    $form->addInput($donateWechat);
    
    // 备案信息
    $icp = new Typecho_Widget_Helper_Form_Element_Text(
        'icp',
        NULL,
        '',
        _t('ICP备案号'),
        _t('网站ICP备案号，留空不显示')
    );
    $form->addInput($icp);
    
    $footerInfo = new Typecho_Widget_Helper_Form_Element_Textarea(
        'footerInfo',
        NULL,
        '',
        _t('页脚附加信息'),
        _t('显示在页脚的额外信息，支持HTML')
    );
    $form->addInput($footerInfo);
    
    // 自定义代码
    $customCss = new Typecho_Widget_Helper_Form_Element_Textarea(
        'customCss',
        NULL,
        '',
        _t('自定义CSS'),
        _t('自定义CSS样式代码')
    );
    $form->addInput($customCss);
    
    $customJs = new Typecho_Widget_Helper_Form_Element_Textarea(
        'customJs',
        NULL,
        '',
        _t('自定义JavaScript'),
        _t('自定义JavaScript代码')
    );
    $form->addInput($customJs);
}

/**
 * 文章自定义字段
 */
function themeFields($layout) {
$template = new Typecho_Widget_Helper_Form_Element_Select(
  'template',
  array(
  '' => '默认模板',
  'about' => '关于页面',
  'links' => '友链页面',
  'archives' => '归档页面',
  'categories' => '分类页面',
  'tags' => '标签页面'
  ),
        '',
        _t('页面模板'),
        _t('选择页面使用的模板')
    );
    $layout->addItem($template);
    
    $thumbnail = new Typecho_Widget_Helper_Form_Element_Text(
        'thumbnail',
        NULL,
        '',
        _t('缩略图'),
        _t('文章缩略图URL')
    );
    $layout->addItem($thumbnail);
    
    $toc = new Typecho_Widget_Helper_Form_Element_Radio(
        'toc',
        array(
            '' => '跟随全局设置',
            '1' => '显示目录',
            '0' => '隐藏目录'
        ),
        '',
        _t('文章目录'),
        _t('是否显示文章目录导航')
    );
    $layout->addItem($toc);
}

/**
 * 评论辅助类
 */
class Pure_Comments {
    
    /**
     * 解析用户代理信息
     */
    public static function getAgent($agent) {
        $result = '';
        
        // 解析浏览器
        if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $matches)) {
            $result .= '<span class="browser">IE ' . $matches[1] . '</span>';
        } elseif (preg_match('/Firefox\/([^\s]+)/i', $agent, $matches)) {
            $result .= '<span class="browser">Firefox ' . $matches[1] . '</span>';
        } elseif (preg_match('/Chrome\/([^\s]+)/i', $agent, $matches)) {
            $chrome_ver = $matches[1];
            if (preg_match('/Edge\/([^\s]+)/i', $agent, $matches)) {
                $result .= '<span class="browser">Edge ' . $matches[1] . '</span>';
            } else {
                $result .= '<span class="browser">Chrome ' . $chrome_ver . '</span>';
            }
        } elseif (preg_match('/Safari\/([^\s]+)/i', $agent, $matches)) {
            $result .= '<span class="browser">Safari ' . $matches[1] . '</span>';
        } elseif (preg_match('/Opera\/([^\s]+)/i', $agent, $matches)) {
            $result .= '<span class="browser">Opera ' . $matches[1] . '</span>';
        }
        
        // 解析操作系统
        if (strpos($agent, 'Windows NT 10.0') !== false) {
            $result .= ' <span class="os">Windows 10/11</span>';
        } elseif (strpos($agent, 'Windows NT 6.3') !== false) {
            $result .= ' <span class="os">Windows 8.1</span>';
        } elseif (strpos($agent, 'Windows NT 6.2') !== false) {
            $result .= ' <span class="os">Windows 8</span>';
        } elseif (strpos($agent, 'Windows NT 6.1') !== false) {
            $result .= ' <span class="os">Windows 7</span>';
        } elseif (strpos($agent, 'Mac OS X') !== false) {
            if (preg_match('/Mac OS X ([0-9_]+)/i', $agent, $matches)) {
                $result .= ' <span class="os">macOS ' . str_replace('_', '.', $matches[1]) . '</span>';
            } else {
                $result .= ' <span class="os">macOS</span>';
            }
        } elseif (strpos($agent, 'Linux') !== false) {
            if (strpos($agent, 'Android') !== false) {
                $result .= ' <span class="os">Android</span>';
            } else {
                $result .= ' <span class="os">Linux</span>';
            }
        } elseif (strpos($agent, 'iPhone') !== false) {
            $result .= ' <span class="os">iOS</span>';
        } elseif (strpos($agent, 'iPad') !== false) {
            $result .= ' <span class="os">iPadOS</span>';
        }
        
        return $result;
    }
}

/**
 * 工具类
 */
class Pure_Utils {
    
    /**
     * 获取文章字数
     */
    public static function getWordCount($content) {
        $content = strip_tags($content);
        $content = preg_replace('/\s+/', '', $content);
        return mb_strlen($content, 'UTF-8');
    }
    
    /**
     * 获取阅读时长（分钟）
     */
    public static function getReadTime($content) {
        $wordCount = self::getWordCount($content);
        $readTime = ceil($wordCount / 300); // 假设每分钟阅读300字
        return max(1, $readTime);
    }
    
    /**
     * 获取文章浏览量
     */
    public static function getViews($archive) {
        $cid = $archive->cid;
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        
        // 尝试从fields中获取views
        $row = $db->fetchRow($db->select('str_value')
            ->from('table.fields')
            ->where('cid = ?', $cid)
            ->where('name = ?', 'views'));
        
        if ($row) {
            return intval($row['str_value']);
        }
        
        // 如果没有views字段，返回评论数作为替代
        return $archive->commentsNum;
    }
    
    /**
     * 增加文章浏览量
     */
    public static function addViews($archive) {
        $cid = $archive->cid;
        $db = Typecho_Db::get();
        
        // 检查是否存在views字段
        $row = $db->fetchRow($db->select('str_value')
            ->from('table.fields')
            ->where('cid = ?', $cid)
            ->where('name = ?', 'views'));
        
        if ($row) {
            // 更新
            $db->query($db->update('table.fields')
                ->rows(array('str_value' => intval($row['str_value']) + 1))
                ->where('cid = ?', $cid)
                ->where('name = ?', 'views'));
        } else {
            // 插入
            $db->query($db->insert('table.fields')
                ->rows(array(
                    'cid' => $cid,
                    'name' => 'views',
                    'type' => 'str',
                    'str_value' => '1',
                    'int_value' => 0,
                    'float_value' => 0
                )));
        }
    }
    
    /**
     * 生成文章目录
     */
    public static function getToc($content) {
        $pattern = '/<h([2-4])[^>]*>(.+?)<\/h\1>/is';
        $toc = '';
        
        if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
            $toc .= '<nav id="toc" class="article-toc"><h3 class="toc-title">文章目录</h3><ol class="toc">';
            $lastLevel = 2;
            
            foreach ($matches as $index => $match) {
                $level = intval($match[1]);
                $title = strip_tags($match[2]);
                $anchor = 'toc-' . $index;
                
                if ($level > $lastLevel) {
                    $toc .= str_repeat('<ol class="toc-child">', $level - $lastLevel);
                } elseif ($level < $lastLevel) {
                    $toc .= str_repeat('</li></ol>', $lastLevel - $level);
                } else {
                    $toc .= '</li>';
                }
                
                $toc .= '<li class="toc-item toc-level-' . $level . '">';
                $toc .= '<a class="toc-link" href="#' . $anchor . '">';
                $toc .= '<span class="toc-text">' . htmlspecialchars($title) . '</span>';
                $toc .= '</a>';
                
                $lastLevel = $level;
            }
            
            $toc .= str_repeat('</li></ol>', $lastLevel - 1);
            $toc .= '</nav>';
        }
        
        return $toc;
    }
    
    /**
     * 为内容中的标题添加锚点
     */
    public static function addHeadingAnchors($content) {
        $index = 0;
        $content = preg_replace_callback(
            '/<h([2-4])([^>]*)>(.+?)<\/h\1>/is',
            function($matches) use (&$index) {
                $anchor = 'toc-' . $index;
                $index++;
                return '<h' . $matches[1] . $matches[2] . ' id="' . $anchor . '">' . $matches[3] . '</h' . $matches[1] . '>';
            },
            $content
        );
        return $content;
    }
    
    /**
     * 为代码块添加高亮样式包��
     */
    public static function wrapCodeBlocks($content) {
        // 将 <pre><code> 包装成带有终端样式的 highlight 结构
        $content = preg_replace_callback(
            '/<pre([^>]*)><code([^>]*)>(.*?)<\/code><\/pre>/is',
            function($matches) {
                $preAttrs = $matches[1];
                $codeAttrs = $matches[2];
                $code = $matches[3];
                
                // 提取语言类型
                $lang = '';
                if (preg_match('/class=["\'].*?language-(\w+).*?["\']/i', $codeAttrs, $langMatch)) {
                    $lang = $langMatch[1];
                }
                
                return '<figure class="highlight' . ($lang ? ' ' . $lang : '') . '"><table><tbody><tr><td class="code"><pre' . $preAttrs . '><code' . $codeAttrs . '>' . $code . '</code></pre></td></tr></tbody></table></figure>';
            },
            $content
        );
        return $content;
    }
    
    /**
     * 生成带编号的文章目录
     */
    public static function getTocNumbered($content) {
        $pattern = '/<h([2-4])[^>]*>(.+?)<\/h\1>/is';
        $toc = '';
        
        if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
            $toc .= '<nav id="toc" class="article-toc"><h3 class="toc-title">文章目录</h3><ol class="toc toc-numbered">';
            
            $counters = array(0, 0, 0); // h2, h3, h4 计数器
            $lastLevel = 2;
            
            foreach ($matches as $index => $match) {
                $level = intval($match[1]);
                $title = strip_tags($match[2]);
                $anchor = 'toc-' . $index;
                
                // 更新计数器
                $levelIndex = $level - 2;
                $counters[$levelIndex]++;
                // 重置更深层级的计数器
                for ($i = $levelIndex + 1; $i < 3; $i++) {
                    $counters[$i] = 0;
                }
                
                // 生成编号
                $number = '';
                for ($i = 0; $i <= $levelIndex; $i++) {
                    if ($counters[$i] > 0) {
                        $number .= $counters[$i] . '.';
                    }
                }
                $number = rtrim($number, '.');
                
                if ($level > $lastLevel) {
                    $toc .= str_repeat('<ol class="toc-child">', $level - $lastLevel);
                } elseif ($level < $lastLevel) {
                    $toc .= str_repeat('</li></ol>', $lastLevel - $level);
                } else if ($index > 0) {
                    $toc .= '</li>';
                }
                
                $toc .= '<li class="toc-item toc-level-' . $level . '">';
                $toc .= '<a class="toc-link" href="#' . $anchor . '">';
                $toc .= '<span class="toc-number">' . $number . '</span> ';
                $toc .= '<span class="toc-text">' . htmlspecialchars($title) . '</span>';
                $toc .= '</a>';
                
                $lastLevel = $level;
            }
            
            $toc .= str_repeat('</li></ol>', $lastLevel - 1);
            $toc .= '</nav>';
        }
        
        return $toc;
    }
    
    /**
     * 解析个人链接配置
     */
    public static function parseProfileLinks($text) {
        $links = array();
        if (empty($text)) return $links;
        
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = explode('|', $line);
            if (count($parts) >= 2) {
                $links[] = array(
                    'name' => trim($parts[0]),
                    'url' => trim($parts[1])
                );
            }
        }
        return $links;
    }
    
    /**
     * 解析技能配置
     */
    public static function parseSkills($text) {
        $skills = array();
        if (empty($text)) return $skills;
        
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = explode('|', $line);
            if (count($parts) >= 2) {
                $skills[] = array(
                    'name' => trim($parts[0]),
                    'level' => trim($parts[1])
                );
            }
        }
        return $skills;
    }
    
    /**
     * 解析标签配置
     */
    public static function parseLabels($text) {
        $labels = array();
        if (empty($text)) return $labels;
        
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                $labels[] = $line;
            }
        }
        return $labels;
    }
    
    /**
     * 解析作品配置
     */
    public static function parseWorks($text) {
        $works = array();
        if (empty($text)) return $works;
        
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = explode('|', $line);
            if (count($parts) >= 3) {
                $works[] = array(
                    'name' => trim($parts[0]),
                    'url' => trim($parts[1]),
                    'year' => trim($parts[2])
                );
            }
        }
        return $works;
    }
    
    /**
     * 解析项目配置
     */
    public static function parseProjects($text) {
        $projects = array();
        if (empty($text)) return $projects;
        
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = explode('|', $line);
            if (count($parts) >= 2) {
                $projects[] = array(
                    'name' => trim($parts[0]),
                    'url' => trim($parts[1])
                );
            }
        }
        return $projects;
    }
    
    /**
     * 解析友情链接配置
     */
    public static function parseFriendLinks($text) {
        $links = array();
        if (empty($text)) return $links;
        
        $lines = explode("\n", $text);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;
            
            $parts = explode('|', $line);
            if (count($parts) >= 4) {
                $links[] = array(
                    'name' => trim($parts[0]),
                    'url' => trim($parts[1]),
                    'avatar' => trim($parts[2]),
                    'desc' => trim($parts[3])
                );
            } elseif (count($parts) >= 2) {
                $links[] = array(
                    'name' => trim($parts[0]),
                    'url' => trim($parts[1]),
                    'avatar' => '',
                    'desc' => isset($parts[2]) ? trim($parts[2]) : ''
                );
            }
        }
        return $links;
    }
}
