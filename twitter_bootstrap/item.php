<?php
    $is_expired     = osc_item_is_expired () ;
    $is_user        = osc_logged_user_id() != osc_item_user_id() ;
    $is_can_contact = osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ;
?>
<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('fancybox/jquery.fancybox-1.3.4.js') ; ?>"></script>
        <link href="<?php echo osc_current_web_theme_js_url('fancybox/jquery.fancybox-1.3.4.css') ; ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            $(document).ready(function(){
                $("a[rel=image_group]").fancybox();
            });
        </script>
        <?php if( osc_item_is_expired () ) { ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
        <?php } ?>
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container margin-top-10">
            <?php twitter_show_flash_message() ; ?>
        </div>
        <div class="container item-detail">
            <div class="row">
                <div class="span16 columns">
                    <h1><?php if( osc_price_enabled_at_items() ) { ?><small><?php echo osc_item_formated_price() ; ?></small> <?php } ?><?php echo osc_item_title(); ?></h1>
                    <p class="no-margin"><?php printf(__('<strong>Published date:</strong> %s %s', 'twitter_bootstrap'), osc_format_date( osc_item_pub_date() ), date(osc_time_format(), strtotime(osc_item_pub_date())) ) ; ?></p>
                    <?php if ( osc_item_mod_date() != '' ) { ?>
                    <p class="no-margin"><?php printf(__('<strong>Modified date:</strong> %s %s', 'twitter_bootstrap'), osc_format_date( osc_item_mod_date() ), date(osc_time_format(), strtotime(osc_item_mod_date())) ) ; ?></p>
                    <?php } ?>
                    <?php $item_location = item_detail_location() ; ?>
                    <?php if( count($item_location) > 0 ) { ?>
                    <p class="no-margin"><?php printf(__('<strong>Location:</strong> %s', 'twitter_bootstrap'), implode(', ', $item_location) ) ; ?></p>
                    <?php } ?>
                    <p class="margin-top-10"><?php echo osc_item_description() ; ?></p>
                    <div class="custom_fields">
                        <?php if( osc_count_item_meta() > 0 ) { ?>
                        <div class="meta_list">
                            <?php while ( osc_has_item_meta() ) { ?>
                            <p class="meta no-margin">
                                <strong><?php echo osc_item_meta_name() ; ?>:</strong> <?php echo osc_item_meta_value() ; ?>
                            </p>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php osc_run_hook('item_detail', osc_item() ) ; ?>
                    <?php if( osc_images_enabled_at_items() && (osc_count_item_resources() > 0) ) { ?>
                    <div class="photos">
                        <?php while( osc_has_item_resources() ) { ?>
                        <a rel="image_group" href="<?php echo osc_resource_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="150" alt="<?php echo osc_item_title() ; ?>" title="<?php echo osc_item_title() ; ?>"/></a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <p>
                        <?php if ( !$is_expired && $is_user && $is_can_contact ) { ?>
                        <a class="btn primary item-contact-button" href="javascript://"><?php _e('Contact seller', 'twitter_bootstrap') ; ?></a>
                        <?php } ?>
                        <a class="btn primary item-share-button" href="javascript://"><?php _e('Share', 'twitter_bootstrap') ; ?></a>
                    </p>
                    <?php osc_run_hook('location') ; ?>
                </div>
            </div>
        </div>
        <?php if ( !$is_expired && $is_user && $is_can_contact ) { ?>
        <!-- item contact -->
        <div class="modal item-contact">
            <form class="form-stacked" action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form" onsubmit="return doItemContact() ;">
                <input type="hidden" name="action" value="contact_post" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                <div class="modal-header">
                    <h3><?php _e('Contact publisher', 'twitter_bootstrap') ; ?></h3>
                    <a href="#" class="close">×</a>
                </div>
                <div class="modal-body">
                    <?php osc_prepare_user_info() ; ?>
                    <div class="clearfix">
                        <label for="yourName"><?php _e('Your name', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge" id="yourName" name="yourName" type="text" value="<?php echo osc_logged_user_name(); ?>">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="yourEmail"><?php _e('Your e-mail', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge" id="yourEmail" name="yourEmail" type="text" value="<?php echo osc_logged_user_email();?>">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="phoneNumber"><?php _e('Phone number', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge" id="phoneNumber" name="phoneNumber" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="message"><?php _e('Message', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <textarea class="xlarge" id="message" name="message" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn primary" type="submit"><?php _e('Send', 'twitter_bootstrap') ; ?></button>
                    <a class="btn item-contact-button-cancel" href="javascript://"><?php _e('Cancel', 'twitter_bootstrap') ; ?></a>
                </div>
            </form>
        </div>
        <!-- item contact end -->
        <?php } ?>
        <!-- item send friend -->
        <div class="modal item-sendfriend">
            <form class="form-stacked" action="<?php echo osc_base_url(true) ; ?>" method="post" name="sendfriend" onsubmit="return doItemSendFriend() ;">
                <input type="hidden" name="action" value="send_friend_post" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                <div class="modal-header">
                    <h3><?php _e('Send to a friend', 'twitter_bootstrap') ; ?></h3>
                    <a href="#" class="close">×</a>
                </div>
                <div class="modal-body">
                    <div class="clearfix">
                        <label for="sendfriend-yourName"><?php _e('Your name', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge sendfriend-yourName" id="sendfriend-yourName" name="yourName" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="sendfriend-friendName"><?php _e('Your e-mail', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge sendfriend-yourEmail" id="sendfriend-yourEmail" name="yourEmail" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="sendfriend-friendName"><?php _e("Your friend's name", 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge sendfriend-friendName" id="sendfriend-friendName" name="friendName" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="sendfriend-friendEmail"><?php _e("Your friend's e-mail", 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <input class="xlarge sendfriend-friendEmail" id="sendfriend-friendEmail" name="friendEmail" type="text" value="">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="message"><?php _e('Message', 'twitter_bootstrap') ; ?></label>
                        <div class="input">
                            <textarea class="xlarge" id="message" name="message" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn primary" type="submit"><?php _e('Send', 'twitter_bootstrap') ; ?></button>
                    <a class="btn item-sendfriend-button-cancel" href="javascript://"><?php _e('Cancel', 'twitter_bootstrap') ; ?></a>
                </div>
            </form>
        </div>
        <!-- item send friend end -->
        <script type="text/javascript">
            $(document).ready(function() {
                /* js item-contact */
                $(".item-contact.modal").hide();

                $(".item-contact-button").click(function() {
                    $(".item-contact.modal").fadeIn('slow');
                }) ;

                $(".item-contact-button-cancel").click(function() {
                    $(".item-contact.modal").fadeOut('slow');
                }) ;
                /* js item-contact end */
                /* js sendfriend */
                $(".item-sendfriend.modal").hide();
                
                $(".item-share-button").click(function() {
                    $(".item-sendfriend.modal").fadeIn('slow');
                }) ;

                $(".item-sendfriend-button-cancel").click(function() {
                    $(".item-sendfriend.modal").fadeOut('slow');
                }) ;
                /* js item-sendfriend end */
            }) ;
        </script>
        <script type="text/javascript">
            var text_error_required = '<?php _e('This field is required', 'twitter_bootstrap') ; ?>' ;
            var text_valid_email    = '<?php _e('Enter a valid e-mail address', 'twitter_bootstrap') ; ?>' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_contact.js') ; ?>"></script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_sendfriend.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>