<?php /* Smarty version 2.6.32, created on 2023-06-07 08:09:01
         compiled from CRM/Contribute/Form/ContributionCharts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/ContributionCharts.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/ContributionCharts.tpl', 20, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['hasContributions']): ?>
<div id="chartData">
<table >
  <tr class="crm-contribution-form-block-chart">
     <td width="50%">
         <?php if ($this->_tpl_vars['hasByMonthChart']): ?>
                          <div id="chart_by_month"></div>
         <?php else: ?>
       <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There were no contributions during the selected year.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
         <?php endif; ?>
     </td>
     <td width="50%">
                   <div id="chart_by_year"></div>
     </td>
  </tr>
</table>
<div class="form-layout-compressed" >
<table >
      <td class="label"><?php echo $this->_tpl_vars['form']['select_year']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['select_year']['html']; ?>
</td>
      <td class="label"><?php echo $this->_tpl_vars['form']['chart_type']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['chart_type']['html']; ?>
</td>
</table>
</div>
<?php else: ?>
 <div class="messages status no-popup">
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no live contribution records to display.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
 </div>
<?php endif; ?>

<?php if ($this->_tpl_vars['hasChart']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/chart.tpl", 'smarty_include_vars' => array('contriChart' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">

  CRM.$(function($) {
    var allData = '; ?>
<?php echo $this->_tpl_vars['chartData']; ?>
<?php echo ';

    $.each( allData, function( chartID, chartValues ) {
        var divName = "chart_" + chartID;
        createChart( chartID, divName, 300, 300, allData[chartID].object );
        });

    function byMonthOnClick( barIndex ) {
       var url = allData.by_month.on_click_urls[\'url_\' + barIndex];
       if ( url ) window.location.href = url;
    }

    function byYearOnClick( barIndex ) {
       var url = allData.by_year.on_click_urls[\'url_\' + barIndex];
       if ( url ) window.location.href = url;
    }

  });
</script>
'; ?>

<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>