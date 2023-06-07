<?php /* Smarty version 2.6.32, created on 2023-06-07 08:09:55
         compiled from CRM/Tag/Page/Tag.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Tag/Page/Tag.tpl', 1, false),array('block', 'ts', 'CRM/Tag/Page/Tag.tpl', 12, false),array('modifier', 'implode', 'CRM/Tag/Page/Tag.tpl', 12, false),array('modifier', 'json_encode', 'CRM/Tag/Page/Tag.tpl', 58, false),array('function', 'docURL', 'CRM/Tag/Page/Tag.tpl', 17, false),array('function', 'crmAPI', 'CRM/Tag/Page/Tag.tpl', 51, false),array('function', 'crmURL', 'CRM/Tag/Page/Tag.tpl', 465, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="crm-content-block">
  <div class="help">
    <?php $this->_tag_stack[] = array('ts', array('1' => ((is_array($_tmp=', ')) ? $this->_run_mod_handler('implode', true, $_tmp, $this->_tpl_vars['usedFor']) : implode($_tmp, $this->_tpl_vars['usedFor'])))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags are a convenient way to categorize data (%1).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php if (call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'administer Tagsets' )): ?>
      <br />
      <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create predefined tags in the main tree, or click the <strong>+</strong> to add a set for free tagging.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
    <?php echo smarty_function_docURL(array('page' => "user/organising-your-data/groups-and-tags"), $this);?>

  </div>

  <div id="mainTabContainer">
    <ul>
      <li class="ui-corner-all crm-tab-button" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Main Tag List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
        <a href="#tree"><i class="crm-i fa-tags" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tag Tree<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
      </li>
      <?php $_from = $this->_tpl_vars['tagsets']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['set']):
?>
        <li class="ui-corner-all crm-tab-button <?php if (( $this->_tpl_vars['set']['is_reserved'] )): ?>is-reserved<?php endif; ?>" title="<?php $this->_tag_stack[] = array('ts', array('1' => ((is_array($_tmp=', ')) ? $this->_run_mod_handler('implode', true, $_tmp, $this->_tpl_vars['set']['used_for_label']) : implode($_tmp, $this->_tpl_vars['set']['used_for_label'])))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tag Set for %1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          <a href="#tagset-<?php echo $this->_tpl_vars['set']['id']; ?>
"><?php echo $this->_tpl_vars['set']['name']; ?>
</a>
        </li>
      <?php endforeach; endif; unset($_from); ?>
      <?php if (call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'administer Tagsets' )): ?>
        <li class="ui-corner-all crm-tab-button" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Tag Set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          <a href="#new-tagset"><i class="crm-i fa-plus" aria-hidden="true"></i></a>
        </li>
      <?php endif; ?>
    </ul>
    <div id="tree">
      <div class="help">
        <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Organize the tag hierarchy by clicking and dragging. Shift-click to select multiple tags to merge/move/delete.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
      <input class="crm-form-text big" name="filter_tag_tree" placeholder="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" allowclear="1"/>
      <a class="crm-hover-button crm-clear-link" style="visibility:hidden;" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><i class="crm-i fa-times" aria-hidden="true"></i></a>
    </div>
    <?php $_from = $this->_tpl_vars['tagsets']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['set']):
?>
      <div id="tagset-<?php echo $this->_tpl_vars['set']['id']; ?>
">
      </div>
    <?php endforeach; endif; unset($_from); ?>
    <div id="new-tagset">
    </div>
  </div>
</div>
<?php echo smarty_function_crmAPI(array('entity' => 'Contact','action' => 'getsingle','var' => 'user','return' => 'display_name','id' => 'user_contact_id'), $this);?>

<?php echo '
<script type="text/javascript">
  (function($, _) {
    $(function($) {
      var $window = $(window),
        renderedTabs = [\'tree\'],
        tagSets = '; ?>
<?php echo json_encode($this->_tpl_vars['tagsets']); ?>
<?php echo ',
        user = '; ?>
<?php echo json_encode($this->_tpl_vars['user']); ?>
<?php echo ',
        usedFor = '; ?>
<?php echo json_encode($this->_tpl_vars['usedFor']); ?>
<?php echo ',
        menuHeight = $(\'#civicrm-menu\').height() + 15,
        noneSelectedTpl = _.template($(\'#noneSelectedTpl\').html()),
        oneSelectedTpl = _.template($(\'#oneSelectedTpl\').html()),
        moreSelectedTpl = _.template($(\'#moreSelectedTpl\').html()),
        tagsetHeaderTpl = _.template($(\'#tagsetHeaderTpl\').html());

      function formatTagSet(info) {
        info.date = CRM.utils.formatDate(info.created_date);
        info.used_for_label = [];
        if (undefined !== info.used_for) {
          _.each(info.used_for.split(\',\'), function(item) {
            info.used_for_label.push(usedFor[item]);
          });
        }
      }

      _.each(tagSets, formatTagSet);

      function renderTree($panel) {
        var plugins,
          selected = [],
          tagset = $panel.attr(\'id\').split(\'-\')[1] || 0;

        function hasChildren(id) {
          var $node = $(\'.tag-tree\', $panel).jstree(true).get_node(id, true);
          return !$node.hasClass(\'jstree-leaf\');
        }

        function changeColor() {
          var color = $(this).val().toLowerCase(),
            id = $(this).closest(\'.crm-entity\').data(\'id\'),
            node = $(\'.tag-tree\', $panel).jstree(true).get_node(id);
          if (color === \'#ffffff\') {
            node.a_attr.style = \'\';
          } else {
            node.a_attr.style = \'background-color: \' + color + \'; color: \' + CRM.utils.colorContrast(color) + \';\';
          }
          node.data.color = color;
          $(\'.tag-tree\', $panel).jstree(true).redraw(true);
          CRM.api3(\'Tag\', \'create\', {id: id, color: color}, true);
        }

        function changeSelection(e, data) {
          var tplParams = {
            tagset: tagset,
            tagsetCount: _.keys(tagSets).length,
            adminReserved: CRM.checkPerm(\'administer reserved tags\')
          },
            tree = $(\'.tag-tree\', $panel).jstree(true),
            $infoBox = $(\'.tag-info\', $panel);
          selected = data.selected;
          if (!data.selected || !data.selected.length) {
            tplParams.is_reserved = tagset ? tagSets[tagset].is_reserved == 1 : false;
            tplParams.length = $(\'.tag-tree li\', $panel).length;
            tplParams.adminTagsets = CRM.checkPerm(\'administer Tagsets\');
            $infoBox.html(noneSelectedTpl(tplParams));
          } else if (data.selected.length === 1) {
            tplParams.usedFor = usedFor;
            tplParams.hasChildren = hasChildren(data.node.id);
            $infoBox.html(oneSelectedTpl($.extend({}, data.node, tplParams)));
          } else {
            tplParams.items = data.selected;
            tplParams.hasChildren = tplParams.reserved = tplParams.usages = 0;
            _.each(data.selected, function(id) {
              var node = tree.get_node(id);
              tplParams.usages += node.data.usages;
              tplParams.reserved += node.data.is_reserved;
              tplParams.hasChildren += hasChildren(id) ? 1 : 0;
            });
            $infoBox.html(moreSelectedTpl(tplParams));
          }
          $infoBox.trigger(\'crmLoad\');
        }

        function clearSelection(e) {
          e.preventDefault();
          $(\'.tag-tree\', $panel).jstree(true).deselect_all();
        }

        function changeUsedFor() {
          var vals = $(\'input[name=used_for]:checked\', $panel).map(function(i, el) {
            return $(el).val();
          }).get(),
            id = $(this).closest(\'.crm-entity\').data(\'id\');
          if (vals.length) {
            CRM.api3(\'Tag\', \'create\', {id: id, used_for: vals}, true);
            var node = $(\'.tag-tree\', $panel).jstree(true).get_node(id);
            node.data.used_for = vals;
          }
        }

        function moveTag(e, data) {
          if (data.parent != data.old_parent) {
            CRM.api3(\'Tag\', \'create\', {id: data.node.id, parent_id: data.parent.replace(\'#\', \'\')}, true);
          }
        }

        function deleteTagset() {
          $(\'#mainTabContainer\').tabs(\'option\', \'active\', 0);
          $panel.off().remove();
          $("a[href=\'#tagset-" + tagset + "\']").parent().remove();
          $(\'#mainTabContainer\').tabs(\'refresh\');
        }

        function updateTagset(info) {
          tagSets[tagset].description = info.description;
          tagSets[tagset].name = info.name;
          tagSets[tagset].used_for = info.used_for;
          tagSets[tagset].is_reserved = info.is_reserved;
          formatTagSet(tagSets[tagset]);
          addTagsetHeader();
          $(".tag-tree", $panel).jstree("search", \'\');
        }

        function addTagsetHeader() {
          $(\'.tagset-header\', $panel).remove();
          $panel.prepend(tagsetHeaderTpl(tagSets[tagset]));
          $("a[href=\'#tagset-" + tagset + "\']").text(tagSets[tagset].name)
            .parent().toggleClass(\'is-reserved\', tagSets[tagset].is_reserved == 1)
            .attr(\'title\', ts(\''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js','1' => '%1')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tag Set for %1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\', {\'1\': tagSets[tagset].used_for_label.join(\', \')}));
        }

        if (tagset) {
          addTagsetHeader();
        }

        function moveTagDialog(e) {
          e.preventDefault();
          var sets = [{key: \'0\', value: \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Main Tag Tree<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\'}];
          _.each(tagSets, function(tagSet) {
            sets.push({key: tagSet.id, value: tagSet.name});
          });
          CRM.confirm({
            title: \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move to Tagset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\',
            message: \'<label for="select-tagset">'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select Tagset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ': \'
              + \'<select id="select-tagset" class="crm-select2 big">\'
              + CRM.utils.renderOptions(sets, tagset)
              + \'</select>\'
          })
            .on(\'crmConfirm:yes\', function() {
              var chosen = parseInt($(\'#select-tagset\').val());
              if (parseInt(tagset) !== chosen) {
                var apiCalls = [];
                _.each(selected, function(id) {
                  apiCalls.push([\'Tag\', \'create\', {id: id, parent_id: chosen || \'\'}]);
                });
                $(\'#mainTabContainer\').block();
                CRM.api3(apiCalls, true)
                  .done(function() {
                    $(\'.tag-tree\', $panel).jstree(true).refresh();
                    $(\'#mainTabContainer\').unblock();
                    var $otherPanel = $(chosen ? \'#tagset-\' + chosen : \'#tree\');
                    if ($(\'.tag-tree\', $otherPanel).length) {
                      $(\'.tag-tree\', $otherPanel).jstree(true).refresh();
                    }
                  });
              }
            });
        }

        function isDraggable(nodes, event) {
          var draggable = true;
          _.each(nodes, function(node) {
            if (node.data.is_reserved && !CRM.checkPerm(\'administer reserved tags\')) {
              draggable = false;
            }
          });
          return draggable;
        }

        $panel
          .append(\'<div class="tag-tree-wrapper"><div class="tag-tree"></div><div class="tag-info"></div></div>\')
          .on(\'change\', \'input[type=color]\', changeColor)
          .on(\'change\', \'input[name=used_for]\', changeUsedFor)
          .on(\'click\', \'.clear-tag-selection\', clearSelection)
          .on(\'click\', \'.move-tag-button\', moveTagDialog)
          .on(\'click\', \'.used-for-toggle\', function() {
            $(this).attr(\'style\', \'display: none !important;\').next().show();
          })
          .on(\'click\', \'a.crm-clear-link\', function() {
            $(\'.tag-tree\', $panel).jstree(true).refresh();
          })
          .on(\'crmPopupFormSuccess crmFormSuccess\', function(e, cts, data) {
            if ($(e.target).hasClass(\'tagset-action-delete\')) {
              deleteTagset();
            } else if ($(e.target).hasClass(\'tagset-action-update\')) {
              updateTagset(data.tag);
            } else {
              $(\'.tag-tree\', $panel).jstree(true).refresh();
            }
          });

        plugins = [\'wholerow\', \'changed\', \'search\'];
        if (!tagset) {
          // Allow drag-n-drop nesting of the tag tree
          plugins.push(\'dnd\');
        }

        $(\'.tag-tree\', $panel)
          .on(\'changed.jstree loaded.jstree\', changeSelection)
          .on(\'move_node.jstree\', moveTag)
          .on(\'search.jstree\', function() {
            $(this).unblock();
          })
          .jstree({
            core: {
              data: {
                url: CRM.url(\'civicrm/ajax/tagTree\'),
                data: function(node) {
                  return {parent_id: node.id === \'#\' ? tagset : node.id};
                }
              },
              themes: {icons: false},
              check_callback: true
            },
            \'search\': {
              \'ajax\' : {
                url : CRM.url(\'civicrm/ajax/tagTree\')
              },
              \'show_only_matches\': true
            },
            plugins: plugins,
            dnd: {
              is_draggable: isDraggable,
              copy: false
            }
          });

        $(\'input[name=filter_tag_tree]\', $panel).on(\'keyup change\', function(e) {
          var element = $(this);
          var searchString = element.val();
          if (e.type == \'change\') {
            if (window.searchedString === searchString) {
              if (searchString === \'\') {
                $(\'.tag-tree\', $panel).jstree("clear_search");
                $(\'.tag-tree\', $panel).jstree("refresh", true, true);
              }
              else {
                $(\'.tag-tree\', $panel).block();
                $(".tag-tree", $panel).jstree("search", searchString);
                delete window.searchedString;
              }
            }
          }
          else {
            if (this.timer) clearTimeout(this.timer);
            this.timer = setTimeout(function() {
              if (_.isEmpty(window.searchedString) || window.searchedString !== searchString) {
                window.searchedString = searchString;
                element.trigger(\'change\');
              }
            }, 1000);
          }
        });
      }

      function newTagset() {
        CRM.loadForm(CRM.url(\'civicrm/tag/edit\', {action: \'add\', tagset: 1}))
          .on(\'crmFormSuccess\', function(e, data) {
            tagSets[data.tag.id] = data.tag;
            tagSets[data.tag.id].display_name = user.display_name;
            formatTagSet(tagSets[data.tag.id]);
            $("#new-tagset").before(\'<div id="tagset-\' + data.tag.id + \'">\');
            $("a[href=\'#new-tagset\']").parent().before(\'<li class="ui-corner-all crm-tab-button"><a href="#tagset-\' + data.tag.id + \'">\' + data.tag.name + \'</a></li>\');
            $(\'#mainTabContainer\').tabs(\'refresh\');
            $(\'#mainTabContainer\').tabs(\'option\', \'active\', -2);
          });
      }

      $(\'#mainTabContainer\')
        .tabs()
        .on("tabsbeforeactivate", function (event, ui) {
          var id = $(ui.newPanel).attr(\'id\');
          if (id === \'new-tagset\') {
            event.preventDefault();
            newTagset();
            return false;
          }
          if ($.inArray(id, renderedTabs) < 0) {
            renderedTabs.push(id);
            renderTree(ui.newPanel);
          }
        });

      renderTree($(\'#tree\'));

      // Prevent the info box from scrolling offscreen
      $window.on(\'scroll resize\', function () {
        var $wrapper = $(\'.tag-tree-wrapper:visible\'),
          pos = $wrapper.offset(),
          $box = $(\'.tag-info:visible\');
        if ($window.scrollTop() + menuHeight > pos.top) {
          $box.css({
            position: \'fixed\',
            top: menuHeight,
            right: parseInt($window.width() - (pos.left + $wrapper.width())),
            width: parseInt($wrapper.width() * .40)
          });
        } else {
          $box.removeAttr(\'style\');
        }
      });

    });
  })(CRM.$, CRM._);
</script>
<style type="text/css">
  div.tag-tree-wrapper {
    position: relative;
    min-height: 250px;
  }
  div.tag-tree {
    width: 59%;
  }
  div.tag-info {
    width: 40%;
    position: absolute;
    top: 5px;
    right: 0;
    min-height: 100px;
    border: 1px solid #aaa;
    border-radius: 4px;
    box-shadow: 0 0 4px #e3e3e3;
    padding: 1em;
    box-sizing: border-box;
    background: white;
  }
  div.tag-info .clear-tag-selection {
    position: absolute;
    top: 10px;
    right: 12px;
    color: inherit;
    opacity: .5;
  }
  div.tag-info .clear-tag-selection:hover,
  div.tag-info .clear-tag-selection:active {
    opacity: 1;
  }
  .tag-tree-wrapper .tag-tree a.crm-tag-item {
    border-radius: 3px;
    margin: 2px 0;
    height: 20px;
    line-height: 20px;
    font-size: 12px;
    padding: 0 3px;
  }
  #tree a.crm-tag-item {
    cursor: move;
  }
  li.is-reserved > a:after {
    content: \' *\';
  }
  '; ?>
<?php if (! call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'administer reserved tags' )): ?><?php echo '
    #tree li.is-reserved > a.crm-tag-item {
      cursor: not-allowed;
    }
    li.is-reserved > a:after {
      color: #8A1F11;
    }
  '; ?>
<?php endif; ?><?php echo '
  .tag-tree-wrapper ul {
    margin: 0;
    padding: 0;
  }
  div.tag-info h4 .crm-editable {
    min-width: 60%;
    padding: .2em;
  }
  div.tag-info .crm-editable-enabled {
    min-width: 5em;
  }
  div.tag-info .crm-editable-enabled[data-field=description] {
    min-width: 60%;
  }
  div.tag-info input[type=color] {
    cursor: pointer;
  }
  div.tag-info input[disabled] {
    cursor: default;
  }
  div.tag-info .tdl {
    font-weight: bold;
    color: #999;
  }
  div.tag-info hr {
    margin: .2em 0;
  }
  div.tag-info .crm-submit-buttons {
    margin: 10px 0 0;
  }
</style>
'; ?>


<script type="text/template" id="noneSelectedTpl">
  <% if (length) { %>
    <h4><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>None Selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h4>
    <hr />
    <p><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select one or more tags for details.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <% } else { %>
    <h4><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Empty Tag Set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h4>
    <hr />
    <p><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No tags have been created in this set.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <% } %>
  <div class="crm-submit-buttons">
    <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/edit",'q' => "action=add&parent_id="), $this);?>
<%= tagset || '' %>" class="button crm-popup">
      <span><i class="crm-i fa-plus" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Tag<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
    </a>
    <% if(tagset && adminTagsets) { %>
      <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/edit",'q' => "action=update&id="), $this);?>
<%= tagset %>" class="button crm-popup tagset-action-update">
        <span><i class="crm-i fa-pencil" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </a>
    <% } %>
    <% if(tagset && !length && adminTagsets && (!is_reserved || adminReserved)) { %>
      <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/edit",'q' => "action=delete&id="), $this);?>
<%= tagset %>" class="button crm-popup small-popup tagset-action-delete">
        <span><i class="crm-i fa-trash" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete Set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </a>
    <% } %>
  </div>
</script>

<script type="text/template" id="oneSelectedTpl">
  <div class="crm-entity" data-entity="Tag" data-id="<%= id %>">
    <h4>
      <input type="color" value="<%= data.color %>" <% if (!data.is_reserved || adminReserved) { %>title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select color<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" <% } else { %>disabled<% } %> />
      <span class="<% if (!data.is_reserved || adminReserved) { %>crm-editable<% } %>" data-field="name"><%- text %></span>
    </h4>
    <hr />
    <div><span class="tdl"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <span class="<% if (!data.is_reserved || adminReserved) { %>crm-editable<% } %>" data-field="description"><%- data.description %></span>
    </div>
    <div><span class="tdl"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Selectable:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <span class="<% if (!data.is_reserved || adminReserved) { %>crm-editable<% } %>" data-field="is_selectable" data-type="select"><% if (data.is_selectable) { %> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <% } else { %> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <% } %></span>
    </div>
    <div><span class="tdl"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reserved:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <span class="<% if (adminReserved) { %>crm-editable<% } %>" data-field="is_reserved" data-type="select"><% if (data.is_reserved) { %> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Yes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <% } else { %> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <% } %></span>
    </div>
    <% if (parent === '#' && !tagset) { %>
      <div>
        <span class="tdl"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Used For:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        <?php echo '
          <span class="<% if (!data.is_reserved || adminReserved) { %>crm-editable-enabled used-for-toggle<% } %>">
            <% if (!data.used_for.length) { %><i class="crm-i fa-pencil crm-editable-placeholder" aria-hidden="true"></i><% } %>
            <% _.forEach(data.used_for, function(key, i) { %><%- (i ? \', \' : \'\') + usedFor[key] %><% }) %>
          </span>
          <span style="display: none">
          <% _.forEach(usedFor, function(label, key) { %>
            <span style="white-space: nowrap">
              <input type="checkbox" name="used_for" value="<%= key %>" id="<%= id + \'_used_for_\' + key %>" <% if (data.used_for.indexOf(key) > -1) { %>checked<% } %> />
              <label for="<%= id + \'_used_for_\' + key %>"><%- label %></label>
            </span>
          <% }) %>
          </span>
        '; ?>

      </div>
    <% } %>
    <div><span class="tdl"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Usage Count:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> <%= data.usages %></div>
    <a class="clear-tag-selection" href="#" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear selection<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><i class="crm-i fa-ban" aria-hidden="true"></i></a>
  </div>
  <div class="crm-submit-buttons">
    <% if(!tagset) { %>
      <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/edit",'q' => "action=add&parent_id="), $this);?>
<%= id %>" class="button crm-popup" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create new tag under this one<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
        <span><i class="crm-i fa-plus" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Child<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </a>
    <% } %>
    <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/edit",'q' => "action=add&clone_from="), $this);?>
<%= id %>" class="button crm-popup" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Duplicate this tag<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
      <span><i class="crm-i fa-copy" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clone Tag<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
    </a>
    <% if(!data.is_reserved || adminReserved) { %>
      <% if(tagsetCount) { %>
        <a href="#move" class="button move-tag-button" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move to a different tagset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          <span><i class="crm-i fa-share-square-o" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move Tag<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </a>
      <% } %>
      <% if(!hasChildren) { %>
        <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/edit",'q' => "action=delete&id="), $this);?>
<%= id %>" class="button crm-popup small-popup">
          <span><i class="crm-i fa-trash" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </a>
      <% } %>
    <% } %>
  </div>
</script>

<script type="text/template" id="moreSelectedTpl">
  <h4><?php $this->_tag_stack[] = array('ts', array('1' => "<%= items.length %>")); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>%1 Tags Selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h4>
  <hr />
    <% if (reserved) { %>
      <p>* <?php $this->_tag_stack[] = array('ts', array('1' => "<%= reserved %>")); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>%1 reserved.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <% } %>
  <p><span class="tdl"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total Usage:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> <%= usages %></p>
  <a class="clear-tag-selection" href="#" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear selection<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><i class="crm-i fa-ban" aria-hidden="true"></i></a>
  <div class="crm-submit-buttons">
    <% if(!reserved || adminReserved) { %>
      <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/merge",'q' => "id="), $this);?>
<%= items.join() %>" class="button crm-popup small-popup" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Combine tags into one<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
        <span><i class="crm-i fa-compress" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Merge Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </a>
      <% if(tagsetCount) { %>
        <a href="#move" class="button move-tag-button" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move to a different tagset<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
          <span><i class="crm-i fa-share-square-o" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </a>
      <% } %>
      <% if(!hasChildren) { %>
        <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/tag/edit",'q' => "action=delete&id="), $this);?>
<%= items.join() %>" class="button crm-popup small-popup">
          <span><i class="crm-i fa-trash" aria-hidden="true"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </a>
      <% } %>
    <% } %>
  </div>
</script>

<script type="text/template" id="tagsetHeaderTpl">
  <div class="tagset-header">
    <div class="help">
      <% if(is_reserved == 1) { %><strong><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Reserved<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong><% } %>
      <% if(undefined === display_name) { var display_name = null; } %>
      <?php $this->_tag_stack[] = array('ts', array('1' => "<%= used_for_label.join(', ') %>",'2' => "<%= date %>",'3' => "<%= display_name %>")); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tag Set for %1 (created %2 by %3).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <% if(typeof description === 'string' && description.length && description !== 'null') { %><p><em><%- description %></em></p><% } %>
    </div>
    <input class="crm-form-text big" name="filter_tag_tree" placeholder="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" allowclear="1"/>
    <a class="crm-hover-button crm-clear-link" style="visibility:hidden;" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Clear<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><i class="crm-i fa-times" aria-hidden="true"></i></a>
  </div>
</script>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>