<?php if (isset($form) && !empty($form)): ?>
    <div class='form-wrapper'>
        <form id="drinks-form" <?php print html_attr($form['attr'] ?? ['method' => 'POST']); ?>>

            <!--Start Field Generation-->
            <?php foreach ($form['fields'] as $field_id => $field): ?>
                <div class="field-wrapper">

                    <?php if (isset($field['label'])): ?>
                        <!--If the label is set - print fields inside label-->
                        <label>
                            <span class="label">
                                <?php print $field['label']; ?>
                            </span>
                        <?php endif; ?>

                        <!--fields to be printed-->
                        <?php if (in_array($field['type'], ['hidden', 'text', 'password', 'email', 'number'])): ?>
                            <?php require 'elements/input.tpl.php'; ?>
                        <?php elseif ($field['type'] === 'select'): ?>
                            <?php require 'elements/select.tpl.php'; ?>
                        <?php endif; ?> 
                        
                        <?php if (isset($field['label'])): ?>
                        </label>
                    <?php endif; ?>

                    <?php if (isset($field['error'])): ?>
                        <div>
                            <span>
                                <?php print $field['error']; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <!--Field Generator End-->

            <?php if (isset($form['buttons']) && !empty($form['buttons'])): ?>
                <div class="button-wrapper">

                    <!--Generate all the buttons-->
                    <?php foreach ($form['buttons'] as $button_id => $button): ?>
                        <?php require 'elements/button.tpl.php'; ?>
                    <?php endforeach; ?>
                    <!--Button Generator End-->
                    
                </div>
            <?php endif; ?>
        </form>
    </div>
<?php endif; ?>