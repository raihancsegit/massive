<?php
/**
 * Backup
 */
$massive_options[] = array(
    'name'   => 'backup',
    'title'  => esc_html__( 'Backup', 'massive' ),
    'icon'   => 'fa fa-suitcase',
    'fields' => array(
        array(
            'id'    => 'backup',
            'type'  => 'backup',
            'title' => esc_html__( 'Backup Options', 'massive' ),
            )
        )
    );
