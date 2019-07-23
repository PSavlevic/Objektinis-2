<?php if (isset($nav) && !empty($nav)): ?>
    <div class="nav-wrapper">
        <?php foreach ($nav as $section_id => $section): ?>
            <div class="<?php print $section_id; ?>">
                <?php foreach ($nav['left'] as $nav_id => $link): ?>
                    <div class="link-wrapper <?php print ($link['active'] ?? false) ? 'active' : ''; ?>">
                        <a href="<?php print $link['url']; ?>">
                            <?php print $link['title']; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif ?>
