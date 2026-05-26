<?php
/* Smarty version 4.3.4, created on 2026-05-23 10:54:51
  from '/home/fahsist/www/themes/classic/templates/cms/_partials/sitemap-nested-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6a116b5b545012_61762884',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '390c4b2f4efd374bc56fe1f7521d981e88d83c8e' => 
    array (
      0 => '/home/fahsist/www/themes/classic/templates/cms/_partials/sitemap-nested-list.tpl',
      1 => 1738226099,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:cms/_partials/sitemap-nested-list.tpl' => 2,
  ),
),false)) {
function content_6a116b5b545012_61762884 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1410094186a116b5b5420c8_79954804', 'sitemap_item');
?>

<?php }
/* {block 'sitemap_item'} */
class Block_1410094186a116b5b5420c8_79954804 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'sitemap_item' => 
  array (
    0 => 'Block_1410094186a116b5b5420c8_79954804',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <ul<?php if (!empty($_smarty_tpl->tpl_vars['is_nested']->value)) {?> class="nested"<?php }?>>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['links']->value, 'link');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
      <li>
        <a id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['id'], ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['url'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['label'], ENT_QUOTES, 'UTF-8');?>
">
          <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['label'], ENT_QUOTES, 'UTF-8');?>

        </a>
        <?php if (!empty($_smarty_tpl->tpl_vars['link']->value['children'])) {?>
          <?php $_smarty_tpl->_subTemplateRender('file:cms/_partials/sitemap-nested-list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('links'=>$_smarty_tpl->tpl_vars['link']->value['children'],'is_nested'=>true), 0, true);
?>
        <?php }?>
      </li>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </ul>
<?php
}
}
/* {/block 'sitemap_item'} */
}
