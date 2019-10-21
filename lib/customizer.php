<?php
//ヘッダーの高さを取得
function get_header_height(){
  return get_theme_mod( 'header_height', 100 );
}

//サイドバーの幅を336pxにするかどうか
function is_sidebar_width_336(){
  return get_theme_mod( 'sidebar_width_336', false );
}

//FacebookフォローボタンのIDを取得
function get_facebook_follow_id(){
  return get_theme_mod( 'facebook_follow_id', null );
}

//PCトップをカスタムサイズ広告にするか
function is_ads_custum_ad_space(){
  return get_theme_mod( 'custum_ad_space', false );
}