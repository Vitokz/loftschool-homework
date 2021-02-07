<?php
/** no direct access **/
defined('MECEXEC') or die();

use Elementor\Plugin;
if(!did_action('elementor/loaded')) return;

$styling = $this->main->get_styling();
$event_colorskin = (isset($styling['mec_colorskin'] ) || isset($styling['color'])) ? 'colorskin-custom' : '';
$settings = $this->main->get_settings();
$current_month_divider = $this->request->getVar('current_month_divider', 0);

// colorful
$colorful_flag = $colorful_class = '';
if($this->style == 'colorful')
{
	$colorful_flag = true;
	$this->style = 'modern';
	$colorful_class = ' mec-event-custom-colorful';
}
?>
<div class="mec-wrap <?php echo $event_colorskin . $colorful_class; ?>">
    <div class="mec-event-custom-<?php echo $this->style; ?>">       
        
            <?php 
            $count = $this->count;

            if($count == 0 or $count == 5) $col = 4;
            else $col = 12 / $count;

            $rcount = 1 ;

            // if($this->show_only_expired_events)
            // {
            //     $start = $this->start_date;
            //     $end = date('Y-m-01', strtotime('-10 Year', strtotime($start)));
            // }
            // else
            // {
            //     $start = $this->start_date;
            //     $end = date('Y-m-t', strtotime('+10 Year', strtotime($start)));
            // }

            if($this->show_only_expired_events)
            {
                $apply_sf_date = $this->request->getVar('apply_sf_date', 1);
                $start = ((isset($this->sf) || $this->request->getVar('sf', array())) and $apply_sf_date) ? date('Y-m-t', strtotime($this->start_date)) : $this->start_date;

                $end = date('Y-m-01', strtotime('-15 Years', strtotime($start)));
            }
            else
            {
                $start = $this->start_date;
                $end = date('Y-m-t', strtotime('+15 Years', strtotime($start)));
            }

            // Date Events
            $dates = $this->period($start, $end, true);

            // Limit
            $this->args['posts_per_page'] = 1000;

            $i = 0;
            $found = 0;
            $events = array();
            $current_month_divider = $this->request->getVar('current_month_divider', 0);
            foreach($dates as $date=>$IDs)
            {
                // No Event
                if(!is_array($IDs) or (is_array($IDs) and !count($IDs))) continue;

                // Check Finish Date
                if(isset($this->maximum_date) and strtotime($date) > strtotime($this->maximum_date)) break;

                // Include Available Events
                $this->args['post__in'] = $IDs;

                // Count of events per day
                $IDs_count = array_count_values($IDs);

                // Extending the end date
                $this->end_date = $date;

                // Continue to load rest of events in the first date
                if($i === 0) $this->args['offset'] = $this->offset;
                // Load all events in the rest of dates
                else 
                {
                    $this->offset = 0;
                    $this->args['offset'] = 0;
                }


                if (($this->multiple_days_method == 'first_day' or ($this->multiple_days_method == 'first_day_listgrid' and in_array($this->skin, array('list', 'grid', 'slider', 'carousel', 'agenda', 'tile')))))
                {
                    // Hide Shown Events on AJAX
                    if(defined('DOING_AJAX') and DOING_AJAX and $s != $e and $s < strtotime($start) and !$this->show_only_expired_events) continue;

                    $d = date('Y-m-d', $s);

                    if(!isset($dates[$d])) $dates[$d] = array();
                    $dates[$d][] = $date->post_id;
                }
                else
                {
                    $diff = $this->main->date_diff($date->dstart, $date->dend);
                    $days_long = (isset($diff->days) and !$diff->invert) ? $diff->days : 0;

                    while($s <= $e)
                    {
                        if((!$this->show_only_expired_events and $seconds_start <= $s and $s <= $seconds_end) or ($this->show_only_expired_events and $seconds_start >= $s and $s >= $seconds_end))
                        {
                            $d = date('Y-m-d', $s);
                            if(!isset($dates[$d])) $dates[$d] = array();

                            // Check for exclude events
                            if($exclude)
                            {
                                $current_id = !isset($current_id) ? 0 : $current_id;

                                if(!isset($not_in_day))
                                {
                                    $query = "SELECT `post_id`,`not_in_days` FROM `#__mec_events`";
                                    $not_in_day =  $this->db->select($query);
                                }

                                if(array_key_exists($date->post_id, $not_in_day) and trim($not_in_day[$date->post_id]->not_in_days))
                                {
                                    $days =  $not_in_day[$date->post_id]->not_in_days;
                                    $current_id = $date->post_id;
                                }
                                else $days = '';

                                if(strpos($days, $d) === false)
                                {
                                    $midnight = $s+(3600*$midnight_hour);
                                    if($days_long == '1' and $midnight >= $date->tend) break;

                                    $dates[$d][] = $date->post_id;
                                }
                            }
                            else
                            {
                                $midnight = $s+(3600*$midnight_hour);
                                if($days_long == '1' and $midnight >= $date->tend) break;

                                $dates[$d][] = $date->post_id;
                            }
                        }

                        $s += 86400;
                    }
                }

                

                // The Query
                $query = new WP_Query($this->args);
                if($query->have_posts())
                {
                    if(!isset($events[$date])) $events[$date] = array();

                    // The Loop
                    while($query->have_posts())
                    {
                        $query->the_post();
                        $ID = get_the_ID();

                        $ID_count = isset($IDs_count[$ID]) ? $IDs_count[$ID] : 1;

                        for($i = 1; $i <= $ID_count; $i++)
                        {
                            $rendered = $this->render->data($ID);

                            $data = new stdClass();
                            $data->ID = $ID;
                            $data->data = $rendered;

                            $data->date = array
                            (
                                'start'=>array('date'=>$date),
                                'end'=>array('date'=>$this->main->get_end_date($date, $rendered))
                            );

                            $month_id = date('Ym', strtotime($date));
                            if($this->count == '1' and $this->month_divider and $month_id != $current_month_divider): $current_month_divider = $month_id; ?>
                                <div class="mec-month-divider" data-toggle-divider="mec-toggle-<?php echo date('Ym', strtotime($date)); ?>-<?php echo $this->id; ?>"><span><?php echo $this->main->date_i18n('F Y', strtotime($date)); ?></span><i class="mec-sl-arrow-down"></i></div>
                            <?php endif;
                            

                            $events[$date][] = $this->render->after_render($data, $this, $i);
                            update_option( 'mec_sd_time_option', $data->date['start']['date'], true);
                            update_option( 'mec_sdn_time_option', $data->date['end']['date'], true);
                            update_option( 'mec_st_time_option', $data->data->time['start'], true);
                            update_option( 'mec_stn_time_option', $data->data->time['end'], true);
                            $found++;

                            echo ($rcount == 1) ? '<div class="row">' : '';
                            echo '<div class="col-md-'.$col.' col-sm-'.$col.'">';
                            echo '<article class="mec-event-article mec-sd-event-article'. get_the_ID().' mec-clear" itemscope>';
                            echo Plugin::instance()->frontend->get_builder_content_for_display( $this->style, true );
                            echo '</article></div>';
                            if($rcount == $count)
                            {
                                echo '</div>';
                                $rcount = 0;
                            }

                            $rcount++;

                            
                        }

                        if($found >= $this->limit)
                        {
                            // Next Offset
                            $this->next_offset = ($query->post_count-($query->current_post+1)) >= 0 ? ($query->current_post+1)+$this->offset : 0;

                            // Restore original Post Data
                            wp_reset_postdata();

                            break 2;
                        }
                    }
                }

                // Restore original Post Data
                wp_reset_postdata();

                $i++;
            }
            ?>
	</div>
</div>

<?php
$map_eventss = array();
if ( isset($map_events) && !empty($map_events)) :
    foreach ($map_events as $key => $value) {
        foreach ($value as $keyy => $valuee) {
            $map_eventss[] = $valuee;
        }
    }
endif;

if ( isset($this->map_on_top) and $this->map_on_top ) :
if(isset($map_eventss) and !empty($map_eventss))
{
    // Include Map Assets such as JS and CSS libraries
    $this->main->load_map_assets();

    $map_javascript = '<script type="text/javascript">
    jQuery(document).ready(function()
    {
        var jsonPush = gmapSkin('.json_encode($this->render->markers($map_eventss)).');
        jQuery("#mec_googlemap_canvas'.$this->id.'").mecGoogleMaps(
        {
            id: "'.$this->id.'",
            atts: "'.http_build_query(array('atts'=>$this->atts), '', '&').'",
            zoom: '.(isset($settings['google_maps_zoomlevel']) ? $settings['google_maps_zoomlevel'] : 14).',
            icon: "'.apply_filters('mec_marker_icon', $this->main->asset('img/m-04.png')).'",
            styles: '.((isset($settings['google_maps_style']) and trim($settings['google_maps_style']) != '') ? $this->main->get_googlemap_style($settings['google_maps_style']) : "''").',
            markers: jsonPush,
            clustering_images: "'.$this->main->asset('img/cluster1/m').'",
            getDirection: 0,
            ajax_url: "'.admin_url('admin-ajax.php', NULL).'",
            geolocation: "'.$this->geolocation.'",
        });
    });
    </script>';

    $map_data = new stdClass;
    $map_data->id = $this->id;
    $map_data->atts = $this->atts;
    $map_data->events =  $map_eventss;
    $map_data->render = $this->render;
    $map_data->geolocation = $this->geolocation;
    $map_data->sf_status = null;
    $map_data->main = $this->main;
    
    $map_javascript = apply_filters('mec_map_load_script', $map_javascript, $map_data, $settings);

    // Include javascript code into the page
    if($this->main->is_ajax()) echo $map_javascript;
    else $this->factory->params('footer', $map_javascript);
}
endif;