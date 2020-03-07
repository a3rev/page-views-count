<style>
<?php
global $pvc_settings;
?>
.pvc_clear {
	clear: both;
}
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
body .pvc_stats .pvc-stats-icon {
	vertical-align: middle;
}
body .pvc_stats .pvc-stats-icon.small svg {
	width: 16px;
}
body .pvc_stats .pvc-stats-icon.medium svg {
	width: 20px;
}
body .pvc_stats .pvc-stats-icon.large svg {
	width: 24px;
}
</style>