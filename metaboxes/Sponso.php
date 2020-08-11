<?php

class Sponso {

	const META_KEY = 'article_sponso';

	public static function register() {
		add_action( 'add_meta_boxes', [ self::class, 'avalontheme_meta_box' ] );
		add_action( 'save_post', [ self::class, 'avalontheme_save_meta_sponso' ] );
	}

	public static function avalontheme_meta_box() {
		add_meta_box( 'avalontheme_sponso', 'sponsoring', [ self::class, 'avalontheme_sponso_box' ], 'post', 'side' );
	}

	public static function avalontheme_sponso_box() {
		?>
        <input type="hidden" value="0" name="<?php self::META_KEY; ?>">
        <input type="checkbox" value="1" name="<?php self::META_KEY; ?>"
			<?php if ( get_post_meta( get_the_ID(), 'article_sponso', true ) === '1' ): ?>
                checked
			<?php endif; ?>
        >
        <label for="avalontheme_sponso"> Cet article est sponsorisé ?</label>
		<?php
	}

	public static function avalontheme_save_meta_sponso( $post_id ) {
		if ( array_key_exists( self::META_KEY, $_POST ) && current_user_can( 'edit_post', $post_id ) ) {
			if ( $_POST[ self::META_KEY ] === '0' ) {
				delete_post_meta( $post_id, self::META_KEY );
			} else {
				update_post_meta( $post_id, self::META_KEY, 1 );
			}
		}
	}
}

?>
