<section class="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'Cooker' ); ?></p></section>
	<?php return; endif; ?>
	<?php if ( have_comments() ) : ?>
	<header>
		<h2 class="heading">
			<?php
				printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number() ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>
	</header>
	<ul class="commentlist">
		<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
	</ul>
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<p class="nocomments">Comments are closed.</p>
	<?php endif; ?>
	<section><?php comment_form(); ?></section>
</section>