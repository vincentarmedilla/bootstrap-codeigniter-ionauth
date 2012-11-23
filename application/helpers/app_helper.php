<?php

function xdebug($r)
{
    echo '<pre>' . print_r($r, true) . '</pre>';
}

function timeAgo($timestamp)
{
    $difference = time() - $timestamp;
    $periods = array("sec", "min", "hour", "day", "week",
        "month", "years", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    if ($difference > 0)
    { // this was in the past
        $ending = "ago";
    }
    else
    { // this was in the future
        $difference = -$difference;
        $ending = "to go";
    }
    for ($j = 0; $difference >= $lengths[$j]; $j++)
        $difference /= $lengths[$j];
    $difference = round($difference);
    if ($difference != 1)
        $periods[$j].= "s";
    $text = "$difference $periods[$j] $ending";
    return $text;
}

function create_pagination($segment, $total, $limit, $uri_segment)
{
    $CI = & get_instance();
    $CI->load->library('pagination');
    $config['full_tag_open'] = '';
    $config['full_tag_close'] = '';
    $config['first_link'] = 'First';
    $config['first_tag_open'] = '';
    $config['first_tag_close'] = '';
    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '';
    $config['last_tag_close'] = '';
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '';
    $config['next_tag_close'] = '';
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '';
    $config['prev_tag_close'] = '';
    $config['cur_tag_open'] = '<a class="current" href="' . current_url() . '">';
    $config['cur_tag_close'] = '</a>';
    $config['num_tag_open'] = '';
    $config['num_tag_close'] = '';
    $config['base_url'] = site_url($segment);
    $config['total_rows'] = $total;
    $config['per_page'] = $limit;
    $config['uri_segment'] = $uri_segment;
    $config['display_pages'] = TRUE;

    $CI->pagination->initialize($config);
    return $CI->pagination->create_links();
}

function navbar_link($check)
{
    $CI = & get_instance();
    $uri = $CI->uri->segment(1,'dashboard');
    if ($check == $uri)
    {
        return 'select';
    }
    else
    {
        return '';
    }
}