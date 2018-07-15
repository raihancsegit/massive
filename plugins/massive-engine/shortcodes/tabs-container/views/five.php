<section class="square-tabs text-center <?php echo esc_attr( $atts['uid'] ); ?>">
    <ul class="nav nav-pills <?php echo esc_attr( $atts['alignment'] ); ?>">
         <?php foreach($nav[0] as $list_item) { echo $list_item; } ?>
    </ul>
    <div class="panel-body">
        <div class="tab-content">
           <?php foreach($tab_contents[0] as $list_item) { echo $list_item; } ?>
        </div>
    </div>
</section>
