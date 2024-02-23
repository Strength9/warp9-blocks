<?php
/**
 * Block Name: delete_me
 * Description: 
 */


$block_id = 'delete_me_' . $block['id'];
if( !empty($block['anchor']) ) { $block_id = $block['anchor']; }

$class_name = 'delete_me';
if( !empty($block['class_name']) ) { $class_name .= ' ' . $block['class_name']; }


?>


<section id="<?php echo $block_id; ?>" class="<?php echo $class_name; ?>">
    <p>BLock - delete_me has been created</p>
</section>