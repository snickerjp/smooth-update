<?php
///////////////////////////////////////////////////
//クラシックテキストウイジェットの追加
///////////////////////////////////////////////////
class SimplicityClassicTextWidget extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 'classname' => 'classic-textwidget', 'description' => __( 'テキストエディターのみの旧タイプのテキストウィジェット（Wordpress4.8以前のビジュアルエディターのないテキストウィジェット）。', 'smooth-update' ) );
        $control_ops = array( 'width' => 400, 'height' => 350 );
        parent::__construct( 'SimplicityClassicTextWidget', __( '[S] クラシックテキスト', 'smooth-update' ), $widget_ops, $control_ops );
    }

    public function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

			$text = apply_filters( 'widget_classic_text', $widget_text, $instance, $this );

			echo $args['before_widget'];
			if ( ! empty( $title ) ) :
				echo $args['before_title'] . $title . $args['after_title'];
			endif; ?>
				<div class="classic-text-widget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
			<?php
			echo $args['after_widget'];
    }

    //アップデート処理
    public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );

			if ( current_user_can( 'unfiltered_html' ) ){
				$instance['text'] = $new_instance['text'];
			} else {
				$instance['text'] = wp_kses_post( $new_instance['text'] );
			}

			$instance['filter'] = ! empty( $new_instance['filter'] );

			return $instance;
    }
    //ウィジェット画面の入力フォーム
    public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
			$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
			$title = sanitize_text_field( $instance['title'] );
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'タイトル：', 'smooth-update' ) ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( '内容：', 'smooth-update' ) ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

			<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e( '自動的に段落を追加する', 'smooth-update' ) ?></label></p>
			<?php

    }
}
//add_action('widgets_init', create_function('', 'return register_widget("SimplicityClassicTextWidget");'));
add_action('widgets_init', function(){register_widget('SimplicityClassicTextWidget' );});

