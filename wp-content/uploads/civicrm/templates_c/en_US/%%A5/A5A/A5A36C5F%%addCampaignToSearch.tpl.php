<?php /* Smarty version 2.6.32, created on 2023-06-07 08:09:20
         compiled from CRM/Campaign/Form/addCampaignToSearch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Campaign/Form/addCampaignToSearch.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['campaignElementName']): ?>
    <tr class="<?php echo $this->_tpl_vars['campaignTrClass']; ?>
">
    <td class="<?php echo $this->_tpl_vars['campaignTdClass']; ?>
">
      <?php echo $this->_tpl_vars['form'][$this->_tpl_vars['campaignElementName']]['label']; ?>
 <?php echo $this->_tpl_vars['form'][$this->_tpl_vars['campaignElementName']]['html']; ?>

    </td>
  </tr>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>