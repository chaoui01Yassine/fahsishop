<?php
/* Smarty version 4.3.4, created on 2026-05-23 10:54:50
  from '/home/fahsist/www/themes/classic/templates/_partials/form-errors.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6a116b5ad8f896_80236968',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55ee82b372ea0a43b1553dc86edd0b958c2c35f4' => 
    array (
      0 => '/home/fahsist/www/themes/classic/templates/_partials/form-errors.tpl',
      1 => 1738226099,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a116b5ad8f896_80236968 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/fahsist/www/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
if (smarty_modifier_count($_smarty_tpl->tpl_vars['errors']->value)) {?>
  <div class="help-block">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3788062366a116b5ad8ec82_64014141', 'form_errors');
?>

  </div>
<?php }
}
/* {block 'form_errors'} */
class Block_3788062366a116b5ad8ec82_64014141 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_errors' => 
  array (
    0 => 'Block_3788062366a116b5ad8ec82_64014141',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
          <li class="alert alert-danger"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'nl2br' ][ 0 ], array( $_smarty_tpl->tpl_vars['error']->value ));?>
</li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    <?php
}
}
/* {/block 'form_errors'} */
}
