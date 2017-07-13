<?php
/**
 * Adds Widget MakePressure.
 */
class MakePressure_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'makepressure_widget', // Base ID
      __( 'Widget de Pressão', 'makepressure' ), // Name
      array( 'description' => __( 'Widget que adiciona um botão de super pressão e um link para a página dos Agentes Públicos', 'text_domain' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }
    // super pressure button
    $button_url="mailto:";
    $button_text = $instance['button_text'];
    $args = array(
      'post_type' => 'public_agent',
      'posts_per_page' => -1,
      'post_status' => 'publish'
    );
    $the_query = new WP_Query( $args );
    $emails = array();
    $aux = "";

    // The Loop
    if ( $the_query->have_posts() ) {

      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $emails[] = get_post_meta(  get_the_ID(), 'public_agent_email', true) ? get_post_meta(  get_the_ID(), 'public_agent_email', true):"";
      }
      wp_reset_postdata();
      /* Restore original Post Data */
    } else {
      // no posts found
    }
    $button_url .= implode( ',', array_rand ( $emails, 100 ) ) . "?subject=" . get_option('makepressure_email_title') . "&body=" . get_option('makepressure_email_body');
    // Nothing to output if neither Button Text nor Button URL defined
    if ( '' === $button_text && '' === $button_url ) {
      return;
    }
    $module_class = " et_pb_module";
    $output = sprintf(
      '<div class="et_pb_button_module_wrapper">
        <a class="makepressure_superpressure et_pb_button  et_pb_makepressure_button_0 et_pb_module et_pb_bg_layout_light" href="%1$s">%2$s</a>
      </div>',
      esc_url( $button_url ),
      '' !== $button_text ? esc_html( $button_text ) : esc_url( $button_url )
    );
    echo $output;
    echo '<br>';
    // link
    echo '<a href="' . $instance['url'] . '">' . $instance['text'] . '</a>';
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Novo Titúlo', 'makepressure' );
    $url = ! empty( $instance['url'] ) ? $instance['url'] : __( 'Url da página de Pressão', 'makepressure' );
    $text = ! empty( $instance['text'] ) ? $instance['text'] : __( 'Texto para o link da URL', 'makepressure' );
    $button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : __( 'Texto do botão de Super Pressão', 'makepressure' );
    ?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( __('Titúlo','makepressure') . ':' ) ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php _e( esc_attr( __('URL de Pressão','makepressure') . ':' ) ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( esc_attr( __('Texto para o link da URL','makepressure') . ':' ) ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>">
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><?php _e( esc_attr( __('Texto do botão de Super Pressão','makepressure') . ':' ) ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>">
    </p>
    <?php 
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
    $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
    $instance['button_text'] = ( ! empty( $new_instance['button_text'] ) ) ? strip_tags( $new_instance['button_text'] ) : '';

    return $instance;
  }

} // class Widget de Pressão
