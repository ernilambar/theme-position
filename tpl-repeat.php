<?php
/**
 * Template Name: Repeat
 *
 * @package Theme_Position
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$all_tickets = theme_position_get_all_open_tickets();
			?>
			<?php
			$output = array();

			if ( ! empty( $all_tickets ) ) {
				foreach ( $all_tickets as $key => $val ) {
					if ( isset( $output[ $val['reporter'] ] ) ) {
						$output[ $val['reporter'] ]++;
					} else {
						$output[ $val['reporter'] ] = 1;
					}
				}
			}
			?>

			<?php if ( ! empty( $output ) ) : ?>
				<ul>

				<?php foreach ( $output as $k => $v ) : ?>
					<?php if ( absint( $v ) > 1 ) : ?>
						<li><a href="https://themes.trac.wordpress.org/query?status=!closed&reporter=<?php echo esc_attr( $k ); ?>" target="_blank"><?php echo esc_html( $k ); ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			<?php else: ?>
				<p>Not found</p>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
