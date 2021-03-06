<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content">
                <div class="user_forms">
                    <div class="inner">
                        <h1><?php _e('Recommend to a friend', 'newcorp') ; ?></h1>
                        <?php SendFriendForm::js_validation() ; ?>
                        <form id="send-friend" name="send-friend" action="<?php echo osc_base_url(true) ; ?>" method="post" onsubmit="return validate_form() ;">
                            <fieldset>
                                <input type="hidden" name="action" value="send_friend_post" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                                <label><?php _e('Item', 'newcorp') ; ?>: <a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a></label><br/>
                                <label for="yourName"><?php _e('Your name', 'newcorp') ; ?></label> <?php SendFriendForm::your_name() ; ?> <br/>
                                <label for="yourEmail"><?php _e('Your e-mail address', 'newcorp') ; ?></label> <?php SendFriendForm::your_email() ; ?> <br/>
                                <label for="friendName"><?php _e("Your friend's name", 'newcorp') ; ?></label> <?php SendFriendForm::friend_name() ; ?> <br/>
                                <label for="friendEmail"><?php _e("Your friend's e-mail address", 'newcorp') ; ?></label> <?php SendFriendForm::friend_email() ; ?> <br/>
                                <label for="message"><?php _e('Message', 'newcorp') ; ?></label> <?php SendFriendForm::your_message() ; ?> <br/>
                                <button type="submit"><?php _e('Send', 'newcorp') ; ?></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <?php osc_current_web_theme_path('footer.php') ; ?>
            </div>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>