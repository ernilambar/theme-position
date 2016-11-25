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

			<?php $theme_slug = 'juno'; ?>
			<h4>Result for: <em><?php echo $theme_slug; ?></em></h4>
			<?php
				$all_themes = theme_position_get_all_themes();
				$item = wp_list_filter( $all_themes, array( 'slug' => $theme_slug ) );
				if ( ! empty( $item ) ) {
					$keys = array_keys( $item );
					$position = array_shift( $keys );
					$theme = array_shift( $item );
					echo '<ul class="item-list">';
					echo '<li class="position"><span>Position:</span>' . $position . '</li>';
					echo '<li><span>Theme Name:</span><a href="https://themes.trac.wordpress.org/ticket/' . $theme['id'] . '" target="_blank">' . $theme['name'] . '</a></li>';
					echo '<li><span>Version:</span>' . $theme['version'] . '</li>';
					echo '<li><span>Created:</span>' . $theme['time'] . '</li>';
					echo '<li><span>Modified:</span>' . $theme['changetime'] . '</li>';
					echo '<li><span>Reporter:</span><a href="https://themes.trac.wordpress.org/query?status=!closed&reporter=' . $theme['reporter'] . '" target="_blank">' . $theme['reporter'] . '</a></li>';

					echo '</ul>';
				}
				else {
					echo '<p><strong>Not found!</strong></p>';
				}

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
