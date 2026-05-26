<?php
/* Smarty version 4.3.4, created on 2026-05-23 10:54:51
  from '/home/fahsist/www/themes/classic/templates/catalog/_partials/category-footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6a116b5bec4227_36767757',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd056db77e53aed3f8788b2cc131aec0baaad961' => 
    array (
      0 => '/home/fahsist/www/themes/classic/templates/catalog/_partials/category-footer.tpl',
      1 => 1738226099,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a116b5bec4227_36767757 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="js-product-list-footer">
    <?php if ((isset($_smarty_tpl->tpl_vars['category']->value)) && $_smarty_tpl->tpl_vars['category']->value['additional_description'] && $_smarty_tpl->tpl_vars['listing']->value['pagination']['items_shown_from'] == 1) {?>
        <div class="card">
            <div class="card-block category-additional-description">
                <?php echo $_smarty_tpl->tpl_vars['category']->value['additional_description'];?>

            </div>
        </div>
    <?php }?>
</div>
<?php }
}
