<?php
/* Smarty version 4.3.4, created on 2026-05-23 10:54:50
  from '/home/fahsist/www/themes/classic/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6a116b5ab854d3_25068288',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f047a1caad545fe36087aecd7503e25fb1d13b3' => 
    array (
      0 => '/home/fahsist/www/themes/classic/templates/page.tpl',
      1 => 1738226099,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a116b5ab854d3_25068288 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15913918206a116b5ab82e50_41098438', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_18621483276a116b5ab83335_84528086 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_1456979416a116b5ab83075_59948200 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18621483276a116b5ab83335_84528086', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_2895720006a116b5ab847c6_32236680 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_17083756686a116b5ab84a72_68117824 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_10618222186a116b5ab845b3_83013090 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <div id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2895720006a116b5ab847c6_32236680', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17083756686a116b5ab84a72_68117824', 'page_content', $this->tplIndex);
?>

      </div>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_18790041126a116b5ab84fe8_02921170 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_19014817136a116b5ab84e43_62741089 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18790041126a116b5ab84fe8_02921170', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_15913918206a116b5ab82e50_41098438 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_15913918206a116b5ab82e50_41098438',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_1456979416a116b5ab83075_59948200',
  ),
  'page_title' => 
  array (
    0 => 'Block_18621483276a116b5ab83335_84528086',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_10618222186a116b5ab845b3_83013090',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_2895720006a116b5ab847c6_32236680',
  ),
  'page_content' => 
  array (
    0 => 'Block_17083756686a116b5ab84a72_68117824',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_19014817136a116b5ab84e43_62741089',
  ),
  'page_footer' => 
  array (
    0 => 'Block_18790041126a116b5ab84fe8_02921170',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1456979416a116b5ab83075_59948200', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10618222186a116b5ab845b3_83013090', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19014817136a116b5ab84e43_62741089', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
