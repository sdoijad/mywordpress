<?php /* Smarty version 2.6.32, created on 2023-06-07 08:09:58
         compiled from CRM/Group/Form/Search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Group/Form/Search.tpl', 1, false),array('block', 'ts', 'CRM/Group/Form/Search.tpl', 13, false),array('function', 'crmURL', 'CRM/Group/Form/Search.tpl', 80, false),array('function', 'help', 'CRM/Group/Form/Search.tpl', 80, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="crm-block crm-form-block crm-group-search-form-block">
  <div class="crm-accordion-wrapper crm-search_builder-accordion">
    <div class="crm-accordion-header crm-master-accordion-header">
      <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Find Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    <div class="crm-accordion-body">
      <div id="searchForm">
        <table class="form-layout">
          <tr>
            <td>
              <?php echo $this->_tpl_vars['form']['title']['label']; ?>
<br />
              <?php echo $this->_tpl_vars['form']['title']['html']; ?>
<br />
              <span class="description font-italic">
                <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Complete OR partial group name.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              </span>
            </td>
            <?php if (! empty ( $this->_tpl_vars['form']['created_by'] )): ?>
              <td>
                <?php echo $this->_tpl_vars['form']['created_by']['label']; ?>
<br />
                <?php echo $this->_tpl_vars['form']['created_by']['html']; ?>
<br />
                <span class="description font-italic">
                  <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Complete OR partial creator name.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </span>
              </td>
            <?php endif; ?>
            <td>
              <?php echo $this->_tpl_vars['form']['visibility']['label']; ?>
<br />
              <?php echo $this->_tpl_vars['form']['visibility']['html']; ?>
<br />
              <span class="description font-italic">
               <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter search by visibility.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              </span>
            </td>
          </tr>
          <tr>
            <?php if (! empty ( $this->_tpl_vars['form']['group_type_search'] )): ?>
              <td id="group_type-block">
                <?php echo $this->_tpl_vars['form']['group_type_search']['label']; ?>
<br />
                <?php echo $this->_tpl_vars['form']['group_type_search']['html']; ?>
<br />
                <span class="description font-italic">
                  <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter search by group type(s).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                </span>
              </td>
            <?php endif; ?>
            <?php if (! empty ( $this->_tpl_vars['form']['group_status'] )): ?>
              <td>
                <?php echo $this->_tpl_vars['form']['group_status']['label']; ?>
<br />
                <?php echo $this->_tpl_vars['form']['group_status']['html']; ?>

              </td>
            <?php endif; ?>
            <?php if (! empty ( $this->_tpl_vars['form']['component_mode'] )): ?>
              <td>
                <?php echo $this->_tpl_vars['form']['component_mode']['label']; ?>
<br />
                <?php echo $this->_tpl_vars['form']['component_mode']['html']; ?>

              </td>
            <?php endif; ?>
          </tr>
          <?php if (! empty ( $this->_tpl_vars['form']['saved_search'] )): ?>
            <tr>
              <td>
                <?php echo $this->_tpl_vars['form']['saved_search']['label']; ?>
 <br/><?php echo $this->_tpl_vars['form']['saved_search']['html']; ?>

              </td>
              <td colspan="2">
              </td>
            </tr>
          <?php endif; ?>
        </table>
      </div>
    </div>
  </div>
<div class="css_right">
  <a class="crm-hover-button action-item" href="<?php echo CRM_Utils_System::crmURL(array('q' => "reset=1&update_smart_groups=1"), $this);?>
"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Smart Group Counts<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> <?php echo smarty_function_help(array('id' => 'update_smart_groups'), $this);?>

</div>
<?php if (call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'edit groups' )): ?>
  <?php $this->assign('editableClass', 'crm-editable'); ?>
<?php endif; ?>
<table class="crm-group-selector crm-ajax-table" data-order='[[0,"asc"]]'>
  <thead>
    <tr>
      <th data-data="title" cell-class="crm-group-name <?php echo $this->_tpl_vars['editableClass']; ?>
 crmf-title" class='crm-group-name'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th data-data="count" cell-class="crm-group-count right" class='crm-group-count'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Count<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th data-data="created_by" cell-class="crm-group-created_by" class='crm-group-created_by'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Created By<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th data-data="description" data-orderable="false" cell-class="crm-group-description crmf-description <?php echo $this->_tpl_vars['editableClass']; ?>
" class='crm-group-description'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th data-data="group_type" cell-class="crm-group-group_type" class='crm-group-group_type'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th data-data="visibility" cell-class="crm-group-visibility crmf-visibility <?php echo $this->_tpl_vars['editableClass']; ?>
" cell-data-type="select" class='crm-group-visibility'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Visibility<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <?php if ($this->_tpl_vars['showOrgInfo']): ?>
        <th data-data="org_info" data-orderable="false" cell-class="crm-group-org_info" class='crm-group-org_info'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Organization<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <?php endif; ?>
      <th data-data="links" data-orderable="false" cell-class="crm-group-group_links" class='crm-group-group_links'>&nbsp;</th>
    </tr>
  </thead>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/enableDisableApi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">
  (function($) {
    // for CRM-11310 and CRM-10635 : processing just parent groups on initial display
    // passing \'1\' for parentsOnlyArg to show parent child hierarchy structure display
    // on initial load of manage group page and
    // also to handle search filtering for initial load of same page.
    var parentsOnly = 1
    var ZeroRecordText = '; ?>
'<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="status messages">None found.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>'<?php echo ';
    var smartGroupText = '; ?>
'<span>(<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Smart Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>)</span>'<?php echo ';
    $(\'table.crm-group-selector\').data({
      "ajax": {
        "url": '; ?>
'<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/ajax/grouplist",'h' => 0,'q' => "snippet=4"), $this);?>
'<?php echo ',
        "data": function (d) {

          var groupTypes = \'\';
          $(\'input[id*="group_type_search_"]:checked\').each(function(e) {
            groupTypes += $(this).attr(\'id\').replace(/group_type_search_/, groupTypes == \'\' ? \'\' : \',\');
          });

          var groupStatus = ($(\'.crm-group-search-form-block #group_status_1\').prop(\'checked\')) ? 1 : \'\';
          if (groupStatus) {
            groupStatus = ($(\'.crm-group-search-form-block #group_status_2\').prop(\'checked\')) ? 3 : groupStatus;
          } else {
            groupStatus = ($(\'.crm-group-search-form-block #group_status_2\').prop(\'checked\')) ? 2 : \'\';
          }

          d.title = $(".crm-group-search-form-block input#title").val(),
          d.created_by = $(".crm-group-search-form-block input#created_by").val(),
          d.group_type = groupTypes,
          d.visibility = $(".crm-group-search-form-block select#visibility").val(),
          d.status = groupStatus,
          d.savedSearch = $(\'.crm-group-search-form-block select#saved_search\').val(),
          d.component_mode = $(".crm-group-search-form-block select#component_mode").val(),
          d.showOrgInfo = '; ?>
<?php if ($this->_tpl_vars['showOrgInfo']): ?>"<?php echo $this->_tpl_vars['showOrgInfo']; ?>
"<?php else: ?>"0"<?php endif; ?><?php echo ',
          d.parentsOnly = parentsOnly
        }
      },
      "language": {
        "zeroRecords": ZeroRecordText
      },
      "drawCallback": function(settings) {
        //Add data attributes to cells
        $(\'thead th\', settings.nTable).each( function( index ) {
          $.each(this.attributes, function() {
            if(this.name.match("^cell-")) {
              var cellAttr = this.name.substring(5);
              var cellValue = this.value;
              $(\'tbody tr\', settings.nTable).each( function() {
                $(\'td:eq(\'+ index +\')\', this).attr( cellAttr, cellValue );
              });
            }
          });
        });
        //Reload table after draw
        $(settings.nTable).trigger(\'crmLoad\');
        CRM.loadScript(CRM.config.resourceBase + \'js/jquery/jquery.crmEditable.js\').done(function () {
          if (parentsOnly) {
            $(\'tbody tr.crm-group-parent\', settings.nTable).each(function () {
              $(this).find(\'td:first\')
                .prepend(\''; ?>
<span class="collapsed show-children" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>show child groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/></span><?php echo '\')
                .find(\'div\').css({\'display\': \'inline\'});
            });
          }
          $(\'tbody tr.crm-smart-group > td.crm-group-name\', settings.nTable).append(smartGroupText);
        });
      }
    });
    $(function($) {
      $(\'.crm-group-search-form-block :input\').change(function(){
        parentsOnly = 0;
        ZeroRecordText = \'<div class="status messages">'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No matching Groups found for your search criteria. Suggestions:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '<div class="spacer"></div><ul><li>'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Check your spelling.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</li><li>'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Try a different spelling or use fewer letters.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</li><li>'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Make sure you have enough privileges in the access control system.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</li></ul></div>\';
        $(\'table.crm-group-selector\').DataTable().draw();
      });
    });
    $(\'#crm-container\')
      .on(\'click\', \'a.button, a.action-item[href*="action=update"], a.action-item[href*="action=delete"]\', CRM.popup)
      .on(\'crmPopupFormSuccess\', \'a.button, a.action-item[href*="action=update"], a.action-item[href*="action=delete"]\', function() {
          // Refresh datatable when form completes
          $(\'table.crm-group-selector\').DataTable().draw();
      });
    // show hide children
    var context = $(\'#crm-main-content-wrapper\');
    $(\'table.crm-group-selector\', context).on( \'click\', \'span.show-children\', function(){
      var showOrgInfo = '; ?>
<?php if ($this->_tpl_vars['showOrgInfo']): ?>true<?php else: ?>false<?php endif; ?><?php echo ';
      var rowID = $(this).parents(\'tr\').prop(\'id\');
      var parentRow = rowID.split(\'_\');
      var parent_id = parentRow[1];
      var group_id = \'\';
      if ( parentRow[2]) {
        group_id = parentRow[2];
      }
      var levelClass = \'level_2\';
      // check enclosing td if already at level 2
      if ( $(this).parent().hasClass(\'level_2\') ) {
        levelClass = \'level_3\';
      }
      if ( $(this).hasClass(\'collapsed\') ) {
        $(this).removeClass("collapsed").addClass("expanded").attr("title",'; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>hide child groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ');
        showChildren( parent_id, showOrgInfo, group_id, levelClass );
      }
      else {
        $(this).removeClass("expanded").addClass("collapsed").attr("title",'; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>show child groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ');
        $(\'.parent_is_\' + parent_id).find(\'.show-children\').removeClass("expanded").addClass("collapsed").attr("title",'; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>show child groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ');
        $(\'.parent_is_\' + parent_id).hide();
        $(\'.parent_is_\' + parent_id).each(function(i, obj) {
          // also hide children of children
          var gID = $(this).data(\'id\');
          $(\'.parent_is_\' + gID).hide();
        });
      }
    });
    function showChildren( parent_id, showOrgInfo, group_id, levelClass) {
      var rowID = \'#row_\' + parent_id;
      if ( group_id ) {
        rowID = \'#row_\' + parent_id + \'_\' + group_id;
      }
      if ( $(rowID).next().hasClass(\'parent_is_\' + parent_id ) ) {
        // child rows for this parent have already been retrieved so just show them
        $(\'.parent_is_\' + parent_id ).show();
      } else {
        //FIXME Is it possible to replace all this with a datatables call?
        $.ajax( {
            "dataType": \'json\',
            "url": '; ?>
'<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/ajax/grouplist",'h' => 0,'q' => "snippet=4"), $this);?>
'<?php echo ',
            "data": {\'parent_id\': parent_id, \'showOrgInfo\': showOrgInfo},
            "success": function(response){
              var appendHTML = \'\';
              $.each( response.data, function( i, val ) {
                val.row_classes = [
                  \'crm-entity\',
                  \'parent_is_\' + parent_id,
                  \'crm-row-child\'
                ];
                if (\'DT_RowClass\' in val) {
                  val.row_classes = val.row_classes.concat(val.DT_RowClass.split(\' \').filter((item) => val.row_classes.indexOf(item) < 0));
                  if (val.DT_RowClass.indexOf(\'crm-smart-group\') == -1) {
                    smartGroupText = \'\';
                  }
                }
                appendHTML += \'<tr id="row_\'+val.group_id+\'_\'+parent_id+\'" data-entity="group" data-id="\'+val.group_id+\'" class="\' + val.row_classes.join(\' \') + \'">\';
                if ( val.is_parent ) {
                  appendHTML += \'<td class="crm-group-name crmf-title \' + levelClass + \'">\' + \''; ?>
<span class="collapsed show-children" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>show child groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"/></span><div class="crmf-title <?php echo $this->_tpl_vars['editableClass']; ?>
" style="display:inline"><?php echo '\' + val.title + \'</div>\' + smartGroupText + \'</td>\';
                }
                else {
                  appendHTML += \'<td class="crm-group-name\' + levelClass + \'"><div class="crmf-title '; ?>
<?php echo $this->_tpl_vars['editableClass']; ?>
<?php echo '"><span class="crm-no-children"></span>\' + val.title + \'</div>\' + smartGroupText + \'</td>\';
                }
                appendHTML += \'<td class="right">\' + val.count + "</td>";
                appendHTML += "<td>" + val.created_by + "</td>";
                appendHTML += \'<td class="'; ?>
<?php echo $this->_tpl_vars['editableClass']; ?>
<?php echo ' crmf-description">\' + (val.description || \'\') + "</td>";
                appendHTML += "<td>" + val.group_type + "</td>";
                appendHTML += \'<td class="'; ?>
<?php echo $this->_tpl_vars['editableClass']; ?>
<?php echo ' crmf-visibility" data-type="select">\' + val.visibility + "</td>";
                if (showOrgInfo) {
                  appendHTML += "<td>" + val.org_info + "</td>";
                }
                appendHTML += "<td>" + val.links + "</td>";
                appendHTML += "</tr>";
              });
              $( rowID ).after( appendHTML );
              $( \'.parent_is_\'+parent_id ).trigger(\'crmLoad\');
            }
        });
      }
    }
  })(CRM.$);
</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>