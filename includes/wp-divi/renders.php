<?php

if ( ! function_exists( 'et_builder_include_general_categories_option' ) ) :
function et_builder_include_general_categories_option( $args = array() ) {
	$defaults = apply_filters( 'et_builder_include_categories_defaults', array (
		'use_terms' => true,
		'term_name' => array('public_agent_state', 'category', 'public_agent_job', 'public_agent_party', 'public_agent_genre', 'public_agent_commission', 'public_agent_vote'),
	) );

	$args = wp_parse_args( $args, $defaults );

	$output = "\t" . "<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>" . "\n";

	if ( $args['use_terms'] ) {
		$cats_array = get_terms( $args['term_name'] );
	} else {
		$cats_array = get_categories( apply_filters( 'et_builder_get_categories_args', 'hide_empty=0' ) );
	}

	if ( empty( $cats_array ) ) {
		$output = '<p>' . esc_html__( "You currently don't have any public agent assigned to a category.", 'et_builder' ) . '</p>';
	}

	foreach ( $cats_array as $category ) {
		$contains = sprintf(
			'<%%= _.contains( et_pb_include_categories_temp, "%1$s" ) ? checked="checked" : "" %%>',
			esc_html( $category->term_id )
		);
  if ( $category->taxonomy == 'public_agent_commission' ) {
    //separados pois não deve ser impresso apenas comissão sem suplente e titular
    if ( $category->name == 'titular' || $category->name == 'suplente' ) {
      $output .= sprintf(
        '%4$s<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',
        esc_attr( $category->term_id ),
        esc_html( get_category_parents( $category->term_id, false, ' &raquo; ' ) ),
        $contains,
        "\n\t\t\t\t\t"
      );
    }
  }else{
    $output .= sprintf(
      '%4$s<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',
      esc_attr( $category->term_id ),
      esc_html( $category->name ),
      $contains,
      "\n\t\t\t\t\t"
    );
  }

	}

	$output = '<div id="et_pb_include_categories">' . $output . '</div>';

	return apply_filters( 'et_builder_include_categories_option_html', $output );
}
endif;

if ( ! function_exists( 'et_divi_get_public_agent' ) ) :
function et_divi_get_public_agent( $args = array() ) {
	$default_args = array(
		'post_type' => 'public_agent',
	);
	$args = wp_parse_args( $args, $default_args );
	return new WP_Query( $args );
}
endif;

add_action( 'wp_enqueue_scripts', 'wp_divi_makepressure_script' );

function wp_divi_makepressure_script() {
  wp_register_style( 'divi-makepressure',  plugin_dir_url( __FILE__ ).'ET_Builder_Module_Make_Pressure/frontend/css/ET_Builder_Module_Make_Pressure.css' );
  wp_enqueue_style( 'divi-makepressure' );
}

function wp_divi_separete_categories($include_categories, $args){
	$terms_category = '';
	$terms_states = '';
	$terms_party = '';
	$terms_job = '';
	$terms_genre = '';
	$terms_commission = '';
	$terms_position = '';
	$categories = explode( ',', $include_categories );
	foreach ($categories as $category) {

	  $term = get_term($category);

	  if (!is_wp_error($term)) {
	    if($term->taxonomy === 'category'){
	      $terms_category .= $terms_category ? ', ' . $category : $category;
	    }
	    if ($term->taxonomy === 'public_agent_state') {
	      $terms_states .= $terms_states ? ', ' . $category : $category;
	    }
	    if ($term->taxonomy === 'public_agent_job') {
	      $terms_job .= $terms_job ? ', ' . $category : $category;
	    }
	    if ($term->taxonomy === 'public_agent_genre') {
	      $terms_genre .= $terms_genre ? ', ' . $category : $category;
	    }
	    if ($term->taxonomy === 'public_agent_party') {
	      $terms_party .= $terms_party ? ', ' . $category : $category;
	    }
	    if ($term->taxonomy === 'public_agent_commission') {
	      $terms_commission .= $terms_commission ? ', ' . $category : $category;
	    }
	    if ($term->taxonomy === 'public_agent_vote') {
	      $terms_position .= $terms_position ? ', ' . $category : $category;
	    }
	  }

	}
	$settings_states = '';
	$settings_category = '';
	$settings_job = '';
	$settings_genre = '';
	$settings_party = '';
	$settings_commission = '';
	$settings_position = '';

	if ($terms_category){
		$settings_category = array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => explode( ',', $terms_category ),
				'operator' => 'IN',
			);
	} if ($terms_states) {
		$settings_states = array(
				'taxonomy' => 'public_agent_state',
				'field' => 'id',
				'terms' => explode( ',', $terms_states ),
				'operator' => 'IN',
			);
	} if ($terms_job) {
		$settings_job = array(
				'taxonomy' => 'public_agent_job',
				'field' => 'id',
				'terms' => explode( ',', $terms_job ),
				'operator' => 'IN',
			);
	} if ($terms_genre) {
		$settings_genre = array(
				'taxonomy' => 'public_agent_genre',
				'field' => 'id',
				'terms' => explode( ',', $terms_genre ),
				'operator' => 'IN',
			);
	} if ($terms_party) {
		$settings_party = array(
				'taxonomy' => 'public_agent_party',
				'field' => 'id',
				'terms' => explode( ',', $terms_party ),
				'operator' => 'IN',
			);
	} if ($terms_commission) {
		$settings_commission = array(
				'taxonomy' => 'public_agent_commission',
				'field' => 'id',
				'terms' => explode( ',', $terms_commission ),
				'operator' => 'IN',
			);
	} if ($terms_position) {
		$settings_position = array(
				'taxonomy' => 'public_agent_vote',
				'field' => 'id',
				'terms' => explode( ',', $terms_position ),
				'operator' => 'IN',
			);
	}

	if ( '' !== $include_categories )
		$args['tax_query'] = array(
			'relation' => 'AND',
			$settings_states,
			$settings_category,
			$settings_job,
			$settings_genre,
			$settings_party,
			$settings_commission,
			$settings_position
		);
	return $args;
}


function wp_divi_get_congresscards( $args, $fullwidth, $hover_icon, $show_title, $show_categories){
ob_start();
$emails = array();
query_posts( $args );
if ( have_posts() ) {
while ( have_posts() ) {
the_post();

$voto = get_post_meta(get_the_ID(),mk_get_option("result"),true);
$email = get_post_meta(get_the_ID(), 'public_agent_email', true);

$emails[] = $email;
if ($voto > 0)
	$votaux = 'positive';
else if ($voto < 0)
	$votaux = 'negative';
else
	$votaux = 'neutral';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( " makepressure_grid makepressure_grid_item ".$votaux ); ?>>

	<?php

	$thumb = '';

	$width = 'on' === $fullwidth ?  150 : 400;
	$width = (int) apply_filters( 'et_pb_portfolio_image_width', $width );

	$height = 'on' === $fullwidth ?  200 : 284;
	$height = (int) apply_filters( 'et_pb_portfolio_image_height', $height );
	$classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
	$titletext = get_the_title();

	$cargo = wp_get_post_terms( get_the_ID() , 'public_agent_job' ) ? wp_get_post_terms(  get_the_ID(), 'public_agent_job', true) : '';
	$cargo = isset($cargo[0]) ? $cargo[0] : '';
	if($cargo):
		?>
	<a href="<?php esc_url( the_permalink() ); ?>">
		<?php if(has_post_thumbnail()) : ?>
		<?php the_post_thumbnail(array(175,175), array('class' => 'makepressure_' . $cargo->slug . ' makepressure_post_main_image')); ?>
	<?php endif; ?>
</a>
<?php
endif;
if ( 'on' !== $fullwidth ) :

	$data_icon = '' !== $hover_icon
? sprintf(
	' data-icon="%1$s"',
	esc_attr( et_pb_process_font_icon( $hover_icon ) )
	)
: '';
?>
</span>
<?php endif; ?>
</a>
<div class="makepressure_label">
	<?php if ( 'on' === $show_title ) : ?>
	<h2 class="makepressure_title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2>
<?php endif; ?>

<?php
			  //pre get categories
$state = wp_get_post_terms( get_the_ID() , 'public_agent_state');
$party = wp_get_post_terms( get_the_ID() , 'public_agent_party');
			  //$category = wp_get_post_terms( get_the_ID() , 'category')[0];
?>
<strong class="makepressure_upper">
	<?php if ($state[0]->slug): ?>
	<?php echo $state[0]->slug; ?>
<?php else: ?>
	<br>
<?php endif; ?>

<?php if (isset($party[0]->slug)): ?>
	<?php echo ' / '; ?>
	<?php echo $party[0]->slug; ?>
<?php else: ?>
	<br>
<?php endif; ?>
</strong>
</div>

<?php if ( 'on' === $show_categories ) : ?>
	<p class="post-meta"><?php //echo get_the_term_list( get_the_ID(), 'category', '', ', ' ); ?></p>
<?php endif; ?>

<?php wp_divi_get_share_buttons(); ?>

</div> <!-- .et_pb_portfolio_item -->

<?php	}

		/*if ( 'on' === $show_pagination && ! is_search() ) {
			echo '</div><!-- .et_pb_portfolio -->';

			$container_is_closed = true;

			if ( function_exists( 'wp_pagenavi' ) ) {
				wp_pagenavi();
			} else {
				if ( et_is_builder_plugin_active() ) {
					include( ET_BUILDER_PLUGIN_DIR . 'includes/navigation.php' );
				} else {
					get_template_part( 'includes/navigation', 'index' );
				}
			}
		}*/

		wp_reset_query();
	} else {
		if ( et_is_builder_plugin_active() ) {
			include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );
		} else {
			get_template_part( 'includes/no-results', 'index' );
		}
	}

	shuffle($emails);
	$emails = array_slice($emails, 0, 98);

	$posts = ob_get_contents();
	ob_end_clean();
	ob_start();
	?>

	<input id="makepressure_hidden_emails" type="hidden" value="<?php echo implode( ',', $emails ); ?>">
	<script>
	var emails = document.getElementById('makepressure_hidden_emails');
	var result_button = document.getElementsByClassName('et_makepressure_result_button');
	result_button[0].href = 'mailto:'+jQuery('#makepressure_hidden_emails').val()+',<?php echo BACKUP_EMAIL; ?>?subject=<?php echo get_option('makepressure_email_title'); ?>&body=<?php echo get_option('makepressure_email_body'); ?>';
	var result_button_gmail = document.getElementsByClassName('et_makepressure_result_button_gmail');
	result_button_gmail[0].href = 'https://mail.google.com/mail?view=cm&tf=0&to='+jQuery('#makepressure_hidden_emails').val()+',<?php echo BACKUP_EMAIL; ?>&su=<?php echo get_option('makepressure_email_title'); ?>&body=<?php echo get_option('makepressure_email_body'); ?>';



	</script>
	<?php
	$emails = ob_get_contents();
	ob_end_clean();

	return $emails.$posts;
}

function wp_divi_get_share_buttons(){



	$email_subject = get_option( 'makepressure_email_title' );
	$email_body = get_option( 'makepressure_email_body' );
	$more_emails = get_option( 'makepressure_more_emails' );

	$twitter_text = get_option( 'makepressure_twitter_text' );
	$twitter_url = get_option( 'makepressure_twitter_url' );
	$twitter_hashtag = get_option( 'makepressure_twitter_hashtag' );
	?>
	<div class="makepressure_action" >

			<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1129486127138725',
      xfbml      : true,
      version    : 'v2.8',
      status     : true
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/pt_BR/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  /* make the API call */
  function myFacebookLogin(to) {
    FB.login(function(){
      FB.api(
          '/joarizadtna/feed',
          "POST",
          {
              "message": "Vote contra a PEC do fim do Mundo!!!"
          },
          function (response) {
            if (response && !response.error) {
              console.log("Mensagem Encaminhada ;)");
            }
            else{
              console.log("Mensagem não chegou ao destinatário :(");
              console.log(response.error);
            }
          }
      );
    }, {scope: 'publish_actions, publish_pages'});
  }
</script>
      <?php
	    $genre = wp_get_post_terms( get_the_ID() , 'public_agent_genre');
	    $size = "fa-3x";
	    if (is_array($genre)) {
	      $genre = $genre[0];
	      $genre_slug = $genre->slug;
	    }

		if ( get_post_meta(  get_the_ID(), 'public_agent_email', true) ) : ?>
	  	  <a id="<?php echo get_the_ID(); ?>" class="fa <?= $size ?> fa-envelope makepressure_email" href="mailto:<?php print_r(get_post_meta(  get_the_ID(), 'public_agent_email', true)); ?>?subject=Excelentissim<?php echo $genre_slug=='feminino'?'a':'o'; ?>%20<?php echo get_post_meta(  get_the_ID(), 'public_agent_cargo', true)?get_post_meta(  get_the_ID(), 'public_agent_cargo', true):''; ?>%20<?php echo get_the_title(); ?>&body=Excelentissim<?php echo $genre_slug=='feminino'?'a':'o'; ?>%20<?php echo get_post_meta(  get_the_ID(), 'public_agent_cargo', true) ?get_post_meta(  get_the_ID(), 'public_agent_cargo', true):''; ?>%20<?php echo get_the_title(); ?>,  %0A%0A<?php echo $email_body; ?>" ></a>
		<?php endif; ?>
        <?php if ( get_post_meta(  get_the_ID(), 'public_agent_email', true) ) : ?>
          <a id="<?php echo get_the_ID(); ?>" target="_blank" class="fa <?= $size ?> fa-google makepressure_gmail" href="https://mail.google.com/mail?view=cm&tf=0&to=<?php print_r(get_post_meta(  get_the_ID(), 'public_agent_email', true)); ?>&su=Excelentissim<?php echo $genre_slug=='feminino'?'a':'o'; ?>%20<?php echo get_post_meta(  get_the_ID(), 'public_agent_cargo', true)?get_post_meta(  get_the_ID(), 'public_agent_cargo', true):''; ?>%20<?php echo get_the_title(); ?>&body=Excelentissim<?php echo $genre_slug=='feminino'?'a':'o'; ?>%20<?php echo get_post_meta(  get_the_ID(), 'public_agent_cargo', true) ?get_post_meta(  get_the_ID(), 'public_agent_cargo', true):''; ?>%20<?php echo get_the_title(); ?>,  %0A%0A<?php echo $email_body; ?>" ></a>
        <?php endif; ?>
		<?php if ( get_post_meta(  get_the_ID(), 'public_agent_twitter', true) ) : ?>
		  <a id="<?php echo get_the_ID(); ?>" class="fa fa-twitter <?= $size ?> makepressure_twitter"  target="_brank" href="https://twitter.com/intent/tweet?text=@<?php echo get_post_meta(  get_the_ID(), 'public_agent_twitter', true ); ?><?php echo $twitter_text; ?>&url=<?php echo $twitter_url; ?>&hashtags=<?php echo $twitter_hashtag; ?>" data-show-count="false"></a>
		<?php endif; ?>
		<?php $facebook_url = get_post_meta(  get_the_ID(), 'public_agent_facebook', true); ?>
		<?php if ( get_post_meta(  get_the_ID(), 'public_agent_facebook', true) ) : ?>
		  <a id="<?php echo get_the_ID(); ?>" class="fa fa-facebook-official <?= $size ?> makepressure_facebook" target="_brank" href="<?= $facebook_url ?>"></a>
		  <!--a id="<?= get_the_ID(); ?>" class="fa fa-comment <?= $size ?> makepressure_facebook" onclick="myFacebookLogin('<?= str_replace('https://www.facebook.com/', '', $facebook_url); ?>')"></a-->
		<?php endif; ?>



	</div>
	<?php
}
