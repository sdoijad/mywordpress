<?php

/**
 * Accordion element type that take in elements
 */

// Values
// =============================================================================

$values = cs_compose_values(
  [
    'accordion_item_starts_open'    => cs_value( false, 'markup' ),
    'accordion_item_header_content' => cs_value( __( 'Accordion Item Elements', 'cornerstone' ), 'markup:seo', true ),
  ],
  'omega',
  'omega:toggle-hash',
  'omega:looper-provider',
  'omega:looper-consumer'
);



// Render
// =============================================================================

function x_element_render_accordion_item_elements( $data ) {

  extract( $data );
  $unique_id = ( isset( $unique_id ) ) ? $unique_id : '';
  $style_id  = ( isset( $style_id ) ) ? $style_id : '';
  $class     = ( isset( $class )  ) ? $class  : '';

  // Atts: Accordion Item
  // --------------------


  $atts_accordion_item = [ 'class' => [ $style_id, 'x-acc-item', $class ] ];

  if (isset($id) && $id) {
    $atts_accordion_item['id'] = $id;
  }

  if ( isset( $data['style'] ) && ! empty( $data['style'] ) ) {
    $atts_accordion_item['style'] = $data['style'];
  }

  // Atts: Accordion Header
  // ----------------------

  $accordion_item_header_class = [ 'x-acc-header' ];

  if ( $accordion_item_starts_open ) {
    $accordion_item_header_class[] = 'x-active';
  }

  $atts_accordion_header = [
    'id'                => 'tab-' . $unique_id,
    'class'             => $accordion_item_header_class,
    'role'              => 'tab',
    'type'              => 'button',
    'aria-selected'     => ( $accordion_item_starts_open ) ? 'true' : 'false',
    'aria-expanded'     => ( $accordion_item_starts_open ) ? 'true' : 'false',
    'aria-controls'     => 'panel-' . $unique_id,
    'data-x-toggle'     => 'collapse',
    'data-x-toggleable' => $unique_id,
  ];

  if ( $accordion_grouped ) {
    if ( ! empty( $accordion_group ) ) {
      $atts_accordion_header['data-x-toggle-group'] = $accordion_group;
    } else {
      $atts_accordion_header['data-x-toggle-group'] = $p_unique_id;
    }
  }

  if ( ! empty( $toggle_hash ) ) {
    $atts_accordion_header['data-x-toggle-hash'] = $toggle_hash;
  }


  // Atts: Accordion Collapse
  // ------------------------

  $atts_accordion_collapse = [
    'id'                     => 'panel-' . $unique_id,
    'role'                   => 'tabpanel',
    'aria-hidden'            => ( $accordion_item_starts_open ) ? 'false' : 'true',
    'aria-labelledby'        => 'tab-' . $unique_id,
    'data-x-toggleable'      => $unique_id,
    'data-x-toggle-collapse' => true,
  ];

  if ( ! $accordion_item_starts_open ) {
    $atts_accordion_collapse['class'] = 'x-collapsed';
  }


  // Header Indicator
  // ----------------

  $accordion_header_indicator_content = '';

  if ( $accordion_header_indicator === true ) {

    $accordion_header_indicator_content = ( $accordion_header_indicator_type === 'text' )
      ? $accordion_header_indicator_text
      : cs_get_partial_view( 'icon', cs_extract( $data, [ 'accordion_header_indicator_icon' => 'icon' ] ) );

    $accordion_header_indicator_content = '<span class="x-acc-header-indicator">' . $accordion_header_indicator_content . '</span>';
  }


  // Output
  // ------

  return cs_tag('div', $atts_accordion_item, $custom_atts, [
    // Toggle button
    cs_tag('button', $atts_accordion_header, [
      cs_tag('span', ['class'=> 'x-acc-header-content'],[
        $accordion_header_indicator_content,
        cs_tag('span', ['class'=> 'x-acc-header-text'], $accordion_item_header_content)
      ])
    ]),

    // Div content
    cs_tag('div', $atts_accordion_collapse, [
      cs_tag('div', ['class'=> 'x-acc-content'], cs_render_child_elements( $data ))
    ])
  ]);

}



// Builder Setup
// =============================================================================

function x_element_builder_setup_accordion_item_elements() {

  $control_setup = [
    [
      'type'     => 'group',
      'title'    => cs_recall( 'label_content' ),
      'group'    => 'accordion_item:setup',
      'controls' => [
        [
          'key'     => 'accordion_item_starts_open',
          'type'    => 'choose',
          'label'   => cs_recall( 'label_starts_open' ),
          'options' => cs_recall( 'options_choices_off_on_bool' ),
        ],
        [
          'key'     => 'accordion_item_header_content',
          'type'    => 'text-editor',
          'label'   => cs_recall( 'label_header' ),
          'options' => [
            'height' => 1,
          ],
        ],
      ],
    ],

    [
      'group'    => 'accordion_item:elements',
      'type' => 'children',
    ],

  ];

  return cs_compose_controls(
    [
      'controls'             => $control_setup,
      'control_nav'          => [
        'accordion_item'       => cs_recall( 'label_primary_control_nav' ),
        'accordion_item:setup' => cs_recall( 'label_setup' ),
        'accordion_item:elements' => cs_recall( 'label_elements' ),
      ]
    ],
    cs_partial_controls( 'omega', [
      'add_custom_atts' => true,
      'add_toggle_hash' => true,
      'add_looper_provider' => true,
      'add_looper_consumer' => true
    ])
  );

}



// Register Element
// =============================================================================

cs_register_element( 'accordion-item-elements', [
  'title'   => __( 'Accordion Item (Elements)', 'cornerstone' ),
  'values'  => $values,
  'builder' => 'x_element_builder_setup_accordion_item_elements',
  'render'  => 'x_element_render_accordion_item_elements',
  'icon'    => 'native',
  'options' => [
    'valid_children' => '*',
    'valid_parent'   => 'accordion',
    'shadow_parent'  => true,
    'alt_breadcrumb' => __( 'Item', 'cornerstone' ),
    'label_key'      => 'accordion_item_header_content',

    'default_children' => [
      [
        '_type' => 'text',
        'text_content' => __( 'This is accordion content!', 'cornerstone' )
      ],
    ],

    'inline'         => [
      'accordion_item_header_content' => [
        'selector'       => '.x-acc-header',
        'editing_target' => '.x-acc-header-text'
      ]
    ]
  ]
] );
