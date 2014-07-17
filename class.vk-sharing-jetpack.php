<?php

if ( class_exists( 'Share_Twitter' ) && ! class_exists( 'Share_VKcom' ) ) :

// Build button
class Share_VKcom extends Share_Twitter {
	var $shortname = 'vkcom';
	public function __construct( $id, array $settings ) {
		parent::__construct( $id, $settings );
		$this->smart = 'official' == $this->button_style;
		$this->icon = 'icon' == $this->button_style;
		$this->button_style = 'icon-text';
	}

	public function get_name() {
		return __( 'Vk.com', 'vkjp' );
	}

	// Load resources (js or css) in the head
	public function display_header() {
		if ( $this->smart ) {
?>
<script type="text/javascript" src="//vk.com/js/api/share.js?9" charset="windows-1251"></script>
<style type="text/css">
	.share-vkcom tr td {
		padding: 0 !important;
	}
</style>
<?php
		} else {
?>
<style type="text/css">
	.sd-social-icon-text li.share-vkcom a.sd-button > span {
		background: url('<?php echo plugins_url( 'vk.png', __FILE__ ); ?>') no-repeat;
		padding-left: 20px;
	}

	.sd-social-icon .sd-content ul li[class*='share-'].share-vkcom a.sd-button {
		background: #2B587A url('<?php echo plugins_url( 'vk-white.png', __FILE__ ); ?>') no-repeat;
		color: #fff !important;
		width: 16px;
		height: 16px;
		top: 16px;
	}
</style>
<?php
		}
	}

	public function get_display( $post ) {
		if ( $this->smart ) {
			return '
			<script type="text/javascript"><!--
			document.write(
				VK.Share.button(
					false,
					{
						type: "button",
						url: "'. esc_js( get_permalink( $post->ID ) ) .'",
						text: ""
					}
				)
			);
			--></script>';
		} else if ( $this->icon ) {
			return '<a target="_blank" rel="nofollow" class="share-vkcom sd-button share-icon" href="http://vk.com/share.php?url='. urlencode( get_permalink( $post->ID ) ) .'"><span></span></a>';
		} else {
			return '<a target="_blank" rel="nofollow" class="share-vkcom sd-button share-icon" href="http://vk.com/share.php?url='. urlencode( get_permalink( $post->ID ) ) .'"><span>Vk.com</span></a>';
		}
	}
}

endif; // class_exists
