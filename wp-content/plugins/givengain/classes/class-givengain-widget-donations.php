<?php

class Givengain_Widget_Donations extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        // widget actual processes
        parent::__construct(
            'foo_widget', // Base ID
            __( 'Widget Title', 'text_domain' ), // Name
            array( 'description' => __( 'A Foo Widget', 'text_domain' ), ) // Args
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        // outputs the content of the widget

        $cause_id = 2682;
        $client_id = '1c9f561e5d5fcfb347c1d29430c6b1dedc61a310';

        $donations = json_decode(file_get_contents("https://api.givengain.com/donation?cause_id=$cause_id&client_id=$client_id&limit=10"));
        $markup = wp_cache_get( 'donations' );
        if ( false === $markup ) {
            // echo 'fetching live data';
            $markup = "<ul>";
            foreach($donations as $donation) {
                $project = json_decode(file_get_contents("https://api.givengain.com/cause_project/$donation->cause_project_id?cause_id=$cause_id&client_id=$client_id"));
                $activist = json_decode(file_get_contents("https://api.givengain.com/activist/$donation->donor_id?client_id=$client_id"));
                $markup .= "<li><a href='$activist->link'>$activist->first_name $activist->last_name</a> donated <strong>$donation->currency $donation->amount</strong> to <a href='$project->link'>$project->name</a></li>";
            }
            $markup .= "</ul>";
            wp_cache_set( 'donations', $markup, null, 86400);
        } else {
            // echo 'from cache';
        }
        echo "<div class='givengain_donations_widget well'>";
        echo "<h5 class='section-nav-title'>Donations received</h5>";
        echo $markup;
        echo "</div>";

    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }

}
