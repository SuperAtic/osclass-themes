<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container margin-top-10">
            <?php twitter_show_flash_message() ; ?>
        </div>
        <div class="container item-post">
            <div class="row">
                <div class="span16 columns">
                    <h1><?php _e('Publish an item', 'twitter_bootstrap') ; ?></h1>
                    <form class="form-stacked" name="item" action="<?php echo osc_base_url(true) ; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="item_add_post" />
                        <input type="hidden" name="page" value="item" />
                        <fieldset>
                            <div class="clearfix">
                                <label>Category</label>
                                <div class="input">
                                    <select name="catId">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        <option value="">5</option>
                                        <option value="">6</option>
                                    </select>
                                    <select name="catId">
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        <option value="">5</option>
                                        <option value="">6</option>
                                    </select> 
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_add.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>