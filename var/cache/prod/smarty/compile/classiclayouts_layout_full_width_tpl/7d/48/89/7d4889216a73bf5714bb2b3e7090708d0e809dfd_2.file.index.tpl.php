<?php
/* Smarty version 4.3.4, created on 2026-05-23 10:51:20
  from '/home/fahsist/www/themes/classic/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6a116a88982ac4_24321833',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4889216a73bf5714bb2b3e7090708d0e809dfd' => 
    array (
      0 => '/home/fahsist/www/themes/classic/templates/index.tpl',
      1 => 1738226099,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a116a88982ac4_24321833 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17699202626a116a88981934_15966021', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_7218361946a116a88981ca3_43790687 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'hook_home'} */
class Block_5329748016a116a889822d7_50593592 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

          <?php
}
}
/* {/block 'hook_home'} */
/* {block 'page_content'} */
class Block_16009900826a116a889820f5_30405081 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5329748016a116a889822d7_50593592', 'hook_home', $this->tplIndex);
?>

        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_17699202626a116a88981934_15966021 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_17699202626a116a88981934_15966021',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_7218361946a116a88981ca3_43790687',
  ),
  'page_content' => 
  array (
    0 => 'Block_16009900826a116a889820f5_30405081',
  ),
  'hook_home' => 
  array (
    0 => 'Block_5329748016a116a889822d7_50593592',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7218361946a116a88981ca3_43790687', 'page_content_top', $this->tplIndex);
?>


        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_16009900826a116a889820f5_30405081', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
}
