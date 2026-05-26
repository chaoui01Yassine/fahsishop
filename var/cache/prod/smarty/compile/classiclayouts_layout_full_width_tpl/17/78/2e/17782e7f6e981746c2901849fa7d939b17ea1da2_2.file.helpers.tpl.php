<?php
/* Smarty version 4.3.4, created on 2026-05-23 10:51:20
  from '/home/fahsist/www/themes/classic/templates/_partials/helpers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6a116a889d23f9_41056278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17782e7f6e981746c2901849fa7d939b17ea1da2' => 
    array (
      0 => '/home/fahsist/www/themes/classic/templates/_partials/helpers.tpl',
      1 => 1738226099,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6a116a889d23f9_41056278 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'renderLogo' => 
  array (
    'compiled_filepath' => '/home/fahsist/www/var/cache/prod/smarty/compile/classiclayouts_layout_full_width_tpl/17/78/2e/17782e7f6e981746c2901849fa7d939b17ea1da2_2.file.helpers.tpl.php',
    'uid' => '17782e7f6e981746c2901849fa7d939b17ea1da2',
    'call_name' => 'smarty_template_function_renderLogo_10565629906a116a889cc4b4_34287707',
  ),
));
?> 

<?php }
/* smarty_template_function_renderLogo_10565629906a116a889cc4b4_34287707 */
if (!function_exists('smarty_template_function_renderLogo_10565629906a116a889cc4b4_34287707')) {
function smarty_template_function_renderLogo_10565629906a116a889cc4b4_34287707(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

  <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['index'], ENT_QUOTES, 'UTF-8');?>
">
    <img
      class="logo img-fluid"
      src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['src'], ENT_QUOTES, 'UTF-8');?>
"
      alt="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
"
      width="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['width'], ENT_QUOTES, 'UTF-8');?>
"
      height="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['height'], ENT_QUOTES, 'UTF-8');?>
">
  </a>
<?php
}}
/*/ smarty_template_function_renderLogo_10565629906a116a889cc4b4_34287707 */
}
