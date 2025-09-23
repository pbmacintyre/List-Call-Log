<?php
/**
 * Copyright (C) 2019-2024 Paladin Business Solutions
 */
ob_start();
session_start();

require_once('includes/ringcentral-functions.inc');
require_once('includes/ringcentral-php-functions.inc');

show_errors();

page_header(0);

function show_form($message, $print_again = false) {

    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="EditTable" >
            <tr class="CustomTable">
                <td colspan="2" class="CustomTableFullCol">
                    <img src="images/rc-logo.png"/>
                    <h2><?php echo app_name(); ?></h2>
                    <?php
                    if ($print_again == true) {
                        echo "<p class='msg_bad'>" . $message . "</p>";
                    } else {
                        echo "<p class='msg_good'>" . $message . "</p>";
                    } ?>
                    <hr>
                </td>
            </tr>
            <tr class="CustomTable">
                <td class="left_col">
                    <p style='display: inline;'>Phone # for log:</p>
                </td>
                <td class="right_col">
                    <input type="text" name="log_number">
                </td>
            </tr>
            <tr class="CustomTable">
                <td class="left_col">
                    <p style='display: inline;'>Start Date for log:</p>
                </td>
                <td class="right_col">
                    <input type="text" name="start_date">
                </td>
            </tr>
            <tr class="CustomTable">
                <td class="left_col">
                    <p style='display: inline;'>End Date for log:</p>
                </td>
                <td class="right_col">
                    <input type="text" name="end_date">
                </td>
            </tr>
            <tr class="CustomTable">
                <td colspan="2" class="CustomTableFullCol">
                    <br/>
                    <input type="submit" class="submit_button" value="   Retrieve Logs   " name="get_logs">
                </td>
            </tr>
            <tr class="CustomTable">
                <td colspan="2" class="CustomTableFullCol">
                    <hr>
                </td>
            </tr>
        </table>
    </form>
    <?php
}

function check_form() {
    show_errors();

    $print_again = false;
    $message = "";

    /* ============================================ */
    /* ====== START data integrity checks ========= */
    /* ============================================ */

    $log_number = strip_tags($_POST['log_number']);
    $start_date = strip_tags($_POST['start_date']);
    $end_date = strip_tags($_POST['end_date']);

    if ($log_number == "" ) {
        $print_again = true;
        $message = "No phone number has been provided, how can we retrieve logs?";
    }

    /* ========================================== */
    /* ====== END data integrity checks ========= */
    /* ========================================== */
    if ($print_again) {
        show_form($message, $print_again);
    } else {
        get_logs($log_number, $start_date, $end_date);
    }
}

/* ============= */
/*  --- MAIN --- */
/* ============= */
if (isset($_POST['get_logs'])) {
    check_form();
} else {
    $message = "Please provide the needed information.";
    show_form($message);
}

ob_end_flush();
page_footer();
