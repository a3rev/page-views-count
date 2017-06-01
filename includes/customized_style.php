<style>
<?php
global $pvc_settings;
?>
/* Stats Icon */
body .pvc-stats-icon {
	color: <?php echo $pvc_settings['icon_color']; ?> !important;
}
body .pvc_stats {
<?php if ( 'centre' == $pvc_settings['aligment'] ) { ?>
	text-align: center;
	float: none;
<?php } elseif ( 'right' == $pvc_settings['aligment'] ) { ?>
	text-align: right;
	float: right;
<?php } ?>
}
</style>