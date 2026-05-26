<?php
/* Smarty version 4.3.4, created on 2026-05-23 10:54:53
  from '/home/fahsist/www/themes/classic/templates/customer/guest-login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6a116b5dec1c05_06732233',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '154f916e877473288885fa495245b8e751be686e' => 
    array (
      0 => '/home/fahsist/www/themes/classic/templates/customer/guest-login.tpl',
      1 => 1738226099,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a116b5dec1c05_06732233 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8526192286a116b5debca28_42543597', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8156788156a116b5debd9d8_03375332', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_title'} */
class Block_8526192286a116b5debca28_42543597 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_8526192286a116b5debca28_42543597',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Guest Order Tracking','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'page_title'} */
/* {block 'page_content'} */
class Block_8156788156a116b5debd9d8_03375332 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_8156788156a116b5debd9d8_03375332',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <form id="guestOrderTrackingForm" action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['guest_tracking'], ENT_QUOTES, 'UTF-8');?>
" method="get">
    <header>
      <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To track your order, please enter the following information:','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</p>
    </header>

    <section class="form-fields">
    
      <input type="hidden" name="controller" value="guest-tracking" >

      <div class="form-group row">
        <label class="col-md-3 form-control-label required">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order Reference:','d'=>'Shop.Forms.Labels'),$_smarty_tpl ) );?>

        </label>
        <div class="col-md-6">
          <input
            class="form-control"
            name="order_reference"
            type="text"
            size="8"
            value="<?php if ((isset($_REQUEST['order_reference']))) {
echo htmlspecialchars((string) $_REQUEST['order_reference'], ENT_QUOTES, 'UTF-8');
}?>"
          >
          <div class="form-control-comment">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'For example: QIIXJXNUI or QIIXJXNUI#1','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>

          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 form-control-label required">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email:','d'=>'Shop.Forms.Labels'),$_smarty_tpl ) );?>

        </label>
        <div class="col-md-6">
          <input
            class="form-control"
            name="email"
            type="email"
            value="<?php if ((isset($_REQUEST['email']))) {
echo htmlspecialchars((string) $_REQUEST['email'], ENT_QUOTES, 'UTF-8');
}?>"
          >
        </div>
      </div>

    </section>

    <footer class="form-footer text-sm-center clearfix">
      <button class="btn btn-primary" type="submit">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

      </button>
    </footer>
  </form>
<?php
}
}
/* {/block 'page_content'} */
}
