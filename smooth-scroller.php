<?php
/*
 Plugin Name:   Smooth Scroller
 Plugin URI:    https://alephmedia.my
 Description:   Smooth scroller by Aleph Media.
 Author:        Aleph Media
 Author URI:    https://alephmedia.my
 Version:       0.1
 Update URI:    false
*/

add_filter(
  'pre_set_site_transient_update_plugins', 
  function($transient) {
    if (empty($transient->checked)) {
      return $transient;
    }

    // config
    $slug      = 'smooth-scroller';
    $current   = $transient->checked[ plugin_basename(__FILE__) ];
    $repo_owner= 'alandloh';
    $repo_name = 'smooth-scroller';
    $api_url   = "https://api.github.com/repos/{$repo_owner}/{$repo_name}/releases/latest";

    // fetch latest release
    $response = wp_remote_get($api_url, [
      'headers' => ['Accept' => 'application/vnd.github.v3+json']
    ]);
    if (is_wp_error($response)) {
      return $transient;
    }

    $data = json_decode(wp_remote_retrieve_body($response));
    if (version_compare($data->tag_name, $current, '>')) {
      // prepare the update
      $plugin_slug = plugin_basename(__FILE__);
      $transient->response[ $plugin_slug ] = (object) [
        'slug'        => $slug,
        'new_version' => $data->tag_name,
        'url'         => $data->html_url,
        'package'     => $data->zipball_url, // GitHub auto-generated ZIP
        'tested'      => '6.4.0',
      ];
    }

    return $transient;
  },
  5,
  1
);
