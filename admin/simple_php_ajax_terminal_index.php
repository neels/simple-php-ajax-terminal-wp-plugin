<script>
    function go_go_go() {
        jQuery.ajax({
            method: "POST",
            dataType: "json",
            url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
            data: {
                'action' : 'simple_terminal_ajax',
                'command': jQuery('#command').val(),
                'root': jQuery('#root').val()
            },
            success: function (data) {
                jQuery('#root').val(data['root']);
                jQuery("#output").append(data['term_output'])

                console.log(data['term_output'])

                var objDiv = document.getElementById("output");
                objDiv.scrollTop = objDiv.scrollHeight;
            },
            error:function(err){
                console.log(err)
            }
        })
    }

    jQuery(document).ready(function () {

        jQuery("#command").keypress(function(e) {
            if(e.which == 13) {
                go_go_go();
                jQuery("#command").val('');
            }
        });

    })
</script>
<div id="output" class="simple_php_ajax_terminal_terminal"><< Welcome to Simple AJAX/PHP terminal >></div>
<!--<textarea name="command" id="command"></textarea>-->
<input type="text" id="command" name="command" class="simple_php_ajax_terminal_trm">
<div class="simple_php_ajax_terminal_brac"> > </div>
<input type="hidden" name="root" id="root" value="empty">