<?php
/*
   Plugin Name: Bota Pressão
   Plugin URI: http://redelivre.org.br
   Description: Plugin for manager and pressure a Public Agents
   Author: Maurilio Atila
   Version: 0.1
   Author URI: https://twitter.com/cabelotaina
 */

defined('ABSPATH') or die('No script kiddies please!');
define( 'MAKE_PRESSURE_PATH', plugin_dir_path( __FILE__ ) );

add_action('init', 'create_public_agent');
function create_public_agent()
{
 $labels = array(
    'name'               => esc_html__( 'Agente Público', 'et_builder' ),
    'singular_name'      => esc_html__( 'Agente Público', 'et_builder' ),
    'add_new'            => esc_html__( 'Adicionar Novo', 'et_builder' ),
    'add_new_item'       => esc_html__( 'Adicionar Novo Agente Público', 'et_builder' ),
    'edit_item'          => esc_html__( 'Editar Agente Público', 'et_builder' ),
    'new_item'           => esc_html__( 'Novo Agente Público', 'et_builder' ),
    'all_items'          => esc_html__( 'Todos os Agentes Públicos', 'et_builder' ),
    'view_item'          => esc_html__( 'Visualizar Agente Público', 'et_builder' ),
    'search_items'       => esc_html__( 'Buscar Agente Público', 'et_builder' ),
    'not_found'          => esc_html__( 'Nada Encontrado', 'et_builder' ),
    'not_found_in_trash' => esc_html__( 'Nada encontrado na Lixeira', 'et_builder' ),
    'parent_item_colon'  => '',
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'can_export'         => true,
    'show_in_nav_menus'  => true,
    'query_var'          => true,
    'has_archive'        => true,
    'rewrite'            => apply_filters( 'et_public_agent_posttype_rewrite_args', array(
      'feeds'            => true,
      'slug'             => 'public_agent',
      'with_front'       => false,
    ) ),
    'capability_type'    => 'post',
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'author', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields' ),
    'taxonomies'         => array( 'category' ),
    'menu_icon'          =>  'dashicons-businessman',
  );

  register_post_type( 'public_agent', apply_filters( 'et_public_agent_posttype_args', $args ) );


        $labels = array(
                'name'              => esc_html__( 'Tags de Agente Público', 'et_builder' ),
                'singular_name'     => esc_html__( 'Tag de Agente Público', 'et_builder' ),
                'search_items'      => esc_html__( 'Buscar Tags', 'et_builder' ),
                'all_items'         => esc_html__( 'Todas as Tags', 'et_builder' ),
                'parent_item'       => esc_html__( 'Tag Pai', 'et_builder' ),
                'parent_item_colon' => esc_html__( 'Tag Pai:', 'et_builder' ),
                'edit_item'         => esc_html__( 'Editar Tag', 'et_builder' ),
                'update_item'       => esc_html__( 'Atualizar Tag', 'et_builder' ),
                'add_new_item'      => esc_html__( 'Adicionar Nova Tag', 'et_builder' ),
                'new_item_name'     => esc_html__( 'Novo nome de Tag', 'et_builder' ),
                'menu_name'         => esc_html__( 'Tags', 'et_builder' ),
        );

        register_taxonomy( 'public_agent_tag', array( 'public_agent' ), array(
                'hierarchical'      => false,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
        ) );
}


function public_agent_get_metas()
{
  $metas = array();

  if ( get_option('makepressure_email_show') ) {
    $metas[] = array ( 'label' => 'Email', 'slug'=>'public_agent_email' ,'info' => __('Nenhum Email Informado ', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' ));
  }

  if ( get_option('makepressure_facebook_show') ) {
    $metas[] = array ( 'label' => 'Facebook', 'slug'=>'public_agent_facebook' ,'info' => __('Nenhum Facebook Informado', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' ));
  }

  if ( get_option('makepressure_whatsapp_show') ) {
    $metas[] = array ( 'label' => 'WhatsApp', 'slug'=>'public_agent_whatsapp' ,'info' => __('Nenhum WhatsApp Informado', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' ));
  }

  if ( get_option('makepressure_twitter_show') ) {
    $metas[] = array ( 'label' => 'Twitter', 'slug'=>'public_agent_twitter' ,'info' => __('Nenhum Twitter Informado', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' ));
  }
  
  if ( get_option('makepressure_phone_show') ) {
    $metas[] = array ( 'label' => 'Telefone', 'slug'=>'public_agent_phone' ,'info' => __('Nenhum Telefone Informado', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' ));
  }

  $metas[] = array ( 'label' => __('Estado','makepressure'), 'slug'=>'public_agent_state' ,'info' =>  __('Nenhum Estado Informado', 'makepressure'), 'html' => array ('tag'=> 'select', 'options' => array(
      array ( 'value' => '' , 'content' => 'Selecione' ),
      array ( 'value' => 'AC' , 'content' => 'Acre' ),
      array ( 'value' => 'AL' , 'content' => 'Alagoas' ),
      array ( 'value' => 'AP' , 'content' => 'Amapa' ),
      array ( 'value' => 'AM' , 'content' => 'Amazonas' ),
      array ( 'value' => 'BA' , 'content' => 'Bahia' ),
      array ( 'value' => 'CE' , 'content' => 'Ceara' ),
      array ( 'value' => 'DF' , 'content' => 'Distrito Federal' ),
      array ( 'value' => 'ES' , 'content' => 'Espirito Santo' ),
      array ( 'value' => 'GO' , 'content' => 'Goias' ),
      array ( 'value' => 'MA' , 'content' => 'Maranhao' ),
      array ( 'value' => 'MS' , 'content' => 'Mato Grosso do Sul' ),
      array ( 'value' => 'MT' , 'content' => 'Mato Grosso' ),
      array ( 'value' => 'MG' , 'content' => 'Minas Gerais' ),
      array ( 'value' => 'PA' , 'content' => 'Para' ),
      array ( 'value' => 'PB' , 'content' => 'Paraiba' ),
      array ( 'value' => 'PR' , 'content' => 'Parana' ),
      array ( 'value' => 'PE' , 'content' => 'Pernambuco' ),
      array ( 'value' => 'PI' , 'content' => 'Piaui' ),
      array ( 'value' => 'RJ' , 'content' => 'Rio de Janeiro' ),
      array ( 'value' => 'RN' , 'content' => 'Rio Grande do Norte' ),
      array ( 'value' => 'RS' , 'content' => 'Rio Grande do Sul' ),
      array ( 'value' => 'RO' , 'content' => 'Rondonia' ),
      array ( 'value' => 'RR' , 'content' => 'Roraima' ),
      array ( 'value' => 'SC' , 'content' => 'Santa Catarina' ),
      array ( 'value' => 'SP' , 'content' => 'Sao Paulo' ),
      array ( 'value' => 'SE' , 'content' => 'Sergipe' ),
      array ( 'value' => 'TO' , 'content' => 'Tocantins' )
      )
    )
  );

  $metas[] = array ( 'label' => __('Partido', 'makepressure'), 'slug'=>'public_agent_partido' ,'info' =>  __('Nenhum Partido Informado', 'makepressure'), 'html' => array ('tag'=> 'select', 'options' => get_option('public_agents_partidos_array')));
  
  $metas[] = array ( 'label' => __('Cargo Politico', 'makepressure'), 'slug'=>'public_agent_cargo' ,'info' =>  __('Nenhum Cargo Informado', 'makepressure'), 'html' => array ('tag'=> 'select', 'options' => array(
                    array ( 'value' => '' , 'content' => __('Selecione','makepressure') ),
                    array ( 'value' => 'presidente', 'content' => __('Presidentx', 'makepressure') ) ,
                    array ( 'value' => 'vice_presidente', 'content' => __('Vice-Presidentx', 'makepressure' ) ) ,
                    array ( 'value' => 'Ministro', 'content' => __('Ministrx','makepressure') ) ,
                    array ( 'value' => 'secretario_federal', 'content' => __('Secretarix Federal','makepressure') ) ,
                    array ( 'value' => 'deputado_federal', 'content' => __('Deputadx Federal', 'makepressure') ) ,
                    array ( 'value' => 'senador', 'content' => __('Senadorx','makepressure') ) ,
                    array ( 'value' => 'governador', 'content' => __('Governadorx','makepressure') ) ,
                    array ( 'value' => 'vice_governador', 'content' => __( 'Vice-Governadorx', 'makepressure') ) ,
                    array ( 'value' => 'deputado_estadual', 'content' => __('Deputadx Estadual', 'makepressure') ) ,
                    array ( 'value' => 'secretario_estadual', 'content' => __('Secretarix Estadual','makepressure') ) ,
                    array ( 'value' => 'prefeito', 'content' => __('Prefeitx', 'makepressure') ), 
                    array ( 'value' => 'vice_prefeito', 'content' => __('Vice-Prefeitx', 'makepressure') ), 
                    array ( 'value' => 'vereador', 'content' => __('Vereadorx', 'makepressure') ) ,
                    array ( 'value' => 'secretario_municipal', 'content' => __('Secretarix Municipal','makepressure') ) ,
                  )
                )
            );
  $metas[] = array ( 'label' => 'Gênero', 'slug'=>'public_agent_genero' ,'info' =>  __('Nenhuma gênero Informado', 'makepressure'), 'html' => array ('tag'=> 'select', 'options' => array(
                    array ( 'value' => '' , 'content' => 'Selecione' ),
                    array ( 'value' => 'Feminino' , 'content' => __('Feminino', 'makepressure') ),
                    array ( 'value' => 'Masculino' , 'content' => __('Masculino', 'makepressure') ))));
            //array ( 'label' => __('Declaração de voto', 'makepressure'), 'slug'=>'public_agent_declaracao_voto' ,'info' => __('Nenhuma Declaração de voto Informada ', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' )),
            //array ( 'label' => __('Ocorrências Judiciais', 'makepressure'), 'slug'=>'public_agent_ocorrencias' ,'info' => __('Nenhuma Ocorrencia Judicial Informada ', 'makepressure'), 'html' => array ('tag'=> 'textarea', 'rows' => 4 , 'cols' => 50 ) ),
            //array ( 'label' => __('Número de ocorrências', 'makepressure'), 'slug'=>'public_agent_numero_ocorrencias' ,'info' => __('Nenhum Número de Ocorrências Informado ', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' )),
            /*array ( 'label' => __('Tipo de Voto', 'makepressure'), 'slug'=>'public_agent_tipo_voto' ,'info' =>  __('Nenhum Tipo de Voto Informado', 'makepressure'), 'html' => array ('tag'=> 'select', 'options' => array(
                    array ( 'value' => '' , 'content' => __('Selecione', 'makepressure') ),
                    array ( 'value' => 'Sim' , 'content' => __('Sim', 'makepressure') ),
                    array ( 'value' => 'Indeciso' , 'content' => __('Indeciso', 'makepressure') ),
                    array ( 'value' => 'Não' , 'content' => 'Não', __('makepressure') )))),
            */
            //array ( 'label' => __('Bancada que compões', 'makepressure'), 'slug'=>'public_agent_bancada' ,'info' => __('Nenhuma Bancada Informada ', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' )),
            //array ( 'label' => __('Profissão', 'makepressure'), 'slug'=>'public_agent_profissao' ,'info' => __('Nenhuma Profissão Informada ', 'makepressure') , 'html' => array ('tag'=> 'input', 'type' => 'text' )),
  return $metas;


}

function get_jobs()
{
  return array (
      array ( 'presidente' => __('Presidentx', 'makepressure') ) ,
      array ( 'vice_presidente' => __('Vice-Presidentx', 'makepressure') ) ,
      array ( 'ministro' => __('Ministrx' , 'makepressure') ) ,
      array ( 'secretario_federal' => __('Secretarix Federal' ) ),
      array ( 'deputado_federal' => __('Deputadx Federal', 'makepressure') ) ,
      array ( 'senador' => __('Senadorx', 'makepressure') ) ,

      array ( 'governador' => __('Governador', 'makepressure') ) ,
      array ( 'vice_governador' => __('Vice-Governador', 'makepressure') ) ,
      array ( 'secretario_estadual' => __('Secretarix Estadual' ) ),
      array ( 'deputado_estadual' => __('Deputado Estadual', 'makepressure') ) ,
      
      array ( 'prefeito' => __('Prefeito', 'makepressure') ), 
      array ( 'vice_prefeito' => __('Vice-Prefeito', 'makepressure') ), 
      array ( 'vereador' => __('Vereador', 'makepressure') ) ,
      array ( 'secretario_municipal' => __('Secretarix Municipal' ) ) ,
  );

}

function public_agent_the_meta($content)
{
  if (get_post_type() != "public_agent") return $content;

  $email = get_post_meta(  get_the_ID(), "public_agent_email", true);
  $cargo = get_post_meta(  get_the_ID(), "public_agent_cargo", true);
  $cargo_valid = isset($cargo) ? get_post_meta(  get_the_ID(), 'public_agent_cargo', true) : "";
  $space = '%20';

  if ( get_post_meta(  get_the_ID(), 'public_agent_email', true) ) : 
    $new_content =  '<a style="margin:30px" href="mailto:';
    $new_content .= $email;
    $new_content .= '?subject=Excelentissimo'.$space;
    $new_content .= $cargo_valid;
    $new_content .= $space;
    $new_content .= get_the_title(); 
    $new_content .= '&body=Excelentissimo' .$space;
    $new_content .= $cargo_valid . $space;
    $new_content .= get_the_title();
    $new_content .= ',%20..."><span style="font-size:38px" class="dashicons dashicons-email"></span></a>';
  endif;

  $twitter = get_post_meta(  get_the_ID(), 'public_agent_twitter', true);
  
  if ( get_post_meta(  get_the_ID(), 'public_agent_twitter', true) ) :
    $new_content .= '<a style="margin:30px" href="https://twitter.com/intent/tweet?text=@';
    $new_content .= $twitter;
    $new_content .= '%20por%20favor%20defenda%20a%20exist%C3%AAncia%20do%20MCTI,%20fundamental%20para%20o%20desenvolvimento%20do%20Brasil%20&url=http%3A//goo.gl/Sc9aen&hashtags=FicaMCTI" class="twitter-mention-button" data-show-count="false"><span style="font-size:35px" class="dashicons dashicons-twitter"></span></a>';
  endif;

  $facebook = get_post_meta(  get_the_ID(), 'public_agent_facebook', true);

  if ( get_post_meta(  get_the_ID(), 'public_agent_facebook', true) ) : 
    $new_content .= '<a style="margin:30px" target="_brank" href="';
    $new_content .= $facebook;
    $new_content .= '"><span style="font-size:35px" class="dashicons dashicons-facebook"></span></a>';
  endif;

  $phone = get_post_meta(  get_the_ID(), 'public_agent_phone', true);

  if ( get_post_meta(  get_the_ID(), 'public_agent_phone', true) ) : 
    $new_content .= '<a style="margin:30px" target="_brank" href="tel:';
    $new_content .= $phone;
    $new_content .= '"><span style="font-size:35px;">';
    $new_content .= $phone;
    $new_content .= '</span><span style="font-size:35px;margin:10px;top:-10px;postition:relative" class="dashicons dashicons-phone"></span>';
    $new_content .= '</a>';
  endif;

    $job = get_jobs();
    $new_content .= '<br><br><br>';
    $metas = public_agent_get_metas();
    foreach($metas as $meta)
    {
      if (  $meta['slug'] == 'public_agent_email' ) continue;
      if (  $meta['slug'] == 'public_agent_facebook' ) continue;
      if (  $meta['slug'] == 'public_agent_twitter' ) continue;
      //if (  $meta['slug'] == 'public_agent_whatsapp' ) continue;
      if (  $meta['slug'] == 'public_agent_phone' ) continue;

      $new_content .= '<li><span class="post-meta-key">';
      $new_content .= $meta['label'];
      $new_content .= ': </span>';
      $new_content .= get_post_meta( get_the_ID(), $meta['slug'] , true);

    }
    $new_content .= '</ul>';

    return $content . $new_content;
}

add_filter("the_content", "public_agent_the_meta");

function public_agent_change_post_placeholder($title)
{
  $screen = get_current_screen();
  if ('public_agent' == $screen->post_type) {
    $title = __('Insira o nome do Agente Público', 'makepressure');
  }
  return $title;
}

add_filter('enter_title_here', 'public_agent_change_post_placeholder');

add_action('pre_get_posts', 'add_public_agent_to_query');

function add_public_agent_to_query($query)
{
  if (is_home() && $query->is_main_query())
    $query->set('post_type', array('post', 'page', 'public_agent'));
  return $query;
}

add_action('admin_menu', 'public_agent_meta_box');

function public_agent_meta_box()
{
  add_meta_box('public_agent-meta-box', __('Informações Complementares', 'makepressure'), 'display_public_agent_meta_box', 'public_agent', 'normal', 'high');

}

function display_public_agent_meta_box($object, $box)
{ 
  $metas = public_agent_get_metas();
  foreach($metas as $meta)
  {

    if ($meta['html']['tag'] == 'select')
    {
      ?>
        <p>
        <label for="<?php echo $meta['slug'] ?>"><?php echo $meta['label'] ?>:</label>
        <br>
        <select name="<?php echo $meta['slug'] ?>">
        <?php
        setlocale(LC_ALL, "en_US.utf8");
      foreach ($meta['html']['options'] as $option) {
        $content = iconv("utf-8", "ascii//TRANSLIT", $option['content']);
        ?>
          <option value="<?php echo $option['value'] ?>" <?php echo esc_html(get_post_meta($object->ID, $meta['slug'] , true), 1) === $option['value'] ? 'selected' : ''; ?> ><?php echo ucwords(strtolower($content)) ?></option>
          <?php
      }
      ?>
        </select>
        </p>
        <?php

    }
    else if ( $meta['html']['tag'] == 'input' )
    {
      ?>
        <p>
          <label for="<?php echo $meta['slug'] ?>"><?php echo $meta['label'] ?></label>
          <br>
         <input type="<?php echo $meta['html']['type'] ?>" name="<?php echo $meta['slug'] ?>" 
           id="<?php echo $meta['slug'] ?>" style="width:50%"
           value="<?php echo get_post_meta($object->ID, $meta['slug'] , true); ?>">
          </p>
        <?php
    }
    else if ( $meta['html']['tag'] == 'textarea' )
    {
      ?>
        <p>
        <label for="<?php echo $meta['slug'] ?>"><?php echo $meta['label'] ?></label>
        <br/>
        <textarea name="<?php echo $meta['slug'] ?>" rows="<?php echo $meta['html']['rows']; ?>" cols="<?php echo $meta['html']['cols']; ?>" id="<?php echo $meta['slug'] ?>" style="width:50%" ><?php echo esc_html(get_post_meta($object->ID, $meta['slug'] , true), 1); ?></textarea>
        </p>
        <?php
    }
  } 
?>
    <input type="hidden" name="makepressure_meta_box_nonce" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>"/>
<?php }

add_action('save_post', 'save_public_agent_meta_box', 10, 2);
function save_public_agent_meta_box($post_id, $post)
{
  if (!current_user_can('edit_post', $post_id))
    return;

  $metas = public_agent_get_metas();
  foreach ( $metas as $meta)
  {
    if (isset($_POST[$meta['slug']])) {
      $meta_striped = stripslashes($_POST[$meta['slug']]);

      if ($meta_striped && '' == get_post_meta($post_id, $meta['slug'], true))
        add_post_meta($post_id, $meta['slug'], $meta_striped, true);

      elseif ($meta_striped != get_post_meta($post_id, $meta['slug'], true))
        update_post_meta($post_id, $meta['slug'], $meta_striped);

      elseif ('' == $meta_striped && get_post_meta($post_id, $meta['slug'], true))
        delete_post_meta($post_id, $meta['slug'], get_post_meta($post_id, $meta['slug'], true));
    }
  }
}

//insert collumns on administration Public Agents page

add_filter('manage_public_agent_posts_columns', 'public_agent_filter_columns');

function public_agent_filter_columns($columns)
{
  // this will add the column to the end of the array
  $metas = public_agent_get_metas();
  $i = 0;
  foreach ( $metas as $meta)
  {
    if ( $i === 5) break;
    $columns[$meta['slug']] = $meta['label'];
    $i++;
  }
  return $columns;
}

add_action('manage_posts_custom_column', 'public_agent_custom_columns', 10, 2);
function public_agent_custom_columns($column_id, $post_id)
{
  //run a switch statement for all of the custom columns created
  $metas = public_agent_get_metas();
  $i = 0;
  foreach ( $metas as $meta)
  {
    if ( $i === 5) break;
    if ( $column_id ==  $meta['slug'] )
      echo ($value = get_post_meta($post_id, $meta['slug'], true)) ? $value : $meta['info'];
    $i++;
  }
}

// pages and search system
function public_agent_rewrite_add_var( $vars ) {
  $vars[] = 'busca';
  return $vars;
}
add_filter( 'query_vars', 'public_agent_rewrite_add_var' );

// Create the rewrites
function public_agent_rewrite_rule() {
  add_rewrite_tag( '%busca%', '([^&]+)' );
  add_rewrite_rule(
      '^busca',
      'index.php?busca',
      'top'
      );
}
add_action('init','public_agent_rewrite_rule');

// Catch the URL and redirect it to a template file
function public_agent_rewrite_catch() {
  global $wp_query;
  if ( array_key_exists( 'busca', $wp_query->query_vars ) ) {
    include ( MAKE_PRESSURE_PATH . 'people_list.php');
    exit;
  }
}
add_action( 'template_redirect', 'public_agent_rewrite_catch' );

// Filter wp_nav_menu() to add additional links and other output
function public_agent_nav_menu_item($items) {
  $public_agents_link = '<li class="search_people"><a href="' . home_url( '/busca' ) . '">' . __('Busca' , 'public_agent') . '</a></li>';
  // add the home link to the end of the menu
  $items = $items . $public_agents_link;
  return $items;
}
add_filter( 'wp_nav_menu_items', 'public_agent_nav_menu_item' );


add_action('init','public_agents_menu');

function public_agents_menu()
{
  add_menu_page( __('Bota Pressão','makepressure'), __('Bota Pressão','makepressure'), 'manage_options', 'makepressure_menu', 'makepressure_settings', 'dashicons-megaphone', 100);
  //add_submenu_page( 'makepressure_menu', __('Configurações dos Agentes Públicos', 'makepressure'), __('Configurações dos Agentes Públicos', 'makepressure'), 'manage_options', 'public-agent-settings', 'public_agent_settings' );
}

function makepressure_settings()
{ 
  ?>
  <h1>Página de Configuração do Bota Pressão</h1>
  <form method="post" action="admin-post.php" >
  <input type="hidden" name="action" value="update_options">
  <!--div id="selecao_public_agents">
    <p>Qual o grupo instancia que deve ser precionado?</p>
    <textarea placeholder="Entre com a lista de identificadores dos Agentes Públicos" ></textarea>
  </div> 
  <div id="descricao">
    <input type="text" name="titulo_pressao" id="titulo_pressao" placeholder="Qual o titúlo da sua pressão?"></input>
    <br>
    <textarea name="descricao_pressao" id="descricao_pressao" placeholder="Descreva sua pressão"></textarea>
  </div>
  <div>
    redes e links e ...
  </div-->
  <div id="ferramentas">
    <p>Marque quais as ferramentas de pressão sobre cada agente público</p>
    <p>
      <input type="checkbox" id="email" name="email"  <?php echo get_option('makepressure_email_show') ? "checked":""; ?>/>
      <label>Email
    </p>
    <p>
      <input type="checkbox" id="facebook" name="facebook"  <?php echo get_option('makepressure_facebook_show') ? "checked":""; ?>/>
      <label>Facebook</label>
    </p>
    <p>
      <input type="checkbox" id="twitter" name="twitter" <?php echo get_option('makepressure_twitter_show') ? "checked":""; ?>/>
      <label>twitter</label>
    </p>
    <p>
      <input type="checkbox" id="whatsapp" name="whatsapp"  <?php echo get_option('makepressure_whatsapp_show') ? "checked":""; ?>/>
      <label>whatsapp</label>
    </p>
    <p>
      <input type="checkbox" id="phone" name="phone"  <?php echo get_option('makepressure_phone_show') ? "checked":""; ?>/>
      <label>Telefone</label>
    </p>
    <p>
      <label>Correio</label>
      <br>
      <p>
        <input type="checkbox" id="cartao_postal" name="cartao_postal"  <?php echo get_option('makepressure_correio_show') ? "checked":""; ?>/>
        </label>Cartão Postal</label>
      </p>
      <p>
        <input type="checkbox" id="cartao_postal" name="cartao_postal"  <?php echo get_option('makepressure_cartao_postal_show') ? "checked":""; ?>/>
        </label>Telegrama</label>
      </p>
      <p>
        </label>Encomenda</label>
        <p>
          <input type="checkbox" id="flores" name="flores"  <?php echo get_option('makepressure_flores_show') ? "checked":""; ?>/>
          </label>Flores</label>
        </p>
        <p>
          <input type="checkbox" id="carro_de_som" name="carro_de_som"  <?php echo get_option('makepressure_carro_de_som_show') ? "checked":""; ?>/>
          </label>Carro de Som</label>
        </p>
      </p>
    </p>
    <!-- TODO -->
    <p>
      <label>Inserir mensagem padrão para email:</label><br>
      <input type="text" placeholder="Adicionar titulo da mensagem"></input><br>
      <textarea placeholder="Adicionar o corpo da mensagem"></textarea><br>
      <textarea placeholder="Adicionar + email's na mensagem"></textarea><br>
    </p>
    <p>
      <label>Inserir mensagem padrão para o twitter:</label><br>
      <textarea placeholder="Adicionar o corpo da mensagem"></textarea><br>
      <input type="text" placeholder="Adicionar uma hashtag"></input><br>
    </p>
    <p>
  </div>

  <?php  
  submit_button("Salvar");
}

add_action( 'admin_post_update_options', 'public_agent_show_hide_fields' );
function public_agent_show_hide_fields() 
{
    update_option( "makepressure_email_show", $_POST["email"] == 'on'? "1" : '0' );
    update_option( "makepressure_facebook_show", $_POST["facebook"] == 'on'? "1" : '0' );
    update_option( "makepressure_twitter_show", $_POST["twitter"] == 'on'? "1" : '0' );
    update_option( "makepressure_whatsapp_show", $_POST["whatsapp"] == 'on'? "1" : '0' );
    update_option( "makepressure_phone_show", $_POST["phone"] == 'on'? "1" : '0' );

    wp_redirect( "admin.php?page=makepressure_menu" );
    exit;
}

function public_agent_settings() 
{

  if ( isset( $_POST['partidos'] ) )
  {
    $public_agents_partidos = array( array ( 'value' => '' , 'content' => __('Selecione', 'makepressure') ) );
    $duplas = explode( ',' , $_POST['partidos'] ) ;
    foreach( $duplas as $dupla)
    {
      $public_agents_partidos[] = array( 'value' => $dupla[0] , 'content' => $dupla[1]);
    }

    isset($_POST['partidos'])? update_option('public_agent_partidos' , $_POST['partidos']):"";
    isset($_POST['presidente'])? update_option('public_agent_presidente' , $_POST['presidente']):"";
    isset($_POST['vice_presidente'])? update_option('public_agent_vice_presidente' , $_POST['vice_presidente']):"";
    isset($_POST['ministro'])? update_option('public_agent_ministro' , $_POST['ministro']):"";
    isset($_POST['secretario_federal'])? update_option('public_agent_secretario_federal' , $_POST['secretario_federal']):"";
    isset($_POST['deputado_federal'])? update_option('public_agent_deputado_federal' , $_POST['deputado_federal']):"";
    isset($_POST['senador'])? update_option('public_agent_senador' , $_POST['senador']):"";
    isset($_POST['governador'])? update_option('public_agent_governador' , $_POST['governador']):"";
    isset($_POST['vice_governador'])? update_option('public_agent_vice_governador' , $_POST['vice_governador']):"";
    isset($_POST['deputado_estadual'])? update_option('public_agent_deputado_estadual' , $_POST['deputado_estadual']):"";
    isset($_POST['secretario_estadual'])? update_option('public_agent_secretario_estadual' , $_POST['secretario_estadual']):"";
    isset($_POST['prefeito'])? update_option('public_agent_prefeito' , $_POST['prefeito']):"";
    isset($_POST['vice_prefeito'])? update_option('public_agent_vice_prefeito' , $_POST['vice_prefeito']):"";
    isset($_POST['vereador'])? update_option('public_agent_vereador' , $_POST['vereador']):"";
    isset($_POST['secretario_municipal'])? update_option('public_agent_secretario_municipal' , $_POST['secretario_municipal']):"";

    

    update_option('public_agent_partidos_array' , $public_agents_partidos);
  }

  ?>
    <div class="wrap">
    <h2><?php _e('Configurações Politicos', 'makepressure'); ?></h2>
    <?php _e('Por favor insira abaixo os Partidos Politicos, da seguinte forma:' , 'makepressure'); ?>
    <br>
    <?php _e( 'sigla|nome do partido,
    sigla|nome do partido', 'makepressure'); ?>
      <br>
      <form method="post" >
      <textarea name="partidos" rows="20" cols="50" ><?php echo get_option('public_agent_partidos'); ?></textarea>
      <?php submit_button( __('Salvar', 'makepressure') ); ?>
      </form>
      </div>
      <div>

      <h4>definir novos campos para os public_agents</h4>
      <p><?php _e('Abaixo você pode definir campos novos aos vários public_agents, basta usar os shortcodes do bota pressão:', 'makepressure' ); ?>

      <p><?php _e('["nome do campo", "tipo do campo", "informações no placeholder"]', 'makepressure'); ?></p>

      <strong>tipos de campos disponiveis:</strong>
      <p>text</p>
      <p>email</p>
      <p>textarea</p>
      <p>    ["nome do campo", "tipo do campo", "informações no placeholder"]</p>
      <p>select<p>
      <p>    ["nome do campo", "tipo do campo", "informações no placeholder", options... ]</p>
      </p>
      <p><strong>Presidentx</strong></p>
      <form method="post">
      <textarea name="presidente" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_presidente'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      <p><strong>Vice Presidentx</strong></p>
      <form method="post">
      <textarea name="vice_presidente" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_vice_presidente'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Ministrx</strong></p>
      <form method="post">
      <textarea name="ministro" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_ministro'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Secretárix</strong></p>
      <form method="post">
      <textarea name="secretario" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_secretario'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Deputadx Federal</strong></p>
      <form method="post">
      <textarea name="deputado_federal" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_deputado_federal'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Senadorx</strong></p>
      <form method="post">
      <textarea name="senador" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_senador'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Governadorx</strong></p>
      <form method="post">
      <textarea name="governador" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_governador'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Deputadx Estadual</strong></p>
      <form method="post">
      <textarea name="deputado_estadual" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_deputado_estadual'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Prefeitx</strong></p>
      <form method="post">
      <textarea name="prefeito" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_prefeito'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Vice Prefeitx</strong></p>
      <form method="post">
      <textarea name="vice_prefeito" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_vice_prefeito'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>
      </form>
      <p><strong>Vereadorx</strong></p>
      <form method="post">
      <textarea name="vereador" rows="5" cols="50" placeholder="Coloque shortcodes para definir novos campos" ><?php echo get_option('fields_vereador'); ?></textarea>
      <?php submit_button( 'Salvar' ); ?>
      </form>

      </div>


    <?php
}

register_activation_hook( __FILE__, 'makepressure_activation' );
function makepressure_activation()
{
  // comissao

  $comissoes = "";

  // frente_parlamentar

  $frente_parlamentar = "";

  // bancada

  $bancadas_deputados_federais = "Bancada da Bala,
    Bancada da Bíblia";

  $bancadas_deputados_estatuais = "";

  $bancadas_vereadores = ""; 

  $public_agent_partidos = "PMDB|PARTIDO DO MOVIMENTO DEMOCRÁTICO BRASILEIRO,
    PTB|PARTIDO DO MOVIMENTO DEMOCRÁTICO BRASILEIRO,
    PDT|PARTIDO DEMOCRÁTICO TRABALHISTA,
    PT|PARTIDO DOS TRABALHADORES,
    DEM|DEMOCRATAS,
    PCdoB|PARTIDO COMUNISTA DO BRASIL,
    PSB|PARTIDO SOCIALISTA BRASILEIRO,
    PSDB|PARTIDO DA SOCIAL DEMOCRACIA BRASILEIRA,
    PTC|PARTIDO TRABALHISTA CRISTÃO,
    PSC|PARTIDO SOCIAL CRISTÃO,
    PMN|PARTIDO DA MOBILIZAÇÃO NACIONAL,
    PRP|PARTIDO REPUBLICANO PROGRESSISTA,
    PPS|PARTIDO POPULAR SOCIALISTA,
    PV|PARTIDO VERDE,
    PTdoB|PARTIDO TRABALHISTA DO BRASIL,
    PP|PARTIDO PROGRESSISTA,
    PSTU|PARTIDO SOCIALISTA DOS TRABALHADORES UNIFICADO,
    PCB|PARTIDO COMUNISTA BRASILEIRO,
    PRTB|PARTIDO RENOVADOR TRABALHISTA BRASILEIRO,
    PHS|PARTIDO HUMANISTA DA SOLIDARIEDADE,
    PSDC|PARTIDO SOCIAL DEMOCRATA CRISTÃO,
    PCO|PARTIDO DA CAUSA OPERÁRIA,
    PTN|PARTIDO TRABALHISTA NACIONAL,
    PSL|PARTIDO SOCIAL LIBERAL,
    PRB|PARTIDO REPUBLICANO BRASILEIRO,
    PSOL|PARTIDO SOCIALISMO E LIBERDADE,
    PR|PARTIDO DA REPÚBLICA,
    PSD|PARTIDO SOCIAL DEMOCRÁTICO,
    PPL|PARTIDO PÁTRIA LIVRE,
    PEN|PARTIDO ECOLÓGICO NACIONAL,
    PROS|PARTIDO REPUBLICANO DA ORDEM SOCIAL,
    SD|SOLIDARIEDADE,
    NOVO|PARTIDO NOVO,
    REDE|REDE SUSTENTABILIDADE,
    PMB|PARTIDO DA MULHER BRASILEIRA";

  $public_agent_partidos_array = array( 
      array ( 'value' => '' , 'content' => 'Selecione' ),
      array ( 'value' => 'PMDB' , 'content' => 'PARTIDO DO MOVIMENTO DEMOCRÁTICO BRASILEIRO' ) ,
      array ( 'value' => 'PTB' , 'content' => 'PARTIDO DO MOVIMENTO DEMOCRÁTICO BRASILEIRO' ) ,
      array ( 'value' => 'PDT' , 'content' => 'PARTIDO DEMOCRÁTICO TRABALHISTA' ) ,
      array ( 'value' => 'PT' , 'content' => 'PARTIDO DOS TRABALHADORES' ) ,
      array ( 'value' => 'DEM' , 'content' => 'DEMOCRATAS' ) ,
      array ( 'value' => 'PCdoB' , 'content' => 'PARTIDO COMUNISTA DO BRASIL' ) ,
      array ( 'value' => 'PSB' , 'content' => 'PARTIDO SOCIALISTA BRASILEIRO' ) ,
      array ( 'value' => 'PSDB' , 'content' => 'PARTIDO DA SOCIAL DEMOCRACIA BRASILEIRA' ) ,
      array ( 'value' => 'PTC' , 'content' => 'PARTIDO TRABALHISTA CRISTÃO' ) ,
      array ( 'value' => 'PSC' , 'content' => 'PARTIDO SOCIAL CRISTÃO' ) ,
      array ( 'value' => 'PMN' , 'content' => 'PARTIDO DA MOBILIZAÇÃO NACIONAL' ) ,
      array ( 'value' => 'PRP' , 'content' => 'PARTIDO REPUBLICANO PROGRESSISTA' ) ,
      array ( 'value' => 'PPS' , 'content' => 'PARTIDO POPULAR SOCIALISTA' ) ,
      array ( 'value' => 'PV' , 'content' => 'PARTIDO VERDE' ) ,
      array ( 'value' => 'PTdoB' , 'content' => 'PARTIDO TRABALHISTA DO BRASIL' ) ,
      array ( 'value' => 'PP' , 'content' => 'PARTIDO PROGRESSISTA' ) ,
      array ( 'value' => 'PSTU' , 'content' => 'PARTIDO SOCIALISTA DOS TRABALHADORES UNIFICADO' ) ,
      array ( 'value' => 'PCB' , 'content' => 'PARTIDO COMUNISTA BRASILEIRO' ) ,
      array ( 'value' => 'PRTB' , 'content' => 'PARTIDO RENOVADOR TRABALHISTA BRASILEIRO' ) ,
      array ( 'value' => 'PHS' , 'content' => 'PARTIDO HUMANISTA DA SOLIDARIEDADE' ) ,
      array ( 'value' => 'PSDC' , 'content' => 'PARTIDO SOCIAL DEMOCRATA CRISTÃO' ) ,
      array ( 'value' => 'PCO' , 'content' => 'PARTIDO DA CAUSA OPERÁRIA' ) ,
      array ( 'value' => 'PTN' , 'content' => 'PARTIDO TRABALHISTA NACIONAL' ) ,
      array ( 'value' => 'PSL' , 'content' => 'PARTIDO SOCIAL LIBERAL' ) ,
      array ( 'value' => 'PRB' , 'content' => 'PARTIDO REPUBLICANO BRASILEIRO' ) ,
      array ( 'value' => 'PSOL' , 'content' => 'PARTIDO SOCIALISMO E LIBERDADE' ) ,
      array ( 'value' => 'PR' , 'content' => 'PARTIDO DA REPÚBLICA' ) ,
      array ( 'value' => 'PSD' , 'content' => 'PARTIDO SOCIAL DEMOCRÁTICO' ) ,
      array ( 'value' => 'PPL' , 'content' => 'PARTIDO PÁTRIA LIVRE' ) ,
      array ( 'value' => 'PEN' , 'content' => 'PARTIDO ECOLÓGICO NACIONAL' ) ,
      array ( 'value' => 'PROS' , 'content' => 'PARTIDO REPUBLICANO DA ORDEM SOCIAL' ) ,
      array ( 'value' => 'SD' , 'content' => 'SOLIDARIEDADE' ) ,
      array ( 'value' => 'NOVO' , 'content' => 'PARTIDO NOVO' ) ,
      array ( 'value' => 'REDE' , 'content' => 'REDE SUSTENTABILIDADE' ) ,
      array ( 'value' => 'PMB' , 'content' => 'PARTIDO DA MULHER BRASILEIRA' )
    );


  update_option('public_agent_partidos' , $public_agent_partidos );
  update_option('public_agent_partidos_array' , $public_agent_partidos_array );
  update_option( "makepressure_email_show", '1' );
  update_option( "makepressure_facebook_show", '1' );
  update_option( "makepressure_twitter_show", '1' );
  update_option( "makepressure_whatsapp_show", '1' );
  update_option( "makepressure_phone_show", '1' );

}

require_once dirname(__FILE__)."/options.php"; 

?>