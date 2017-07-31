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

			<?php $theme = ( isset( $_GET['theme'] ) ) ? $_GET['theme'] : ''; ?>

			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="frm_position_finder" name="frm_position_finder" method="GET">
				<label><input type="text" name="theme" id="theme" placeholder="Enter theme name or slug&hellip;" value="<?php echo esc_attr( $theme ); ?>" autofocus /></label>
				<input type="submit" value="GO" />
			</form>

			<?php
				if ( $theme ) {
					$theme_slug = theme_position_validate_input( $theme );
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
