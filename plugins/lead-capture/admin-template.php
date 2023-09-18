<?php
// get all the leads form the wp_leads table
global $wpdb;
$table_name = $wpdb->prefix . 'leads';
$leads = $wpdb->get_results("SELECT * FROM $table_name");
?>
<div class="wrap">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
        <h1>Leads</h1>
        <button class="button button-primary button-small" id="export">Export</button>
    </div>

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Last Activity</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($leads as $lead) {
                $activities_as_array = json_decode($lead->activity);
                $last_activity =  $activities_as_array[count($activities_as_array) - 1];
            ?>
                <tr>
                    <td><?php echo $lead->first_name; ?></td>
                    <td><?php echo $lead->last_name; ?></td>
                    <td><?php echo $lead->email; ?></td>
                    <td><?php echo $lead->phone; ?></td>
                    <td><?php echo $last_activity->type; ?><br />
                        <!-- Human readable date from string -->
                        <?php echo date("F j, Y, g:i a", strtotime($last_activity->date)); ?>
                    <td><?php echo date("F j, Y, g:i a", strtotime($lead->created_at)); ?></td>
                </tr>
            <?php
            }
            ?>
        <tbody>
    </table>

    <script>
        <?php


        ?>
        jQuery(document).ready(function($) {
            $('#export').click(function() {
                // export a csv file
                var csv = [];
                var leads = <?php echo json_encode($leads); ?>;
                console.log(leads);

                for (var i = 0; i < leads.length; i++) {
                    var lead = leads[i];
                    console.log(lead);
                    var activities_as_array = JSON.parse(lead.activity);
                    var last_activity = activities_as_array[activities_as_array.length - 1];
                    csv.push(lead.first_name + ',' + lead.last_name + ',' + lead.email + ',' + lead.phone + ',' + last_activity.type + ',' + lead.created_at);
                }

                // Download CSV file
                // create a tempraroy link to click and download the csv file
                var link = document.createElement("a");
                link.setAttribute("href", "data:text/csv;charset=utf-8,%EF%BB%BF" + encodeURI(csv.join("\n")));
                link.setAttribute("download", "leads.csv");
                link.style.display = "none";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);


            });
        });
    </script>

</div>