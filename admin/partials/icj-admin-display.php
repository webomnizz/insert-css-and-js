<?php

/**
 * Provide a admin area view for the plugin
 *
 * @link       https://webomnizz.com
 * @since      1.0.0
 *
 * @package    Icj
 * @subpackage Icj/admin/partials
 * @author     Jogesh <jogesh@webomnizz.com>
 */
?>
<div class="wrap">
    <h1>Insert CSS and Javascript</h1>
    <div class="icj_dashboard">
        <form method="POST">
            <?php wp_nonce_field( 'icj_action', 'icj_field' ); ?>
            <h2 class="title">Header</h2>
            <p class="description">codes before &lt;/head&gt; tag</p>
            <div id="editor" class="icj_editor header"></div>
            <h2 class="title">Footer</h2>
            <p class="description">codes before &lt;/body&gt; tag</p>
            <div id="editor" class="icj_editor footer"></div>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
            </p>
        </form>
    </div>

    <div class="loader_container">
        <div class="loader">Loading...</div>
    </div>
</div>