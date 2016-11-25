<?php
/**
 * Front page template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Position
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<p><a href="https://themes.trac.wordpress.org/report/2" target="_blank">Theme Review Queue</a></p>

			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="frm_position_finder" name="frm_position_finder" method="post">
				<?php $txt_theme_name = ( isset( $_POST['txt_theme_name'] ) ) ? $_POST['txt_theme_name'] : ''; ?>
				<label><input type="text" name="txt_theme_name" id="txt_theme_name" placeholder="Enter theme name or slug..." value="<?php echo esc_attr( $txt_theme_name ); ?>" /></label>
				<button type"submit" name="btn_go">GO</button>
			</form>

			<?php
				if ( isset( $_POST['btn_go'] ) ) {
					$theme_slug = theme_position_validate_input( $_POST );
					if ( ! empty( $theme_slug ) ) {
						theme_position_render_result( $theme_slug );
					}
					else {
						echo '<p>Error!</p>';
					}
				}
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
